@props([
    'slides' => [],
    'book'   => null,
])

<div @if($book) data-book="{{ $book }}" @endif>
    <x-carousel>
        @foreach ($slides as $slide)
            <div class="px-8 py-6 pb-12">
                <h2 class="chapter-title">{{ $slide['title'] }}</h2>
                @foreach ($slide['paragraphs'] as $paragraph)
                    <p class="chapter-text">{{ $paragraph }}</p>
                @endforeach
            </div>
        @endforeach
    </x-carousel>
</div>
