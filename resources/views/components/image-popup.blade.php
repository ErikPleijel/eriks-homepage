@props(['src', 'alt', 'triggerLabel'])

@php
    $locale     = app()->getLocale();
    $isSv       = $locale === 'sv';
    $uid        = 'ip_' . uniqid('', false);
    $closeLabel = $isSv ? 'Stäng' : 'Close';
@endphp

{{-- Google Fonts: Cinzel (browser deduplicates duplicate hrefs) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400&display=swap">

<style>
@media (prefers-reduced-motion: reduce) {
    .ip-backdrop, .ip-panel { transition-duration: 0.01ms !important; }
}
</style>

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

    {{-- ── Trigger button ────────────────────────────────────────────────────── --}}
    <button
        type="button"
        @click="show()"
        style="font-family:'Cinzel',serif"
        class="inline-flex items-center gap-2 rounded border border-[#D4AF5A] bg-[#FDF8EE] px-4 py-2 text-sm tracking-widest text-[#1A2A44] transition-colors hover:border-[#C0A060] hover:bg-[#F5EDD8]"
    >
        {{ $triggerLabel }}
    </button>

    {{-- ── Modal overlay ─────────────────────────────────────────────────────── --}}
    <div
        x-show="open"
        @click.self="close()"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="ip-backdrop fixed inset-0 z-50 overflow-y-auto bg-black/60 p-4 sm:py-10"
        style="display:none"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $triggerLabel }}"
    >
        {{-- ── Panel ─────────────────────────────────────────────────────────── --}}
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
            class="ip-panel relative mx-auto my-8 w-full max-w-3xl rounded-lg border border-[#D4AF5A] bg-[#FDF8EE] shadow-2xl outline-none"
        >
            {{-- Corner ornaments --}}
            <span class="pointer-events-none absolute left-4 top-4 h-6 w-6 border-l-2 border-t-2 border-[#C0A060]"     aria-hidden="true"></span>
            <span class="pointer-events-none absolute right-4 top-4 h-6 w-6 border-r-2 border-t-2 border-[#C0A060]"    aria-hidden="true"></span>
            <span class="pointer-events-none absolute bottom-4 left-4 h-6 w-6 border-b-2 border-l-2 border-[#C0A060]"  aria-hidden="true"></span>
            <span class="pointer-events-none absolute bottom-4 right-4 h-6 w-6 border-b-2 border-r-2 border-[#C0A060]" aria-hidden="true"></span>

            {{-- Close button --}}
            <button
                type="button"
                @click="close()"
                class="absolute right-3 top-3 z-10 flex h-8 w-8 items-center justify-center rounded-full text-[#8B7340] transition-colors hover:bg-[#F0E8D0] hover:text-[#1A2A44]"
                aria-label="{{ $closeLabel }}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="p-8 pt-10">
                <img
                    src="{{ $src }}"
                    alt="{{ $alt }}"
                    class="mx-auto block h-auto max-w-full rounded"
                >
            </div>

        </div>{{-- /panel --}}
    </div>{{-- /overlay --}}

</div>{{-- /Alpine root --}}
