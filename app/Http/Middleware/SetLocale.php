<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Validate the {locale} route segment against the configured locales and
     * apply it to the application. An unknown locale 404s rather than silently
     * falling back, so bad URLs don't quietly render the default language.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        abort_unless(
            array_key_exists($locale, config('site.locales')),
            404
        );

        App::setLocale($locale);

        return $next($request);
    }
}
