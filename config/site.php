<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Titles
    |--------------------------------------------------------------------------
    |
    | Two DELIBERATELY DIFFERENT strings — do not conflate them:
    |   'title'      — the website's own name, shown in the <title> tag and
    |                  site header on every page.
    |   'book_title' — the title of the book itself; used only where we refer
    |                  to the book (Amazon CTA, cover alt text, etc.).
    |
    */

    'title' => 'The Anchor in the Storm',

    /*
    | Per-locale display titles for the hero banner. 'title' above stays the
    | canonical (English) name used in the <title> tag; these are the localized
    | strings shown visually in the hero. Falls back to 'title' if a locale is
    | missing here.
    */

    'titles' => [
        'en' => 'The Anchor in the Storm',
        'sv' => 'Ankaret i stormen',
    ],

    'book_title' => 'Faustian Bargain? No Thanks!',

    /*
    |--------------------------------------------------------------------------
    | Book slug
    |--------------------------------------------------------------------------
    |
    | URL-safe identifier for the book. Combined with the active locale it
    | forms the per-locale "book_code" recorded against printed-edition
    | interest sign-ups, e.g. 'faustian-bargain-en' / 'faustian-bargain-sv'.
    | Single source of truth so the code isn't a magic string in Blade/PHP.
    |
    */

    'book_slug' => 'faustian-bargain',

    /*
    |--------------------------------------------------------------------------
    | Contact email
    |--------------------------------------------------------------------------
    |
    | Shown in the GDPR consent text as the address for removal requests.
    | Carried over from the original one.com interest form.
    |
    */

    'contact_email' => 'epost@erikpleijel.se',

    /*
    |--------------------------------------------------------------------------
    | Available Locales
    |--------------------------------------------------------------------------
    |
    | Locales the site is published in. Keyed by the locale code used in the
    | {locale} URL segment; the value is the human label shown in the
    | language switcher. The SetLocale middleware validates the incoming
    | {locale} segment against the keys of this array.
    |
    */

    'locales' => [
        'en' => 'English',
        'sv' => 'Svenska',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | Used when no locale is present in the URL (e.g. the root "/" redirect).
    | Must be one of the keys in 'locales' above.
    |
    */

    'default_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Analytics key
    |--------------------------------------------------------------------------
    |
    | Secret query-parameter value required to view /analytics. Must be present
    | on every request (?key=...). Anyone without it receives a 404. Set via
    | ANALYTICS_KEY in .env — never hard-code here.
    |
    */

    'analytics_key' => env('ANALYTICS_KEY', ''),

];
