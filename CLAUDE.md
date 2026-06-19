# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Stack

Laravel 12 (PHP 8.2+), Tailwind CSS v4, Alpine.js, Vite. Served via XAMPP on Windows locally.

## Common commands

```bash
# First-time setup
composer run setup

# Development (runs Laravel, queue, Pail log viewer, and Vite concurrently)
composer run dev

# Run all tests
composer run test

# Run a single test file
php artisan test tests/Feature/ExampleTest.php

# Lint / format PHP (Laravel Pint)
./vendor/bin/pint

# Database migrations
php artisan migrate
```

## Architecture

### Locale routing

All visitor-facing URLs are prefixed `/{locale}` (e.g. `/en`, `/sv`). The root `/` redirects to `config('site.default_locale')`. The `SetLocale` middleware validates the `{locale}` segment against `config('site.locales')` and calls `App::setLocale()` — unknown locales 404 rather than silently falling back.

Locale is the single source of truth: view paths, book codes, and form copy all derive from it at runtime. There are no translation files; per-locale strings live inline in Blade views or components.

### Content views

Chapter and home content lives in `resources/views/content/{locale}/` — one directory tree per locale, mirrored in structure. A chapter route resolves `content.{locale}.chapters.{chapter}` and 404s if the view doesn't exist.

### Blade components (`resources/views/components/`)

- `x-layout` — the root shell; accepts an optional `title` prop and an optional `hero` slot.
- `x-hero` — full or compact banner; `compact` prop switches the slim variant.
- `x-content-image` — responsive figure with `src`, `alt`, optional `caption`, `align` (`right` floats), and `width`/`mobileWidth` percentage props. Responsive sizing is done via CSS custom properties (`--img-w`, `--img-w-mobile`) set inline on the `<figure>` and read in `app.css` — inline styles can't do breakpoints alone.
- `x-footnote-trigger` / `x-footnote-modal` — a single Alpine `footnotes` component is mounted on `<body x-data="footnotes">` in the layout; triggers call `show(label, body)` on that shared scope.
- `x-book-interest-form` — stamps `BookInterestController::FORM_TIME_KEY` into the session on render for the minimum-time bot check.

### Chapter typography

Chapter pages wrap content in `<article class="prose-stone max-w-none">`. Typography is handled by semantic CSS classes defined in `app.css` (`chapter-kicker`, `chapter-title`, `chapter-heading`, `chapter-lead`, `chapter-text`, `chapter-blockquote`) rather than Tailwind utilities in markup, so all 24+ chapter files stay consistent.

### Analytics (cookie-free)

`LogPageView` middleware records a `SiteEvent` (type `pageview`) on GET requests to home and chapter routes. `EventController::click` records type `click` from a `POST /events/click` AJAX call. Both store only `path`, `locale`, `referrer_host` (host only, no full URL), and an optional `label` — never IP, user-agent, or cross-session identifiers. CSRF is satisfied via the session token in `<meta name="csrf-token">`; no new cookies. `window.logEvent(label)` in `resources/js/events.js` is the client-side helper.

### Book-interest sign-up

`BookInterestController` ports the old one.com PHP form. Anti-bot measures: honeypot field (`website`), minimum-time check (session timestamp set by the component on render, not a tamperable hidden field), and route-level throttling. A `(email, book_code)` unique constraint handles race conditions between the duplicate check and the insert.

### Site config (`config/site.php`)

Central config for: site title (`title`), per-locale hero titles (`titles`), book title (`book_title`), URL-safe book slug (`book_slug`), contact email, available locales (`locales`), and `default_locale`. Adding a new locale requires adding it to `locales` and mirroring the content directory tree.
