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

    // Compare paths only — avoids APP_URL vs real request host mismatch.
    // request()->path() returns 'sv/slug' or 'slug' (no leading slash).
    $currentPath = request()->path();
    $navItems    = array_values(array_filter($tocItems, fn($i) => isset($i['url'])));
    $currentUrl  = null;
    $nextUrl     = null;
    foreach ($navItems as $idx => $nav) {
        if (ltrim(parse_url($nav['url'], PHP_URL_PATH), '/') === $currentPath) {
            $currentUrl = $nav['url'];
            $nextUrl    = $navItems[$idx + 1]['url'] ?? null;
            break;
        }
    }
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
                    @php $isCurrent = $item['url'] === $currentUrl; $isNext = $item['url'] === $nextUrl; @endphp
                    <div class="mb-4">
                        @if ($isCurrent)
                            <span class="text-stone-400">{{ $item['title'] }}</span>
                        @else
                            <a href="{{ $item['url'] }}"
                               class="text-amber-700 underline-offset-2 hover:underline {{ $isNext ? 'underline' : '' }}">
                                {{ $item['title'] }}
                            </a>
                        @endif
                    </div>

                @elseif ($item['type'] === 'part')
                    <p class="mt-6 mb-2 text-xs font-semibold uppercase tracking-wide text-stone-400">
                        {{ $item['label'] }}
                    </p>

                @elseif ($item['type'] === 'chapter')
                    @php $isCurrent = $item['url'] === $currentUrl; $isNext = $item['url'] === $nextUrl; @endphp
                    <div class="flex items-baseline gap-2 mt-1">
                        <span class="shrink-0 w-6 text-right text-sm text-stone-400">
                            {{ $item['number'] }}.
                        </span>
                        @if ($isCurrent)
                            <span class="text-stone-400">{{ $item['title'] }}</span>
                        @else
                            <a href="{{ $item['url'] }}"
                               class="text-amber-700 underline-offset-2 hover:underline {{ $isNext ? 'underline' : '' }}">
                                {{ $item['title'] }}
                            </a>
                        @endif
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
