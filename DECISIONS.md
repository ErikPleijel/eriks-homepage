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
  `abort_unless(view()->exists(...), 404)`, so chapters 2–12 (stubs that *do*
  exist) return 200, while a truly missing chapter returns 404. There is no
  hardcoded chapter-number range — availability is driven purely by whether the
  Blade view exists, so extending the book is just a matter of adding files.

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

## Chapter count corrected 10 → 12

The scaffold assumed **10** chapters; the book actually has **12**, which is
what the live site's TOC shows. Corrected by:

- Adding `chapter-11`/`chapter-12` stub views in both `content/en/chapters` and
  `content/sv/chapters`, matching the chapters 2–10 stub pattern.
- Extending both home-page TOCs to 12 entries. The chapter route needed **no**
  change — it 404s on view existence, not a number range, so the new stubs are
  enough.
- The English TOC now carries the real chapter titles (from the live site).
  **Chapter 1's title is still a placeholder** (`"Chapter 1"`) pending the final
  wording. Swedish titles remain placeholders (`"Kapitel N"`) for now.

## Cookie-free visit & click logging

Visit/click analytics that needs **no consent banner** because it sets no
tracking cookie and stores nothing that identifies a visitor.

**What is stored** (`site_events` table, model `App\Models\SiteEvent`):

- `event_type` — `'pageview'` or `'click'`.
- `path` — the requested path (e.g. `en/chapters/chapter-1`), no leading slash.
- `locale` — for pageviews, `app()->getLocale()`; for clicks, derived from the
  first segment of the path the client reported (the click endpoint isn't
  locale-prefixed, so we can't read the app locale there).
- `referrer_host` — **host only**, parsed from the `Referer` header with
  `parse_url(..., PHP_URL_HOST)`. We deliberately drop the full referring URL
  because it can carry query strings.
- `label` — the click target's label (null for pageviews).
- `created_at` only. There is no `updated_at`: events are write-once, so the
  model sets `const UPDATED_AT = null;` and the migration creates a single
  `timestamp('created_at')`.

**What is deliberately NOT stored:** the visitor's **IP address**, the
**user-agent** string, and **any cross-session identifier** (no tracking
cookie, no localStorage id, no fingerprint). Aggregate counts only — you can
tell *how many* pageviews/clicks happened, never *who*. The only cookie in play
is Laravel's existing functional session cookie; the click endpoint reuses its
CSRF token rather than introducing any new cookie.

**How it's wired:**

- `LogPageView` middleware writes the `'pageview'` event. It's applied
  **directly to the home and chapter routes**, not globally, so assets, the
  `/events/click` endpoint, and everything else are never logged. Only `GET`s
  are recorded.
- `POST /events/click` → `EventController::click` writes the `'click'` event.
  It keeps standard web-group CSRF and is rate-limited with `throttle:30,1`.
- `resources/js/events.js` exposes `window.logEvent(label)`, which `fetch`es the
  click endpoint with the current path and the CSRF token from the
  `<meta name="csrf-token">` tag (added to the layout). It's fire-and-forget
  (`keepalive: true`, errors swallowed) so analytics can never break a page.
- **Example wiring only:** `window.logEvent('Amazon CTA')` is attached to the
  Amazon CTA on the home page (both locales). It is intentionally **not** added
  to every clickable element yet.

**Viewing the data:** no admin/stats UI exists yet. For now, query it via
`php artisan tinker`, e.g. `SiteEvent::where('event_type', 'pageview')->count()`
or `SiteEvent::where('event_type', 'click')->get(['label', 'path'])`. A proper
stats view is a future task.

## Printed-book interest sign-ups (supersedes "preorder_signups")

This feature is the Laravel-native port of the old one.com PHP form
(`/c/xampp/htdocs/tsv/register_interest.php`). **It replaces the earlier
`preorder_signups` design**, which was never built — build/use this instead.
Table `book_interest_subscribers`, model `App\Models\BookInterestSubscriber`,
controller `BookInterestController`, route `POST /book-interest`, component
`<x-book-interest-form>` (wired onto the home page in both locales).

**Why this table stores `consent_ip` / `consent_user_agent` (and `site_events`
deliberately does not):** these two columns are **GDPR consent documentation** —
a record that a specific person agreed to the stated terms, and the address /
client the agreement came from. That is a lawful-basis paper trail tied to an
identified individual who opted in, which is a different purpose from anonymous
traffic measurement. The no-IP / no-user-agent policy on `site_events` is about
*not* identifying anonymous visitors; it does not apply here, where the visitor
has knowingly handed over their email and consented. The two are intentionally
inconsistent for good reason.

**Schema notes:** `created_at` only (`const UPDATED_AT = null;` on the model, a
single `timestamp('created_at')` column). Unique index on `(email, book_code)`
so each email can register once per edition; a duplicate is reported as "already
on the list", never an error. `book_code` is `config('site.book_slug')` + the
active locale (`faustian-bargain-en` / `faustian-bargain-sv`); `book_slug` and
the GDPR `contact_email` live in `config/site.php` as the single source of truth.

**Anti-spam measures ported from the old form:**

- **Honeypot** — a hidden `website` field (`display:none`, an anti-bot trap, not
  an a11y concern). If it's filled, the controller exits **silently** (`back()`
  with no insert, no error, no message), matching the original rather than
  revealing the trap.
- **Minimum-time check** — instead of the old tamperable hidden `form_time`
  field, the form-load time is stored **server-side in the session** when the
  component renders (`BookInterestController::FORM_TIME_KEY`). A submission less
  than 3 seconds after load is treated as a bot and rejected with a generic
  "something went wrong, please try again" message.
- **Rate limiting** — Laravel `throttle:5,10` on the route (5 per 10 min, keyed
  by IP), replacing the old hand-rolled `SELECT COUNT(*) … INTERVAL 10 MINUTE`
  query.

**Consent text:** Swedish is the **original wording** carried over verbatim from
the one.com form; English is an adapted equivalent (not a literal translation).
The removal-request contact email is unchanged from the original
(`epost@erikpleijel.se`, now `config('site.contact_email')`).

**Viewing the data:** as with `site_events`, no admin UI yet — query via
`php artisan tinker`, e.g. `BookInterestSubscriber::count()`.

## Chapter content & the `content-image` component

Chapter 1 (`content/en/chapters/chapter-1.blade.php`) is the first real chapter
text, replacing the stub. Its TOC title in `content/en/home.blade.php` is now
**"Breakout: Escaping the Prison of Toxic Passions"** (was the "title TBD"
placeholder). The footnote uses the existing `<x-footnote-trigger>` /
`<x-footnote-modal>` pair — no new footnote mechanism.

**`content-image` component** (`resources/views/components/content-image.blade.php`)
— a small reusable `<figure>` for in-chapter images, built now because the
remaining 11 chapters need the same thing. Props:

- `src`, `alt` (required), `caption` (optional — omitted entirely when absent).
- `align` — `'right'` floats the figure so the following paragraph wraps it;
  any other value (the default) is a block-centered figure with a constrained
  width. Mirrors the `quote-card` prop style (required + optional, `$attributes`
  merged so callers can still add classes).

**Images are self-hosted, not hotlinked.** Both chapter-1 images were downloaded
from the old site and saved under `public/images/chapters/chapter-1/`
(`compass_ff.png`, `prst_hund.png`); the Blade references local `/images/...`
paths. Convention for future chapters: `public/images/chapters/chapter-N/`.

**Interpretive calls made while building this (flagged for review):**

1. **Content warning styling.** The brief asked for "a distinct callout/alert
   block, not a plain paragraph" but left the treatment open. Rendered it as an
   amber left-border callout (`border-l-4 border-amber-500 bg-amber-50`,
   `role="note"`) — reusing the site's existing amber accent (as on
   `quote-card`) to signal caution without an alarming full-red error style.
2. **Right-aligned image is responsive.** `align="right"` only floats from the
   `sm` breakpoint up; on narrow/mobile screens the figure goes full-width and
   stacks above its paragraph, since a hard float would crush the wrapping text
   on a phone. The `prst_hund.png` image has no caption, per the source.

## Home-page hero & the `hero` component

The home page opens with a full-bleed banner: the Bondi seascape as a cover
background, with centered stacked content on top — the anchor icon, the site
title (`<h1>`), a divider, and the `ErikPleijel.com` tagline.

**`hero` component** (`resources/views/components/hero.blade.php`) — a dedicated,
reusable component. Props: `title` (required) and `tagline` (default
`'ErikPleijel.com'`). The background photo and anchor icon are fixed hero assets
under `public/images/hero/` (`bondi.jpg`, `anchor.png`), downloaded from the old
site rather than hotlinked (same self-hosting convention as chapter images). The
home pages pass `title` per locale: English uses `config('site.title')` ("The
Anchor in the Storm"); Swedish passes the literal "Ankaret i stormen" (there's
no Swedish entry in `config/site.php`). The divider is a styled `<hr>` (a line
via `border-t`), not literal Unicode characters.

**Rendered via a `hero` named slot on the layout, not breakout CSS.** The layout
renders `{{ $hero }}` (when set) *between* the header and the constrained
`<main>`. Because `<body>` is unconstrained, the hero is naturally full-width —
avoiding the `100vw` / negative-margin "full-bleed" hacks and their horizontal-
scrollbar pitfalls. Chapter pages simply omit the slot.

**Suppressed duplicate title, keyed off the hero slot.** The site-wide header
normally shows the title as a home link. On any page that supplies a `hero`
slot, that title would appear twice, so the header renders it as `sr-only`
instead (kept in the DOM for screen readers / the landmark, but visually hidden;
the language switcher stays right via `justify-between`). Tying suppression to
the *presence of the hero slot* means it's automatic: home has a hero → no
duplicate; chapter pages have no hero → header title stays. No extra flag/prop.

**Text-shadow for legibility, not a dark overlay.** The photo is bright and
white-toned, so the title and tagline use `text-shadow: 0 2px 8px
rgba(0,0,0,0.6)` rather than darkening the image with a scrim — keeps the
seascape fully visible. The black anchor icon gets a `drop-shadow-lg` so it
separates from the light sky/foam, and the divider a subtle box-shadow. Starting
points (height `min-height: 62vh`, icon `w-16`→`w-24`, shadow values) chosen to
be adjusted to taste once rendered.

**Responsive:** icon steps `w-16` (64px) mobile → `w-20` (sm) → `w-24` (96px) md;
title `text-4xl` → `5xl` → `6xl`; everything stays centered via flex column.

## Shared chapter scaffolding (classes & components)

Infrastructure for populating the Introduction + chapters 2–12. Formalizes
chapter 1's patterns and adds the new ones the upcoming chapters need. Reference
these by name when building chapter content; don't re-define inline.

**Chapter typography classes** (`resources/css/app.css`, `@layer components`).
Extracted from chapter 1's repeated Tailwind strings so markup stays semantic
and every chapter is consistent — tweak once here, not across 24 files:

- `.chapter-kicker` — the "Chapter N" eyebrow `<p>` above the title.
- `.chapter-title` — chapter `<h1>`.
- `.chapter-heading` — section `<h2>`.
- `.chapter-lead` — the opening lead `<p>` (larger, italic).
- `.chapter-text` — body `<p>` (the workhorse).
- `.chapter-blockquote` — **longer** quoted passages (Bonhoeffer, Luther, Plato,
  Einstein, Marcus Aurelius, …): `<blockquote class="chapter-blockquote">`.
  Indented, left-bordered, lighter italic. Distinct from the `<x-quotecard>`
  placeholder (below) and from the existing styled `<x-quote-card>` component.

**Plain lists.** Tailwind's preflight strips list markers/padding and the
typography plugin isn't installed, so a bare `<ul><li>` would render bullet-less.
`app.css` restores `list-disc`/`list-decimal` + spacing scoped to the
`.prose-stone` content wrapper, so chapters can drop in a plain `<ul>`/`<ol>`
with no extra classes.

**`content-image` `width` prop.** New optional `width` (desktop display width as
a percentage, e.g. `width="60"`; omitted = 100% of the text column) for centered
figures. Mobile keeps images wide — defaults to `max(width, 90)%` so a narrow
desktop image isn't tiny on a phone — overridable via `mobile-width`. Implemented
with inline CSS custom properties (`--img-w` / `--img-w-mobile`) read by a media
query in `.content-image` (inline styles can't do breakpoints). The
`align="right"` float keeps its own fixed sizing and ignores `width`; `caption`
unchanged.

**`footnote-trigger` marker is a fixed asterisk.** The visible inline marker is
now `*` for every footnote instead of `[N]`. Purely cosmetic — the `label` is
still passed through to the shared footnote scope so the modal shows
"Footnote N", and it still feeds the accessible label. Modal mechanism unchanged.

**Placeholder components** (dashed border + muted background so they're obviously
temporary and easy to grep). Stand-ins for content that isn't finalized:

- `<x-quotecard>…hint text…</x-quotecard>` — short pull-quote stand-in; hint
  passed as the slot. (Note the naming: this *placeholder* is `quotecard` /
  `<x-quotecard>`; the existing *finished* styled quote is `quote-card` /
  `<x-quote-card>`.) Replace with a real `<x-quote-card>` or a
  `.chapter-blockquote` when the wording is settled.
- `<x-food-for-thought :number="N" />` — the closing reflection block that
  appears once at the end of every chapter; shows "Food for thought #N".

## Out of scope (separate follow-ups)

Intentionally **not** built: a stats/admin UI for the `site_events` data (query
via tinker for now — see above), an admin/export UI for
`book_interest_subscribers`, and real content for chapters 2–12 (stubs only;
chapter 1 is now done). All Swedish chapter titles, the Swedish chapter-1
content, and chapter titles 2–12's Swedish equivalents are still pending. The
earlier `preorder_signups` table/design is **dropped** in favour of
`book_interest_subscribers` (see above).
