<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\BookInterestController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SitemapController;
use App\Support\ChapterData;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Slug maps — built once at route-registration time from config/chapters.php
|--------------------------------------------------------------------------
|
| Locale is now set by SetLocaleFromHost (appended to the web middleware
| group in bootstrap/app.php) based on the request host. No {locale} URL
| segment is needed or used anywhere in this file.
|
*/

$enSlugs = ChapterData::slugMap('en');
$svSlugs = ChapterData::slugMap('sv');

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('content.'.app()->getLocale().'.home');
})->middleware('logpageview')->name('home');

/*
|--------------------------------------------------------------------------
| About pages
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    abort_if(app()->getLocale() !== 'en', 404);
    return view('content.en.about');
})->middleware('logpageview')->name('about.en');

Route::get('/om-mig', function () {
    abort_if(app()->getLocale() !== 'sv', 404);
    return view('content.sv.about');
})->middleware('logpageview')->name('about.sv');

/*
|--------------------------------------------------------------------------
| Book-interest sign-up (SV only)
|--------------------------------------------------------------------------
*/

Route::get('/intresseanmalan', function () {
    abort_if(app()->getLocale() !== 'sv', 404);
    return view('content.sv.book-interest');
})->middleware('logpageview')->name('book-interest.form');

/*
|--------------------------------------------------------------------------
| Analytics
|--------------------------------------------------------------------------
*/

Route::get('/analytics', [AnalyticsController::class, 'show'])->name('analytics');

/*
|--------------------------------------------------------------------------
| Sitemap
|--------------------------------------------------------------------------
*/

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| 301 redirects — old locale-prefixed URLs
|--------------------------------------------------------------------------
*/

Route::get('/en', fn () => redirect('/', 301));
Route::get('/sv', fn () => redirect('/', 301));
Route::get('/registrera', fn () => redirect('https://erikpleijel.se/', 301));
Route::get('/webbdesign', fn () => redirect('https://erikpleijel.se/', 301));
Route::get('/eng', fn () => redirect('https://erikpleijel.se/', 301));
Route::get('/recensioner', fn () => redirect('https://erikpleijel.se/', 301));
Route::get('/en/about', fn () => redirect('/about', 301));
Route::get('/sv/om-mig', fn () => redirect('/om-mig', 301));
Route::get('/sv/intresseanmalan', fn () => redirect('/intresseanmalan', 301));
Route::get('/sv/{slug}', fn (string $slug) => redirect('/'.$slug, 301));

/*
|--------------------------------------------------------------------------
| 301 redirects — old one.com /book/ and /bok/ paths
|--------------------------------------------------------------------------
|
| Specific mismatched slug first so it matches before the wildcard.
|
*/

Route::get('/book/introduction-the-seven-classical-virtues-as-a-spiritual-immune-system',
    fn () => redirect('https://erikpleijel.com/introduction-the-7-classical-virtues-as-a-spiritual-immune-system', 301));
Route::get('/book/{slug}', fn (string $slug) => redirect('https://erikpleijel.com/'.$slug, 301));
Route::get('/bok/{slug}', fn (string $slug) => redirect('/'.$slug, 301));

/*
|--------------------------------------------------------------------------
| Chapter routes — locale determined by host (SetLocaleFromHost middleware)
|--------------------------------------------------------------------------
*/

Route::get('/{slug}', function (string $slug) use ($enSlugs, $svSlugs) {
    $locale   = app()->getLocale();
    $slugMap  = $locale === 'sv' ? $svSlugs : $enSlugs;
    $viewName = $slugMap[$slug] ?? null;
    abort_unless($viewName !== null, 404);
    $view = "content.{$locale}.chapters.{$viewName}";
    abort_unless(view()->exists($view), 404);
    return view($view);
})->middleware('logpageview')->name('chapter');

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
