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

    'book_title' => 'Faustian Bargain? No Thanks!',

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

];
