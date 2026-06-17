<?php

namespace App\Http\Middleware;

use App\Models\SiteEvent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Records a cookie-free 'pageview' SiteEvent for the routes it's applied to.
 *
 * Applied directly to the home and chapter routes — NOT globally — so assets,
 * the /events/click endpoint, and anything else are never logged. Only the
 * referrer's HOST is kept (parsed out of the Referer header); the full
 * referring URL is dropped because it can carry query strings. No IP, no
 * user-agent, no new cookie.
 */
class LogPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET')) {
            SiteEvent::create([
                'event_type' => 'pageview',
                'path' => $request->path(),
                'locale' => App::getLocale(),
                'referrer_host' => $this->referrerHost($request),
                'label' => null,
            ]);
        }

        return $response;
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
