# Decisions

Non-obvious choices made while scaffolding `eriks-homepage`. Kept here so the
reasoning survives even when the code doesn't make it self-evident.

## Stack & conventions

- **Laravel 12 + Tailwind v4 + Vite, Alpine.js via npm.** Tailwind v4 and Vite
  ship by default in Laravel 12 (`@tailwindcss/vite` in `vite.config.js`, no
  `tailwind.config.js`, no PostCSS). Alpine was added with `npm install alpinejs`
  and imported in `resources/js/app.js`, mirroring the sibling
  `redcross_volunteers` project. That project pins Tailwind v3; we intentionally
  stay on the Laravel 12 default (v4) rather than downgrading to match it.
- **Local serving = `php artisan serve` + `npm run dev`.** The reference project
  uses `artisan serve` (and `composer run dev`), not an XAMPP vhost pointed at
  `public/`. We mirror that — no Apache vhost is configured for this project.
- **Alpine init guard.** `app.js` only calls `Alpine.start()` when
  `window.Alpine` is unset, copied from `redcross_volunteers` so the bundle can
  never double-initialize Alpine if a CDN copy is ever added to a page.

## Site title vs book title

These are two deliberately different strings and must never be conflated:

- `config('site.title')` = **"The Anchor in the Storm"** — the website's name.
  Used in the `<title>` tag and the site header on every page.
- `config('site.book_title')` = **"Faustian Bargain? No Thanks!"** — the book
  itself. Used only where we refer to the book (the Amazon CTA, cover alt text).

Both live in `config/site.php` so there is a single source of truth and no magic
strings scattered through Blade. The spec only asked for `locales` and
`default_locale` in that file; the two titles were added there for the same
"one place, no conflation" reason.

## Locale routing

- **`config/site.php`** holds `locales` (`en`/`sv`) and `default_locale` (`en`).
  The locale list is keyed by URL code → human label, so the same array drives
  both middleware validation and the language switcher.
- **`SetLocale` middleware** reads the `{locale}` route segment, and
  `abort_unless(array_key_exists($locale, config('site.locales')), 404)` — an
  unknown locale 404s instead of silently falling back to the default, so bad
  URLs don't quietly render the wrong language. On success it calls
  `App::setLocale()`.
- Registered as the alias **`setlocale`** in `bootstrap/app.php` (Laravel 12 has
  no `Kernel.php`) and applied to the `{locale}` route group, rather than pushed
  onto the global `web` group — only locale-prefixed routes need it.
- **`/` redirects to `/{default_locale}`** (`/en`). The site is always served
  under a locale segment; there is no locale-less page.
- **Chapter route** resolves `content.{locale}.chapters.{chapter}` and
  `abort_unless(view()->exists(...), 404)`, so chapters 2–10 (stubs that *do*
  exist) return 200, while a truly missing chapter returns 404.

## Content folder convention

Views live under `resources/views/content/{locale}/...` (`home.blade.php`,
`chapters/chapter-N.blade.php`). Routes interpolate the active locale into the
view name, so adding a locale is: add it to `config/site.php` + create its
`content/{locale}` folder. No per-locale route definitions.

## Blade components

- **`quote-card`** — props `text` (required) and optional `attribution`; renders
  a `<figure>/<blockquote>/<figcaption>`. Attribution is omitted entirely when
  not supplied.
- **`carousel`** — Alpine-powered, slides passed via the slot as direct
  children. Slide count is read from `$refs.track.children.length` at `init`, so
  it works for any number of slides without a count prop. Navigation slides the
  track with a CSS `translateX`; prev/next wrap around; dots are generated from
  the count.
- **`toc`** — loops over an `items` array of `['title' => ..., 'route' => ...]`.
  `route` is a ready-made URL built by the caller (with `route()`), keeping the
  component locale-agnostic. Optional `heading`.
- **`language-switcher`** — iterates `config('site.locales')` and rebuilds the
  current path with the first URL segment (always the locale) swapped, so
  switching language keeps the visitor on the same page. The active locale is
  rendered as plain text, not a link.
- **`layout`** — the main layout; puts `config('site.title')` in `<title>` and
  the header. Accepts an optional per-page `title` prop, rendered as
  `"{page} — {site}"`.

## Footnote modal — shared Alpine scope (not a global store)

The spec described "an Alpine store (x-data on the layout)". Those are two
different Alpine concepts; we went with the **x-data reading**:

- `Alpine.data('footnotes', ...)` is registered in `app.js` and mounted **once**
  via `x-data="footnotes"` on the layout's `<body>`.
- Every `<x-footnote-trigger>` and the single `<x-footnote-modal>` are
  descendants of that root, so they all share the one scope through normal
  Alpine scope inheritance. One modal serves every footnote on the page.
- A trigger calls `show(label, text)` (strings encoded into the Alpine
  expression with `@js()`); the modal binds `open`/`label`/`body`.

Why not `Alpine.store('footnotes')` (a truly global store)? A store would also
work, but the modal and triggers are always inside the layout root, so a
scoped `Alpine.data` component achieves the identical "one modal, all triggers"
outcome with simpler, more local reasoning and no global state. `[x-cloak]` is
defined in `app.css` so the modal stays hidden until Alpine boots.

## Out of scope (separate follow-ups)

Intentionally **not** built: the `site_events` table and any pageview/click
logging (cookie-free design, decided but not yet built), the pre-order email
table, and real content for chapters 2–10 (stubs only).
