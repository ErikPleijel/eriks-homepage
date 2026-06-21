@props(['meta'])

@php
    $locale        = app()->getLocale();
    $isSv          = $locale === 'sv';
    $chapUrl       = url('/') . '#chapters';
    $contentsLabel = $isSv ? 'Kapitel' : 'Chapters';
    $aboutLabel    = $isSv ? 'Om boken'  : 'About the book';
    $closeLabel    = $isSv ? 'Stäng'     : 'Close';
    $blurb         = config('book-blurb.faustian-bargain.'.$locale);
@endphp

<div x-data="{ blurbOpen: false }">
    <p class="chapter-book-title">{{ config('site.book_titles.'.$locale, config('site.book_title')) }}</p>
    <p class="chapter-kicker">
        {{ $meta['kicker'] }} &middot;
        <a href="{{ $chapUrl }}" class="chapter-toc-link">{{ $contentsLabel }}</a> &middot;
        <a href="#" @click.prevent="blurbOpen = true" class="chapter-toc-link">{{ $aboutLabel }}</a>
    </p>
    <h1 class="chapter-title">{{ $meta['heading'] }}</h1>

    <div x-show="blurbOpen" x-cloak x-transition.opacity @keydown.escape.window="blurbOpen = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" style="display: none;">
        <div @click.outside="blurbOpen = false" x-transition
             class="max-h-[85vh] w-full max-w-lg overflow-y-auto rounded-lg bg-[#faf7f2] p-6 text-stone-700 shadow-xl">
            <p class="font-semibold italic">&ldquo;{{ $blurb['quote'] }}&rdquo;</p>
            @foreach ($blurb['paragraphs'] as $para)
                <p class="mt-3">{{ $para }}</p>
            @endforeach
            <p class="mt-3">
                <strong>{{ $blurb['closing']['title'] }}</strong>{!! $blurb['closing']['text'] !!}
            </p>
            <p class="mt-3">{{ $blurb['cta'] }}</p>
            <button type="button" @click="blurbOpen = false" class="btn-action btn-stone mt-5 cursor-pointer">
                {{ $closeLabel }}
            </button>
        </div>
    </div>
</div>
