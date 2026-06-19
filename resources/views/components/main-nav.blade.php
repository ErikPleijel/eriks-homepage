@php
    $locale   = app()->getLocale();
    $isSv     = $locale === 'sv';
    $homeUrl  = route('home', ['locale' => $locale]);
    $chapUrl  = $homeUrl . '#chapters';
    $aboutUrl = $isSv
        ? route('about.sv', ['locale' => 'sv'])
        : route('about.en');

    $label = [
        'home'    => $isSv ? 'Hem'     : 'Home',
        'chaps'   => $isSv ? 'Kapitel' : 'Chapters',
        'about'   => $isSv ? 'Om mig'  : 'About me',
        'menu'    => $isSv ? 'Meny'    : 'Menu',
        'openmenu'=> $isSv ? 'Öppna meny' : 'Open menu',
        'nav'     => $isSv ? 'Webbplatsnavigering' : 'Site navigation',
    ];
@endphp

<nav x-data="{ open: false }"
     class="border-b border-stone-200 bg-stone-50 text-sm"
     aria-label="{{ $label['nav'] }}">
    <div class="mx-auto max-w-3xl px-6">

        {{-- ── Desktop bar ──────────────────────────────────────────────── --}}
        <div class="hidden md:flex items-center gap-6 py-2">
            <a href="{{ $homeUrl }}"
               class="text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['home'] }}
            </a>
            <a href="{{ $chapUrl }}"
               class="text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['chaps'] }}
            </a>
            <a href="{{ $aboutUrl }}"
               class="text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['about'] }}
            </a>
            <x-buy-book />
            <span class="ml-auto">
                <x-language-switch />
            </span>
        </div>

        {{-- ── Mobile: label + hamburger ────────────────────────────────── --}}
        <div class="flex items-center justify-between py-2 md:hidden">
            <span class="text-xs uppercase tracking-widest text-stone-400">
                {{ $label['menu'] }}
            </span>
            <button
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-controls="main-nav-mobile"
                aria-label="{{ $label['openmenu'] }}"
                class="rounded p-1 text-stone-500 transition-colors hover:text-stone-900 focus:outline-none focus:ring-2 focus:ring-stone-400">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- ── Mobile dropdown ──────────────────────────────────────────── --}}
        <div id="main-nav-mobile"
             x-show="open"
             x-transition:enter="transition duration-150 ease-out"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition duration-100 ease-in"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             class="md:hidden flex flex-col gap-2 border-t border-stone-100 py-3">
            <a href="{{ $homeUrl }}"
               @click="open = false"
               class="py-1 text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['home'] }}
            </a>
            <a href="{{ $chapUrl }}"
               @click="open = false"
               class="py-1 text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['chaps'] }}
            </a>
            <a href="{{ $aboutUrl }}"
               @click="open = false"
               class="py-1 text-stone-600 transition-colors hover:text-stone-900">
                {{ $label['about'] }}
            </a>
            <div class="py-0.5"><x-buy-book /></div>
            <div class="pt-2">
                <x-language-switch />
            </div>
        </div>

    </div>
</nav>
