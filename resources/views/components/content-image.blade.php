@props([
    'src',
    'alt',
    'caption'     => null,
    'align'       => null,  // 'right' floats the figure so the next paragraph wraps it;
                            // anything else (default) is a block-centered figure.
    'width'       => null,  // Desktop display width as a percentage, e.g. "60".
                            // Omitted = 100 (centered) or 50 (right-float) of the text column.
    'mobileWidth' => null,  // Mobile width % for centered figures only. Omitted = max(width, 90)

])

@php
    $isRight = $align === 'right';

    // Desktop width (% of the text column). Default differs by alignment:
    // right-floats default to 50 (matching the old sm:w-1/2); centered default to 100.
    $desktopW = $isRight ? (int)($width ?? 50) : (int)($width ?? 100);

    // Mobile width for centered figures: floor at 90% so a narrow desktop image
    // doesn't become tiny on a phone. Right-floats always go full-width on mobile.
    $mobileW  = $isRight ? 100 : (int)($mobileWidth ?? max($desktopW, 90));

    // Both cases use CSS custom properties read by .content-image / .content-image-right
    // in app.css — inline styles can't do breakpoints on their own.
    $figureClass = $isRight
        ? 'content-image-right mt-4 mb-4 sm:float-right sm:ml-6 sm:mb-4'
        : 'content-image my-8 mx-auto';

    $figureStyle = $isRight
        ? "--img-w: $desktopW%;"
        : "--img-w: $desktopW%; --img-w-mobile: $mobileW%;";
@endphp

<figure {{ $attributes->merge(['class' => $figureClass]) }} style="{{ $figureStyle }}">
    <img src="{{ $src }}" alt="{{ $alt }}" class="w-full rounded-lg" />

    @if ($caption)
        <figcaption class="mt-2 text-center text-sm italic text-stone-500">
            {{ $caption }}
        </figcaption>
    @endif
</figure>
