@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    {{-- CSRF token for the cookie-free click logger (window.logEvent). Uses the
         session's existing token — no new cookie. --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Site title ("The Anchor in the Storm") on every page; an optional
         per-page title is prepended. NOT the book title. --}}
    <title>{{ $title ? $title.' — '.config('site.title') : config('site.title') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- x-data="footnotes" mounts the shared footnote scope on the layout root so
     the single <x-footnote-modal/> below serves every <x-footnote-trigger/>
     rendered inside {{ $slot }}. --}}
<body x-data="footnotes" class="min-h-screen bg-stone-50 text-stone-900 antialiased font-sans">
    <header class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-3xl items-center justify-end px-6 py-4">
            {{-- Every page shows a hero (full on home, slim elsewhere) and the
                 hero carries the site title + home link, so the header title is
                 suppressed to avoid showing it twice. Kept as sr-only for screen
                 readers / the document landmark. --}}
            <span class="sr-only">{{ config('site.titles.'.app()->getLocale(), config('site.title')) }}</span>

        </div>
    </header>

    {{-- Full-width hero, between header and the constrained main. The home page
         supplies its full-size banner via <x-slot:hero>; every other page gets
         the slim default below. --}}
    @isset($hero)
        {{ $hero }}
    @else
        <x-hero :compact="true" />
    @endisset

    <x-main-nav />

    <main class="mx-auto max-w-2xl px-6 py-10">
        {{ $slot }}
    </main>

    <footer class="border-t border-stone-200 py-8 text-center text-sm text-stone-500">
        &copy; {{ date('Y') }} {{ config('site.title') }}
    </footer>

    {{-- One modal instance for the whole page. --}}
    <x-footnote-modal />
</body>
</html>
