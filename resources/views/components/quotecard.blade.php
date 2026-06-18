{{--
    PLACEHOLDER stand-in for a short pull-quote "card" whose final wording isn't
    settled yet. Visually distinct (dashed border, muted background) so it's
    obviously temporary and easy to grep/spot later. The hint text is passed as
    the slot, e.g.:

        <x-quotecard>Quote card: Can you be 100% honest…?</x-quotecard>

    Replace with finalized content when ready (a real <x-quote-card> for a short
    styled quote, or a <blockquote class="chapter-blockquote"> for a long one).
--}}
<div class="my-8 rounded-lg border-2 border-dashed border-stone-400 bg-stone-100 p-5 text-stone-500">
    <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">Placeholder · quote card</p>
    <div class="mt-2 italic">{{ $slot }}</div>
</div>
