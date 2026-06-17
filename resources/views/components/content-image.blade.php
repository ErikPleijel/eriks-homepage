@props([
    'src',
    'alt',
    'caption' => null,
    'align' => null, // 'right' floats the figure so the next paragraph wraps it;
                     // anything else (default) is a block-centered figure.
])

@php
    $isRight = $align === 'right';

    // Right: float beside the following text on >=sm screens (stacks on mobile).
    // Default: a centered block figure with a constrained width.
    $figureClass = $isRight
        ? 'mb-4 w-full sm:float-right sm:ml-6 sm:mb-4 sm:w-1/2 sm:max-w-xs'
        : 'my-8 mx-auto max-w-lg';
@endphp

<figure {{ $attributes->merge(['class' => $figureClass]) }}>
    <img src="{{ $src }}" alt="{{ $alt }}" class="w-full rounded-lg" />

    @if ($caption)
        <figcaption class="mt-2 text-center text-sm italic text-stone-500">
            {{ $caption }}
        </figcaption>
    @endif
</figure>
