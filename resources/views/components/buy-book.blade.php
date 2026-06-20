@props([
    'lang'   => null,  // null = auto-detect via app()->getLocale(); pass 'en'|'sv' to override
    'single' => false, // true = "Buy the book" / "Köp boken"; false = "Buy the books" / "Köp böckerna"
])

{{-- Google Fonts: Cinzel + Cormorant Garamond (browser deduplicates duplicate hrefs) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;1,400&family=Cinzel:wght@400&display=swap">

<style>
@media (prefers-reduced-motion: reduce) {
    .bb-backdrop, .bb-panel { transition-duration: 0.01ms !important; }
}
</style>

@php
    $locale     = $lang ?? app()->getLocale();
    $isSv       = $locale === 'sv';
    $uid        = 'bb_' . uniqid('', false);
    $btnLabel   = $single
        ? ($isSv ? 'Köp boken'      : 'Buy the book')
        : ($isSv ? 'Köp böckerna'   : 'Buy the books');
    $closeLabel = $isSv ? 'Stäng' : 'Close';
    $interestFormUrl = url('/intresseanmalan');


    // External-link icon reused throughout
    $extIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0 opacity-60" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/><path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/></svg>';

    $amazonLinks = [
        ['Amazon.com',    'https://www.amazon.com/dp/B0F7RFG64C'],
        ['Amazon.co.uk',  'https://www.amazon.co.uk/dp/B0F7RFG64C'],
        ['Amazon.ca',     'https://www.amazon.ca/dp/B0F7RFG64C'],
        ['Amazon.com.au', 'https://www.amazon.com.au/dp/B0F7RFG64C'],
        ['Amazon.de',     'https://www.amazon.de/dp/B0F7RFG64C'],
        ['Amazon.se',     'https://www.amazon.se/dp/B0F7RFG64C'],
    ];

    $adventuresLinks = [
        ['Amazon.com',    'https://www.amazon.com/dp/B0C2SM3M54'],
        ['Amazon.co.uk',  'https://www.amazon.co.uk/dp/B0C2SM3M54'],
        ['Amazon.ca',     'https://www.amazon.ca/dp/B0C2SM3M54'],
        ['Amazon.com.au', 'https://www.amazon.com.au/dp/B0C2SM3M54'],
        ['Amazon.de',     'https://www.amazon.de/dp/B0C2SM3M54'],
        ['Amazon.se',     'https://www.amazon.se/dp/B0C2SM3M54'],
    ];
@endphp

<script>
(function () {
    window[{{ Js::from($uid) }}] = function () {
        return {
            open: false,
            _kh:  null,

            init() {
                this._kh = (e) => { if (e.key === 'Escape' && this.open) this.close(); };
                document.addEventListener('keydown', this._kh);
            },

            // Alpine calls destroy() automatically when the component is removed from the DOM
            destroy() {
                document.removeEventListener('keydown', this._kh);
            },

            show() {
                this.open = true;
                document.body.style.overflow = 'hidden';
                this.$nextTick(() => this.$refs.panel && this.$refs.panel.focus());
            },

            close() {
                this.open = false;
                document.body.style.overflow = '';
            },
        };
    };
})();
</script>

<div x-data="{{ $uid }}()">

    {{-- ── Trigger button ─────────────────────────────────────────────────────── --}}
    <button
        type="button"
        @click="show()"
        style="font-family:'Cinzel',serif"
        class="inline-flex items-center gap-2 rounded border border-[#D4AF5A] bg-[#FDF8EE] px-5 py-2.5 text-sm tracking-widest text-[#1A2A44] transition-colors hover:border-[#C0A060] hover:bg-[#F5EDD8] cursor-pointer"
    >
        <span class="text-[#B8960C]" aria-hidden="true">✦</span>
        {{ $btnLabel }}
        <span class="text-[#B8960C]" aria-hidden="true">✦</span>
    </button>

    {{-- ── Modal overlay ───────────────────────────────────────────────────────── --}}
    <div
        x-show="open"
        @click.self="close()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="bb-backdrop fixed inset-0 z-50 flex items-start justify-center overflow-y-auto bg-black/60 p-4 sm:py-10"
        style="display:none"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $btnLabel }}"
    >
        {{-- ── Panel ──────────────────────────────────────────────────────────── --}}
        <div
            x-ref="panel"
            @click.stop
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-3"
            tabindex="-1"
            class="bb-panel relative my-auto w-full max-w-2xl rounded-lg border border-[#D4AF5A] bg-[#FDF8EE] shadow-2xl outline-none"
        >
            {{-- Corner ornaments (L-shaped gold marks at each corner) --}}
            <span class="pointer-events-none absolute left-4 top-4 h-6 w-6 border-l-2 border-t-2 border-[#C0A060]"     aria-hidden="true"></span>
            <span class="pointer-events-none absolute right-4 top-4 h-6 w-6 border-r-2 border-t-2 border-[#C0A060]"    aria-hidden="true"></span>
            <span class="pointer-events-none absolute bottom-4 left-4 h-6 w-6 border-b-2 border-l-2 border-[#C0A060]"  aria-hidden="true"></span>
            <span class="pointer-events-none absolute bottom-4 right-4 h-6 w-6 border-b-2 border-r-2 border-[#C0A060]" aria-hidden="true"></span>

            {{-- Close button --}}
            <button
                type="button"
                @click="close()"
                class="absolute right-3 top-3 z-10 flex h-8 w-8 items-center justify-center rounded-full text-[#8B7340] transition-colors hover:bg-[#F0E8D0] hover:text-[#1A2A44] cursor-pointer"
                aria-label="{{ $closeLabel }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="px-8 pb-10 pt-10">

                {{-- Heading --}}
                <h2
                    style="font-family:'Cinzel',serif"
                    class="text-center text-lg uppercase tracking-widest text-[#1A2A44]"
                >{{ $btnLabel }}</h2>

                {{-- Decorative rule with diamond --}}
                <div class="my-4 flex items-center justify-center gap-3">
                    <div class="h-px w-20 bg-gradient-to-r from-transparent to-[#D4AF5A]"></div>
                    <span class="text-xs text-[#B8960C]" aria-hidden="true">♦</span>
                    <div class="h-px w-20 bg-gradient-to-l from-transparent to-[#D4AF5A]"></div>
                </div>

                {{-- ── Book grid: 1-col on mobile, 3-col (book | divider | book) on sm+ ── --}}
                <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-[1fr_1px_1fr] sm:gap-x-8">

                    @if ($isSv)

                        {{-- ════════════════════════════════════════════════════════
                             Swedish locale: Navigation i mångfalden first (primary)
                             ════════════════════════════════════════════════════════ --}}

                        <div class="flex flex-col">
                            <div class="mb-4 flex justify-center">
                                <img src="/images/NavDiv35.PNG"
                                     alt="Omslag: Navigation i mångfalden"
                                     class="h-44 w-auto rounded object-cover shadow-md">
                            </div>

                            <p style="font-family:'Cinzel',serif"
                               class="mb-0.5 text-sm font-semibold text-[#1A2A44]">
                                Navigation i mångfalden
                            </p>
                            <p style="font-family:'Cormorant Garamond',serif"
                               class="mb-0.5 text-sm italic text-[#5A4A2A]">
                                En essä om äventyr, filosofi och bistånd
                            </p>
                            <p class="mb-4 text-xs text-stone-400">115 sidor</p>

                            <div class="space-y-4">
                                <div>
                                    <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-[#8B7340]">Tryckt bok</p>
                                    <ul class="space-y-1.5">
                                        <li>
                                            <a href="https://www.bokus.com/bok/9789175175140/navigation-i-mangfalden-en-essa-om-aventyr-filosofi-och-bistand/"
                                               target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                                Bokus {!! $extIcon !!}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.adlibris.com/se/bok/navigation-i-mangfalden-en-essa-om-aventyr-filosofi-och-bistand-9789175175140"
                                               target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                                Adlibris {!! $extIcon !!}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-[#8B7340]">E-bok</p>
                                    <ul class="space-y-1.5">
                                        <li>
                                            <a href="https://www.bokus.com/bok/9789175175188/navigation-i-mangfalden/"
                                               target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                                Bokus {!! $extIcon !!}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.adlibris.com/se/e-bok/navigation-i-mangfalden-9789175175188"
                                               target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                                Adlibris {!! $extIcon !!}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Divider: horizontal (1px h-px) on mobile, vertical (1px wide) on sm+ --}}
                        <div class="h-px w-full bg-[#D4AF5A] opacity-30 sm:h-full sm:w-px" aria-hidden="true"></div>

                        {{-- Faustian Bargain? No Thanks! (secondary) --}}
                        <div class="flex flex-col">
                            <div class="mb-4 flex justify-center">
                                <img src="/images/FB_cover_eng2.jpg"
                                     alt="Cover: Faustian Bargain? No Thanks!"
                                     class="h-44 w-auto rounded object-cover shadow-md">
                            </div>

                            <p style="font-family:'Cinzel',serif"
                               class="mb-0.5 text-sm font-semibold text-[#1A2A44]">
                                Faustian Bargain? No Thanks!
                            </p>
                            <p class="mb-1 text-xs text-stone-400">106 sidor · engelska</p>
                            <p class="mb-4 text-xl text-stone-500">
                                Ingen svensk utgåva finns ännu —
                                <a href="{{ $interestFormUrl }}"
                                   class="text-[#B8960C] underline underline-offset-2 hover:no-underline">anmäl ditt intresse</a>
                                om du vill bli meddelad.
                            </p>

                            <div>
                                <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-[#8B7340]">Amazon</p>
                                <ul class="space-y-1.5">
                                    @foreach ($amazonLinks as [$name, $url])
                                    <li>
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                            {{ $name }} {!! $extIcon !!}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    @else

                        {{-- ══════════════════════════════════════════════════════════
                             English locale: Faustian Bargain? No Thanks! first (primary)
                             ══════════════════════════════════════════════════════════ --}}

                        <div class="flex flex-col">
                            <div class="mb-4 flex justify-center">
                                <img src="/images/FB_cover_eng2.jpg"
                                     alt="Cover: Faustian Bargain? No Thanks!"
                                     class="h-44 w-auto rounded object-cover shadow-md">
                            </div>

                            <p style="font-family:'Cinzel',serif"
                               class="mb-0.5 text-sm font-semibold text-[#1A2A44]">
                                Faustian Bargain? No Thanks!
                            </p>
                            <p class="mb-4 text-xs text-stone-400">106 pages</p>

                            <div>
                                <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-[#8B7340]">Amazon</p>
                                <ul class="space-y-1.5">
                                    @foreach ($amazonLinks as [$name, $url])
                                    <li>
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                            {{ $name }} {!! $extIcon !!}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="h-px w-full bg-[#D4AF5A] opacity-30 sm:h-full sm:w-px" aria-hidden="true"></div>

                        {{-- Adventures and Reflections (secondary) --}}
                        <div class="flex flex-col">
                            <div class="mb-4 flex justify-center">
                                <img src="/images/NM_engl_cov.jpg"
                                     alt="Cover: Adventures and Reflections"
                                     class="h-44 w-auto rounded object-cover shadow-md">
                            </div>

                            <p style="font-family:'Cinzel',serif"
                               class="mb-0.5 text-sm font-semibold text-[#1A2A44]">
                                Adventures and Reflections
                            </p>
                            <p class="mb-4 text-xs text-stone-400">93 pages</p>

                            <div>
                                <p class="mb-1.5 text-xs font-semibold uppercase tracking-wide text-[#8B7340]">Amazon</p>
                                <ul class="space-y-1.5">
                                    @foreach ($adventuresLinks as [$name, $url])
                                    <li>
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                           class="inline-flex items-center gap-1 text-sm text-[#1A2A44] underline underline-offset-2 transition-colors hover:text-[#B8960C]">
                                            {{ $name }} {!! $extIcon !!}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    @endif

                </div>{{-- /book grid --}}

            </div>{{-- /panel inner --}}
        </div>{{-- /panel --}}
    </div>{{-- /overlay --}}

</div>{{-- /Alpine root --}}
