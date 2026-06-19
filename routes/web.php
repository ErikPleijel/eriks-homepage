<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BookInterestController;
use App\Http\Controllers\EventController;
use App\Support\ChapterData;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Slug maps — built once at route-registration time from config/chapters.php
|--------------------------------------------------------------------------
|
| Slugs derive from Str::slug(title_en / title_sv) inside ChapterData, so
| renaming a chapter title in the config automatically changes the live URL
| without touching this file. The maps are closured into the route handlers.
|
*/

$enSlugs = ChapterData::slugMap('en'); // [slug => 'introduction' | 'chapter-N']
$svSlugs = ChapterData::slugMap('sv');

/*
|--------------------------------------------------------------------------
| Global parameter constraints
|--------------------------------------------------------------------------
|
| Constrain {locale} to known locale codes so the /{locale} home-page
| pattern never matches English chapter slugs at the root (e.g.
| /breakout-… would otherwise be swallowed before the EN chapter route
| gets a chance to match).
|
*/

Route::pattern('locale', implode('|', array_keys(config('site.locales'))));

/*
|--------------------------------------------------------------------------
| Root redirect
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/' . config('site.default_locale'));
});

/*
|--------------------------------------------------------------------------
| Locale-prefixed routes — home pages + Swedish chapter URLs
|--------------------------------------------------------------------------
|
| English chapter URLs live at site root (see section below). Swedish chapter
| URLs live here under /sv/{slug}. Attempting /en/{slug} correctly 404s.
|
*/

Route::prefix('{locale}')
    ->middleware('setlocale')
    ->group(function () use ($svSlugs) {

        Route::get('/', function (string $locale) {
            return view("content.{$locale}.home");
        })->middleware('logpageview')->name('home');

        Route::get('/intresseanmalan', function (string $locale) {
            abort_if($locale !== 'sv', 404);
            return view('content.sv.book-interest');
        })->middleware('logpageview')->name('book-interest.form');

        Route::get('/om-mig', function (string $locale) {
            abort_if($locale !== 'sv', 404);
            return view('content.sv.about');
        })->middleware('logpageview')->name('about.sv');

        Route::get('/{slug}', function (string $locale, string $slug) use ($svSlugs) {
            // English chapters live at root, not under /en/. Only /sv/{slug} is valid.
            abort_if($locale !== 'sv', 404);

            $viewName = $svSlugs[$slug] ?? null;
            abort_unless($viewName !== null, 404);

            $view = "content.sv.chapters.{$viewName}";
            abort_unless(view()->exists($view), 404);

            return view($view);
        })->middleware('logpageview')->name('chapter.sv');
    });

/*
|--------------------------------------------------------------------------
| English chapter routes — no locale prefix (English as the root language)
|--------------------------------------------------------------------------
|
| e.g. /breakout-escaping-the-prison-of-toxic-passions
|       /introduction-the-7-classical-virtues-as-a-spiritual-immune-system
|
| App::setLocale('en') is called inside the closure. LogPageView calls
| $next($request) before it reads App::getLocale(), so locale is already
| 'en' by the time the SiteEvent is recorded — no separate middleware needed.
|
*/

Route::get('/about', function () {
    App::setLocale('en');
    return view('content.en.about');
})->middleware('logpageview')->name('about.en');

/*
|--------------------------------------------------------------------------
| Private analytics — key required in every request (?key=...)
|--------------------------------------------------------------------------
*/

Route::get('/analytics', [AnalyticsController::class, 'show'])->name('analytics');

Route::get('/{slug}', function (string $slug) use ($enSlugs) {
    App::setLocale('en');

    $viewName = $enSlugs[$slug] ?? null;
    abort_unless($viewName !== null, 404);

    $view = "content.en.chapters.{$viewName}";
    abort_unless(view()->exists($view), 404);

    return view($view);
})->middleware('logpageview')->name('chapter.en');

/*
|--------------------------------------------------------------------------
| Click logging
|--------------------------------------------------------------------------
*/

Route::post('/events/click', [EventController::class, 'click'])
    ->middleware('throttle:30,1')
    ->name('events.click');

/*
|--------------------------------------------------------------------------
| Printed-book interest sign-up
|--------------------------------------------------------------------------
*/

Route::post('/book-interest', [BookInterestController::class, 'store'])
    ->middleware('throttle:5,10')
    ->name('book-interest.store');
