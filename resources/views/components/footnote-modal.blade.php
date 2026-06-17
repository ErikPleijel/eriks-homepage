{{--
    Single shared footnote modal. Rendered once in the layout; reads from the
    "footnotes" scope (open / label / body) populated by every
    <x-footnote-trigger/> on the page. Closes on backdrop click or Escape.
--}}
<div
    x-show="open"
    x-cloak
    @keydown.escape.window="close()"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
    x-transition.opacity
>
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-stone-900/50" @click="close()"></div>

    {{-- Panel --}}
    <div
        class="relative z-10 w-full max-w-md rounded-lg bg-white p-6 shadow-xl"
        x-transition
    >
        <div class="mb-3 flex items-start justify-between gap-4">
            <h2 class="text-sm font-semibold uppercase tracking-wide text-stone-500">
                Footnote <span x-text="label"></span>
            </h2>
            <button type="button" @click="close()" aria-label="Close footnote"
                    class="text-stone-400 hover:text-stone-700">&times;</button>
        </div>
        <p class="text-stone-800" x-text="body"></p>
    </div>
</div>
