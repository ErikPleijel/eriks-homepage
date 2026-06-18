@props([
    'number' => null,
    'label'  => null,
])

{{--
    PLACEHOLDER for the "Food for thought" reflection block that closes every
    chapter (content not finalized yet). Same dashed / muted treatment as
    <x-quotecard> so stand-ins are consistent and easy to find.

    Usage:
      End of a numbered chapter : <x-food-for-thought :number="1" />
      End of the introduction   : <x-food-for-thought label="Introduction" />
--}}
<div class="my-8 rounded-lg border-2 border-dashed border-stone-400 bg-stone-100 p-5 text-stone-500">
    <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">Placeholder</p>
    <div class="mt-2 italic">
        @if ($label)
            Food for thought: {{ $label }}
        @else
            Food for thought #{{ $number }}
        @endif
    </div>
</div>
