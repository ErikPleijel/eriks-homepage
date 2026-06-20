<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromHost
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->environment('local')) {
            $queryLocale = $request->query('locale');
            if (in_array($queryLocale, ['en', 'sv'])) {
                session(['_locale_override' => $queryLocale]);
                App::setLocale($queryLocale);
            } elseif (in_array(session('_locale_override'), ['en', 'sv'])) {
                App::setLocale(session('_locale_override'));
            } else {
                App::setLocale(config('site.default_locale', 'en'));
            }
        } else {
            $locale = in_array($request->getHost(), config('site.swedish_hosts', []))
                ? 'sv'
                : config('site.default_locale', 'en');
            App::setLocale($locale);
        }

        return $next($request);
    }
}
