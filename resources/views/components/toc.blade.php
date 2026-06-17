@props([
    'items' => [],
    'heading' => null,
])

{{--
    Table of contents. Pass an array of ['title' => ..., 'route' => ...]
    where 'route' is a ready-to-use URL (build it with route()/url() in the
    caller so this component stays locale-agnostic).
--}}
<nav {{ $attributes->merge(['class' => 'my-8']) }} aria-label="{{ $heading ?? 'Table of contents' }}">
    @if ($heading)
        <h2 class="mb-3 text-lg font-semibold">{{ $heading }}</h2>
    @endif

    <ol class="space-y-1">
        @foreach ($items as $item)
            <li class="flex gap-2">
                <span class="text-stone-400">{{ $loop->iteration }}.</span>
                <a href="{{ $item['route'] }}" class="text-amber-700 underline-offset-2 hover:underline">
                    {{ $item['title'] }}
                </a>
            </li>
        @endforeach
    </ol>
</nav>
