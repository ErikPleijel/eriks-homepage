@props([
    'items' => [],
    'heading' => null,
])

{{--
    Table of contents. Pass an array of ['title' => ..., 'route' => ...] items
    where 'route' is a ready-to-use URL (build it with route()/url() in the caller
    so this component stays locale-agnostic).

    Optional 'label' key per item:
      - absent           → auto-numbered from loop iteration ("1.", "2.", …)
      - present + string → show that string (e.g. "1." for explicit chapter numbers)
      - present + null   → no prefix (use for unnumbered entries like Introduction)
--}}
<nav {{ $attributes->merge(['class' => 'my-8']) }} aria-label="{{ $heading ?? 'Table of contents' }}">
    @if ($heading)
        <h2 class="mb-3 text-lg font-semibold">{{ $heading }}</h2>
    @endif

    <ol class="space-y-1">
        @foreach ($items as $item)
            @php
                $prefix = array_key_exists('label', $item)
                    ? $item['label']
                    : ($loop->iteration . '.');
            @endphp
            <li class="flex items-baseline gap-2">
                @if($prefix)
                    <span class="shrink-0 text-stone-400">{{ $prefix }}</span>
                @endif
                <a href="{{ $item['route'] }}" class="text-amber-700 underline-offset-2 hover:underline">
                    {{ $item['title'] }}
                </a>
            </li>
        @endforeach
    </ol>
</nav>
