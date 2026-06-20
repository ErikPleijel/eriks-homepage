@php
    $locale = app()->getLocale();
    if (app()->environment('local')) {
        $enUrl = url('/') . '?locale=en';
        $svUrl = url('/') . '?locale=sv';
    } else {
        $enUrl = 'https://erikpleijel.com/';
        $svUrl = 'https://erikpleijel.se/';
    }
@endphp


<div class="flex items-center gap-1.5" role="navigation" aria-label="Language">
    @if ($locale === 'en')
        <span aria-current="true" class="block opacity-40" title="English (current)">
            <img src="{{ asset('images/flags/uk.svg') }}"
                 alt="English"
                 class="h-4 w-6 rounded-sm object-cover shadow-sm" />
        </span>
        <a href="{{ $svUrl }}"
           class="block transition-transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-stone-400 rounded-sm"
           aria-label="Byt till svenska">
            <img src="{{ asset('images/flags/se.svg') }}"
                 alt="Svenska"
                 class="h-4 w-6 rounded-sm object-cover shadow-sm" />
        </a>
    @else
        <a href="{{ $enUrl }}"
           class="block transition-transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-stone-400 rounded-sm"
           aria-label="Switch to English">
            <img src="{{ asset('images/flags/uk.svg') }}"
                 alt="English"
                 class="h-4 w-6 rounded-sm object-cover shadow-sm" />
        </a>
        <span aria-current="true" class="block opacity-40" title="Svenska (aktuell)">
            <img src="{{ asset('images/flags/se.svg') }}"
                 alt="Svenska"
                 class="h-4 w-6 rounded-sm object-cover shadow-sm" />
        </span>
    @endif
</div>
