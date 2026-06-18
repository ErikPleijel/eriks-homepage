@props([
    'title' => null,
    'tagline' => 'ErikPleijel.com',
    'compact' => false,
])

@php
    // Default to the localized site title (falls back to the canonical one).
    $title ??= config('site.titles.'.app()->getLocale(), config('site.title'));

    // Two sizes: the full landing banner (home) and a slim band used on every
    // other page. Same elements, scaled down.
    $sectionStyle = $compact ? '' : 'min-height: 62vh;';
    $innerPad     = $compact ? 'px-6 py-10 sm:py-12'        : 'px-6 py-16';
    $iconSize     = $compact ? 'w-12 sm:w-14'               : 'w-16 sm:w-20 md:w-24';
    $titleSize    = $compact ? 'text-2xl sm:text-3xl'       : 'text-4xl sm:text-5xl md:text-6xl';
    $titleMargin  = $compact ? 'mt-3'                       : 'mt-6';
    $dividerWidth = $compact ? 'w-16'                       : 'w-24';
    $dividerMargin= $compact ? 'my-3'                       : 'my-5';
    $taglineSize  = $compact ? 'text-xs sm:text-sm'         : 'text-base sm:text-lg';

    $homeUrl = route('home', ['locale' => app()->getLocale()]);
@endphp

{{--
    Full-bleed banner: the Bondi seascape as a cover background with centered,
    stacked content on top — anchor icon, site title, divider, tagline.

    The photo is bright/white-toned, so the title and tagline use a text-shadow
    (rather than a dark overlay) for legibility. The title links home so there's
    a way back from inner pages (the header no longer shows the title). Pass
    `:compact="true"` for the slim variant used outside the home page.
--}}
<section
    class="relative flex w-full items-center justify-center bg-cover bg-center bg-no-repeat text-center text-white"
    style="background-image: url('{{ asset('images/hero/bondi.jpg') }}'); {{ $sectionStyle }}"
>
    <div class="flex flex-col items-center {{ $innerPad }}">
        {{-- Anchor icon, with a soft drop-shadow so it separates from the
             lighter sky/foam. --}}
        <img src="{{ asset('images/hero/anchor.png') }}" alt="anchor"
             class="{{ $iconSize }} drop-shadow-lg" />

        <h1 class="{{ $titleMargin }} {{ $titleSize }} font-bold tracking-tight"
            style="text-shadow: 0 2px 8px rgba(0,0,0,0.6);">
            <a href="{{ $homeUrl }}" class="transition hover:opacity-90">{{ $title }}</a>
        </h1>

        {{-- Divider: a styled line, not literal Unicode characters. --}}
        <hr class="{{ $dividerMargin }} {{ $dividerWidth }} border-0 border-t-2 border-white/90"
            style="box-shadow: 0 1px 4px rgba(0,0,0,0.4);" />

        <p class="{{ $taglineSize }} font-medium tracking-wide"
           style="text-shadow: 0 2px 8px rgba(0,0,0,0.6);">
            {{ $tagline }}
        </p>
    </div>
</section>
