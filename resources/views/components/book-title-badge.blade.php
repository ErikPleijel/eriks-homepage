@props([
    'title'    => null,
    'subtitle' => null,
])

@php
    $isSv = app()->getLocale() === 'sv';

    $title = $isSv ? 'Faustisk pakt? Nej tack!' : 'Faustian Bargain? No Thanks!';
    $subtitle = $isSv ? 'Gratis onlineversion' : 'Free online version';
@endphp

<div class="my-3 flex flex-col items-center">
    <span class="inline-block rounded border-x border-stone-200 border-t-[3px] border-t-yellow-600 border-b-[3px] border-b-yellow-600 bg-[#faf7f2] px-6 py-2.5 text-center font-serif text-2xl font-semibold tracking-wide text-[#1a2a44] shadow-sm">
        {{ $title }}
        <span class="mt-1 block text-[0.7em] font-normal uppercase tracking-wider text-amber-800/80">
            {{ $subtitle }}
        </span>
    </span>
</div>
