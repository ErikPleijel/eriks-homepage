<?php

namespace App\Http\Middleware;

use App\Models\SiteEvent;
use Closure;
use GeoIp2\Database\Reader as GeoReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Records a cookie-free 'pageview' SiteEvent for the routes it's applied to.
 *
 * Applied directly to the home and chapter routes — NOT globally — so assets,
 * the /events/click endpoint, and anything else are never logged. Only GET
 * requests are recorded.
 *
 * Privacy: only the referrer HOST and a resolved 2-letter country code are
 * stored — never the full IP address, never the user-agent, no cross-session
 * identifier. A country code is not personal data (cannot identify an
 * individual), so the GDPR-safe posture is preserved. See DECISIONS.md.
 */
class LogPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET')) {
            SiteEvent::create([
                'event_type'    => 'pageview',
                'path'          => $request->path(),
                'locale'        => App::getLocale(),
                'country_code'  => $this->countryCode($request),
                'referrer_host' => $this->referrerHost($request),
                'label'         => null,
            ]);
        }

        return $response;
    }

    /**
     * Resolve a 2-letter ISO country code from the request IP using the
     * MaxMind GeoLite2-Country offline database. Returns null if the .mmdb
     * file hasn't been placed yet or if lookup fails (private IPs, etc.).
     *
     * The IP is used only for lookup and is never stored.
     */
    private function countryCode(Request $request): ?string
    {
        $mmdb = storage_path('geoip/GeoLite2-Country.mmdb');

        if (! file_exists($mmdb)) {
            return null;
        }

        try {
            $reader = new GeoReader($mmdb);
            $record = $reader->country($request->ip());
            $reader->close();

            return $record->country->isoCode ?: null;
        } catch (\Throwable) {
            // Covers AddressNotFoundException (localhost / private IPs),
            // InvalidDatabaseException, and any other GeoIP2 error.
            return null;
        }
    }

    /**
     * Host portion of the Referer header, or null. We never store the full
     * referring URL — only the host — so query strings can't leak in.
     */
    private function referrerHost(Request $request): ?string
    {
        $referer = $request->headers->get('referer');

        if (! $referer) {
            return null;
        }

        return parse_url($referer, PHP_URL_HOST) ?: null;
    }
}
