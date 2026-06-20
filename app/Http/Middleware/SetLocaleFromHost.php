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
        $locale = in_array($request->getHost(), config('site.swedish_hosts', []))
            ? 'sv'
            : config('site.default_locale', 'en');

        App::setLocale($locale);

        return $next($request);
    }
}
