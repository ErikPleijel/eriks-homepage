@props([
    'book' => 'faustian-bargain', // key into config/book-blurb.php
])

@php
    $locale = app()->getLocale();
    $isSv   = $locale === 'sv';
    $blurb  = config("book-blurb.$book.$locale");

    $label = [
        'about' => $isSv ? 'Om boken' : 'About this book',
        'close' => $isSv ? 'Stäng'    : 'Close',
    ];
@endphp

<div x-data="{ open: false }">
    <div class="flex flex-col items-center justify-center gap-3">

        <button type="button" @click="open = true" class="btn-action btn-stone cursor-pointer">
            {{ $label['about'] }}
        </button>
    </div>

    {{-- Blurb modal --}}
    <div
        x-show="open"
        x-cloak
        x-transition.opacity
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        style="display: none;"
    >
        <div
            @click.outside="open = false"
            x-transition
            class="max-h-[85vh] w-full max-w-lg overflow-y-auto rounded-lg bg-[#faf7f2] p-6 text-stone-700 shadow-xl"
        >
            <p class="font-semibold italic">&ldquo;{{ $blurb['quote'] }}&rdquo;</p>

            @foreach ($blurb['paragraphs'] as $para)
                <p class="mt-3">{{ $para }}</p>
            @endforeach

            <p class="mt-3">
                <strong>{{ $blurb['closing']['title'] }}</strong>{!! $blurb['closing']['text'] !!}
            </p>

            <p class="mt-3">{{ $blurb['cta'] }}</p>

            <button type="button" @click="open = false" class="btn-action btn-stone mt-5 cursor-pointer">
                {{ $label['close'] }}
            </button>
        </div>
    </div>
</div>
