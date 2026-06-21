@props([
    'startNumber' => 0,    // 0–12; which chapter to open on
    'lang'        => 'en', // 'en' | 'sv'
])

{{-- Google Font for the question text (browser deduplicates duplicate <link> hrefs) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,400&display=swap">

@php
    $uid  = 'fftc_' . uniqid('', false);
    $isSv = $lang === 'sv';

    // Build a 0-indexed JS-safe array (chapter-0 at index 0, chapter-12 at index 12)
    // so client-side navigation needs zero server round-trips.
    $chapters = array_values(config('foodforthought'));

    $labels = [
        'showAnswer' => $isSv ? 'Visa ett möjligt svar' : 'Show one possible answer',
        'answerTag'  => $isSv ? 'ETT MÖJLIGT SVAR'      : 'ONE POSSIBLE ANSWER',
        'close'      => $isSv ? 'Stäng'                 : 'Close',
        'prev'       => $isSv ? 'Föregående'            : 'Previous',
        'next'       => $isSv ? 'Nästa'                 : 'Next',
    ];
@endphp

<script>
    (function () {
        const CHAPTERS = @js($chapters);  // array of 13 chapter objects, index 0–12
        const LANG     = @js($lang);

        window[{{ Js::from($uid) }}] = function () {
            return {
                currentIndex: {{ (int) $startNumber }},
                answerOpen:   false,

                get currentQuestion() {
                    return CHAPTERS[this.currentIndex][LANG] || '';
                },

                // Chapter label for the small heading above the question, e.g. "2. REFORMATION".
                // Derived from deepdive_{lang} by taking the text after the <br>
                // (the part after "Deep dive: Read chapter") and uppercasing it.
                // Chapter-0 (Introduction) has no numbered label in deepdive text,
                // so it's handled as a special case.
                get currentChapterLabel() {
                    const raw = CHAPTERS[this.currentIndex]['deepdive_' + LANG] || '';
                    const parts = raw.split('<br>');
                    const tail = (parts[1] || '').trim();
                    return tail.toUpperCase();
                },

                next() {
                    this.currentIndex = (this.currentIndex + 1) % 13;
                },

                prev() {
                    this.currentIndex = (this.currentIndex + 12) % 13;
                },

                goTo(i) {
                    this.currentIndex = i;
                },

                showAnswer() {
                    this.answerOpen = true;
                },

                closeAnswer() {
                    this.answerOpen = false;
                },

                // Answer HTML: split the stored <br>-delimited text into proper <p> tags
                // so each paragraph is block-separated. x-html is appropriate here because
                // the content originates from our own config file (trusted local data),
                // not from user input.
                get currentAnswerHtml() {
                    const raw = CHAPTERS[this.currentIndex]['answer_' + LANG] || '';
                    return raw.split('<br>')
                        .filter(p => p.trim())
                        .map(p => `<p>${p.trim()}</p>`)
                        .join('');
                },

                // Deepdive label text: contains a <br> to produce the intended two-line
                // centered format ("Deep dive: Read chapter\n1. Breakout"). Rendered via
                // x-html for the same reason as currentAnswerHtml.
                get currentDeepdive() {
                    return CHAPTERS[this.currentIndex]['deepdive_' + LANG] || '';
                },
            };
        };
    })();
</script>

<div x-data="{{ $uid }}()" class="my-12 max-w-sm mx-auto">

    {{-- Question card: parchment background, gold border, corner ornaments —
         all CSS/DOM now, no canvas. Question text updates reactively via
         x-text as currentIndex changes. --}}
    <div class="relative aspect-[4/3] overflow-hidden rounded-2xl border-2 border-[#D6CAAB] bg-[#FDF8EE] p-8 shadow-sm">

        {{-- Inner gold hairline border --}}
        <div class="pointer-events-none absolute inset-3 rounded-xl border border-[#D4AF5A]" aria-hidden="true"></div>

        {{-- Corner ornaments (L-shaped gold marks) --}}
        <span class="pointer-events-none absolute left-5 top-5 h-6 w-6 border-l-2 border-t-2 border-[#C0A060]" aria-hidden="true"></span>
        <span class="pointer-events-none absolute right-5 top-5 h-6 w-6 border-r-2 border-t-2 border-[#C0A060]" aria-hidden="true"></span>
        <span class="pointer-events-none absolute bottom-5 left-5 h-6 w-6 border-b-2 border-l-2 border-[#C0A060]" aria-hidden="true"></span>
        <span class="pointer-events-none absolute bottom-5 right-5 h-6 w-6 border-b-2 border-r-2 border-[#C0A060]" aria-hidden="true"></span>

        {{-- Question text + small chapter label, vertically centered as a group --}}
        <div class="relative flex h-full flex-col items-center justify-center text-center gap-2">
            <p x-show="currentChapterLabel"
               x-text="currentChapterLabel"
               class="text-xs font-semibold tracking-[0.15em] text-[#B8A06A]">
            </p>
            <p x-text="currentQuestion"
               style="font-family: 'Cormorant Garamond', Georgia, serif;"
               class="text-2xl italic leading-snug text-[#1A2A44] sm:text-3xl">
            </p>
        </div>

    </div>

    {{-- Navigation row: prev arrow · gold pill · next arrow --}}
    <div class="mt-3 flex items-center gap-2">
        <button type="button" @click="prev()"
                aria-label="{{ $labels['prev'] }}"
                class="flex-none w-10 h-10 rounded-full bg-stone-500 text-white hover:bg-stone-600 transition-colors flex items-center justify-center cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6" />
            </svg>
        </button>

        <button type="button" @click="showAnswer()"
                class="flex-1 rounded-full bg-stone-500 text-white py-2 px-3 text-sm font-bold hover:bg-stone-600 transition-colors text-center leading-tight cursor-pointer">
            {{ $labels['showAnswer'] }}
        </button>

        <button type="button" @click="next()"
                aria-label="{{ $labels['next'] }}"
                class="flex-none w-10 h-10 rounded-full bg-stone-500 text-white hover:bg-stone-600 transition-colors flex items-center justify-center cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18l6-6-6-6" />
            </svg>
        </button>
    </div>

    {{-- Pagination dots (one per chapter, 13 total) --}}
    <div class="mt-2 flex justify-center items-center gap-1.5" role="tablist">
        <template x-for="i in 13" :key="i">
            <button type="button"
                    role="tab"
                    :aria-selected="currentIndex === i - 1"
                    :aria-label="`Chapter ${i}`"
                    @click="goTo(i - 1)"
                    class="rounded-full transition-all duration-150 focus:outline-none cursor-pointer"
                    :class="currentIndex === i - 1
                    ? 'w-3 h-3 bg-stone-500'
                    : 'w-2 h-2 bg-stone-300 hover:bg-stone-400'">
            </button>
        </template>
    </div>

    {{-- ─── Answer popup ────────────────────────────────────────────────────── --}}
    <div x-show="answerOpen"
         x-cloak
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-4"
         style="background-color: rgba(0,0,0,0.6);"
         @click.self="closeAnswer()">

        <div class="relative w-full max-w-sm rounded-2xl bg-amber-50 border border-amber-200 shadow-2xl overflow-hidden">

            <div class="bg-amber-100 border-b border-amber-200 px-6 py-3 text-center">
                <p class="text-xs font-bold tracking-[0.2em] text-amber-700 uppercase">
                    {{ $labels['answerTag'] }}
                </p>
            </div>

            <div class="px-6 py-5 space-y-3 text-stone-700 text-base leading-relaxed"
                 x-html="currentAnswerHtml">
            </div>

            <div class="border-t border-amber-200 px-6 py-3 text-center text-sm font-semibold text-amber-700 leading-snug"
                 x-html="currentDeepdive">
            </div>

            <div class="px-6 pb-5 pt-2">
                <button type="button" @click="closeAnswer()"
                        class="w-full rounded-full bg-stone-200 py-2 text-sm font-medium text-stone-600 hover:bg-stone-300 transition-colors cursor-pointer">
                    {{ $labels['close'] }}
                </button>
            </div>

        </div>
    </div>

</div>
