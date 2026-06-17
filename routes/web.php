<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Root redirect
|--------------------------------------------------------------------------
|
| The site is always served under a locale segment. Hitting "/" sends the
| visitor to the default locale defined in config/site.php.
|
*/
Route::get('/', function () {
    return redirect('/'.config('site.default_locale'));
});

/*
|--------------------------------------------------------------------------
| Locale-aware routes
|--------------------------------------------------------------------------
|
| Everything visitor-facing lives under /{locale}. The SetLocale middleware
| validates the segment (404 on unknown) and calls App::setLocale(). Content
| Blade files live in resources/views/content/{locale}/..., so each route
| resolves the view for the active locale.
|
*/
Route::prefix('{locale}')
    ->middleware('setlocale')
    ->group(function () {
        Route::get('/', function (string $locale) {
            return view("content.{$locale}.home");
        })->name('home');

        Route::get('/chapters/{chapter}', function (string $locale, string $chapter) {
            $view = "content.{$locale}.chapters.{$chapter}";

            abort_unless(view()->exists($view), 404);

            return view($view);
        })->name('chapter');
    });
