@props(['title' => null, 'ogTitle' => null, 'ogDescription' => null, 'ogImage' => null, 'alternates' => null])

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

    @php
        // Single source of truth for the localized site name, used in <title>,
        // og:title, and the header's screen-reader-only text below.
        $siteTitle = config('site.titles.'.app()->getLocale(), config('site.title'));
    @endphp

    {{-- Site title ("The Anchor in the Storm" / locale-appropriate variant) on
         every page; an optional per-page title is prepended. NOT the book title. --}}
    <title>{{ $title ? $title.' — '.$siteTitle : $siteTitle }}</title>

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:title" content="{{ $ogTitle ?? $siteTitle }}">
    <meta property="og:description" content="{{ $ogDescription ?? config('site.descriptions.'.app()->getLocale(), config('site.descriptions.en')) }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/hero/'.( app()->getLocale() === 'sv' ? 'bondi-og-swe.jpg' : 'bondi-og.jpg')) }}">
    <meta name="twitter:card" content="summary_large_image">

    @if ($alternates)
        @if ($alternates['en'])
        <link rel="alternate" hreflang="en" href="{{ $alternates['en'] }}" />
        @endif
        @if ($alternates['sv'])
        <link rel="alternate" hreflang="sv" href="{{ $alternates['sv'] }}" />
        @endif
        <link rel="alternate" hreflang="x-default" href="{{ $alternates['en'] ?? $alternates['sv'] }}" />
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- x-data="footnotes" mounts the shared footnote scope on the layout root so
     the single <x-footnote-modal/> below serves every <x-footnote-trigger/>
     rendered inside {{ $slot }}. --}}
<body x-data="footnotes" class="min-h-screen overflow-x-hidden bg-stone-50 text-stone-900 antialiased font-sans">
<header class="border-b border-stone-200 bg-white">
    <div class="mx-auto flex max-w-3xl items-center justify-end px-6 py-4">
        {{-- Every page shows a hero (full on home, slim elsewhere) and the
             hero carries the site title + home link, so the header title is
             suppressed to avoid showing it twice. Kept as sr-only for screen
             readers / the document landmark. --}}
        <span class="sr-only">{{ $siteTitle }}</span>

    </div>
</header>

{{-- Full-width hero, between header and the constrained main. The home page
     supplies its full-size banner via <x-slot:hero>; every other page gets
     the slim default below. --}}
@isset($hero)
    {{ $hero }}
@else
    <x-hero :compact="true" :as-h1="false" />
@endisset

<x-main-nav />

<main class="mx-auto max-w-2xl px-6 py-10">
    {{ $slot }}
</main>


{{-- One modal instance for the whole page. --}}
<x-footnote-modal />
</body>
</html>
