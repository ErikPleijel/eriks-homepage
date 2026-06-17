<?php

use App\Http\Controllers\BookInterestController;
use App\Http\Controllers\EventController;
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
        })->middleware('logpageview')->name('home');

        Route::get('/chapters/{chapter}', function (string $locale, string $chapter) {
            $view = "content.{$locale}.chapters.{$chapter}";

            abort_unless(view()->exists($view), 404);

            return view($view);
        })->middleware('logpageview')->name('chapter');
    });

/*
|--------------------------------------------------------------------------
| Click logging
|--------------------------------------------------------------------------
|
| Cookie-free click tracking. Not locale-prefixed and not behind SetLocale —
| the client posts {label, path} and the controller derives the locale from
| the reported path. Standard web-group CSRF still applies (token rides the
| existing session, no new cookie); throttled to keep it from being abused.
|
*/
Route::post('/events/click', [EventController::class, 'click'])
    ->middleware('throttle:30,1')
    ->name('events.click');

/*
|--------------------------------------------------------------------------
| Printed-book interest sign-up
|--------------------------------------------------------------------------
|
| Ported from the old one.com PHP form. Not locale-prefixed: the form submits
| a hidden book_code (locale-derived) and redirects back to the page it came
| from. Standard web-group CSRF applies; throttle:5,10 (5 per 10 min, keyed by
| IP) replaces the old hand-rolled SQL rate-limit query.
|
*/
Route::post('/book-interest', [BookInterestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('book-interest.store');
