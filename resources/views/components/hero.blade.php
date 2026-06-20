@props([
    'title' => null,
    'tagline' => 'ErikPleijel.com',
    'compact' => false,
    'asH1' => true,
])

@php
    // Default to the localized site title (falls back to the canonical one).
    $title ??= config('site.titles.'.app()->getLocale(), config('site.title'));

    // Two sizes: the full landing banner (home) and a slim band used on every
    // other page. On mobile we always render the compact size regardless of
    // $compact; the larger sizes only kick in at sm:+ when not compact.
    $sectionStyle = '';
    $sectionHeight = $compact ? '' : 'min-h-[38vh] sm:min-h-[62vh]';
    $innerPad     = $compact ? 'px-6 py-10 sm:py-12'             : 'px-6 py-10 sm:py-16';
    $iconSize     = $compact ? 'w-12 sm:w-14'                    : 'w-12 sm:w-20 md:w-24';
    $titleSize    = $compact ? 'text-2xl sm:text-3xl'            : 'text-2xl sm:text-5xl md:text-6xl';
    $titleMargin  = $compact ? 'mt-3'                            : 'mt-3 sm:mt-6';
    $dividerWidth = $compact ? 'w-16'                            : 'w-16 sm:w-24';
    $dividerMargin= $compact ? 'my-3'                            : 'my-3 sm:my-5';
    $taglineSize  = $compact ? 'text-xs sm:text-sm'              : 'text-xs sm:text-lg';

    $homeUrl = url('/');
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
    class="relative flex w-full items-center justify-center bg-cover bg-center bg-no-repeat text-center text-white {{ $sectionHeight }}"
    style="background-image: url('{{ asset('images/hero/bondi.jpg') }}');"
>
    {{-- Flag-pair language switch, pinned to the top-right corner of the hero. --}}
    <div class="absolute top-3 right-4 md:hidden">
        <x-language-switch />
    </div>

    <div class="flex flex-col items-center {{ $innerPad }}">
        {{-- Anchor icon, with a soft drop-shadow so it separates from the
             lighter sky/foam. --}}
        <img src="{{ asset('images/hero/anchor.png') }}" alt="anchor"
             class="{{ $iconSize }} drop-shadow-lg" />

        @if($asH1)
            <h1 class="{{ $titleMargin }} {{ $titleSize }} font-bold tracking-tight"
                style="text-shadow: 0 2px 8px rgba(0,0,0,0.6);">
                <a href="{{ $homeUrl }}" class="transition hover:opacity-90">{{ $title }}</a>
            </h1>
        @else
            <p class="{{ $titleMargin }} {{ $titleSize }} font-bold tracking-tight"
               style="text-shadow: 0 2px 8px rgba(0,0,0,0.6);">
                <a href="{{ $homeUrl }}" class="transition hover:opacity-90">{{ $title }}</a>
            </p>
        @endif

        {{-- Divider: a styled line, not literal Unicode characters. --}}
        <hr class="{{ $dividerMargin }} {{ $dividerWidth }} border-0 border-t-2 border-white/90"
            style="box-shadow: 0 1px 4px rgba(0,0,0,0.4);" />

        <p class="{{ $taglineSize }} font-medium tracking-wide"
           style="text-shadow: 0 2px 8px rgba(0,0,0,0.6);">
            {{ $tagline }}
        </p>
    </div>
</section>
