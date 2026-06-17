@props([
    'text',
    'attribution' => null,
])

<figure {{ $attributes->merge(['class' => 'my-8 rounded-lg border-l-4 border-amber-500 bg-white p-6 shadow-sm']) }}>
    <blockquote class="text-lg italic leading-relaxed text-stone-800">
        “{{ $text }}”
    </blockquote>

    @if ($attribution)
        <figcaption class="mt-3 text-sm font-medium text-stone-500">
            — {{ $attribution }}
        </figcaption>
    @endif
</figure>
