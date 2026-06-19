@props([
    'heading' => null,
    'items'   => null,  // null = auto-fetch via ChapterData; pass an array to override
])

{{--
    Table of contents. Auto-fetches data from config/chapters.php via
    ChapterData when no items prop is passed; callers need no setup:

        <x-toc heading="Chapters" />

    Pass :items to override with a legacy flat array:
        ['label' => '1.', 'title' => '…', 'route' => '…']
--}}

@php
    $tocItems     = $items ?? \App\Support\ChapterData::tocItems(app()->getLocale());
    $isStructured = $items === null;
@endphp

<nav {{ $attributes->merge(['class' => 'my-8']) }} aria-label="{{ $heading ?? 'Table of contents' }}">

    @if ($heading)
        <h2 class="mb-4 text-lg font-semibold">{{ $heading }}</h2>
    @endif

    @if ($isStructured)

        {{-- ── Structured format: intro, part dividers, chapter links ─────── --}}
        <div>
            @foreach ($tocItems as $item)

                @if ($item['type'] === 'intro')
                    <div class="mb-4">
                        <a href="{{ $item['url'] }}"
                           class="text-amber-700 underline-offset-2 hover:underline">
                            {{ $item['title'] }}
                        </a>
                    </div>

                @elseif ($item['type'] === 'part')
                    <p class="mt-6 mb-2 text-xs font-semibold uppercase tracking-wide text-stone-400">
                        {{ $item['label'] }}
                    </p>

                @elseif ($item['type'] === 'chapter')
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="shrink-0 w-6 text-right text-sm text-stone-400">
                            {{ $item['number'] }}.
                        </span>
                        <a href="{{ $item['url'] }}"
                           class="text-amber-700 underline-offset-2 hover:underline">
                            {{ $item['title'] }}
                        </a>
                    </div>

                @endif

            @endforeach
        </div>

    @else

        {{-- ── Legacy flat format for callers passing their own :items array ─ --}}
        <ol class="space-y-1">
            @foreach ($tocItems as $item)
                @php
                    $prefix = array_key_exists('label', $item)
                        ? $item['label']
                        : ($loop->iteration . '.');
                @endphp
                <li class="flex items-baseline gap-2">
                    @if ($prefix)
                        <span class="shrink-0 text-stone-400">{{ $prefix }}</span>
                    @endif
                    <a href="{{ $item['route'] }}"
                       class="text-amber-700 underline-offset-2 hover:underline">
                        {{ $item['title'] }}
                    </a>
                </li>
            @endforeach
        </ol>

    @endif

</nav>
