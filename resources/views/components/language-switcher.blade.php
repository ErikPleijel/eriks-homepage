@php
    // Rebuild the current path with the locale segment swapped, so switching
    // language keeps the visitor on the same page. The locale is always the
    // first URL segment (routes live under the {locale} prefix).
    $segments = request()->segments();
    $current = app()->getLocale();
@endphp

<nav class="flex items-center gap-2 text-sm" aria-label="Language">
    @foreach (config('site.locales') as $code => $label)
        @php
            $target = $segments;
            $target[0] = $code;            // first segment is the locale
            $href = url(implode('/', $target) ?: $code);
        @endphp

        @if ($code === $current)
            <span class="font-semibold text-stone-900" aria-current="true">{{ $label }}</span>
        @else
            <a href="{{ $href }}" class="text-stone-500 hover:text-stone-900">{{ $label }}</a>
        @endif
    @endforeach
</nav>
