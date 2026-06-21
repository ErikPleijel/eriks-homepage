@props([
    'slides' => [],
    'book'   => null,
])

<div @if($book) data-book="{{ $book }}" @endif>
    <x-carousel>
        @foreach ($slides as $slide)
            <div class="max-h-100 overflow-hidden px-6 py-5 font-serif">
                <h2 class="carousel-title">{{ $slide['title'] }}</h2>
                @foreach ($slide['paragraphs'] as $paragraph)
                    <p class="carousel-text">{{ $paragraph }}</p>
                @endforeach
            </div>
        @endforeach
    </x-carousel>
</div>
