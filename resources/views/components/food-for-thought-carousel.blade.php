@props([
    'startNumber' => 0,    // 0–12; which chapter to open on
    'lang'        => 'en', // 'en' | 'sv'
])

{{-- Google Fonts for canvas drawing (browser deduplicates duplicate <link> hrefs) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,400&family=Cinzel:wght@400&display=swap">

@php
    $uid   = 'fftc_' . uniqid('', false);
    $isSv  = $lang === 'sv';

    // Build a 0-indexed JS-safe array (chapter-0 at index 0, chapter-12 at index 12)
    // so client-side navigation needs zero server round-trips.
    $chapters = array_values(config('foodforthought'));

    $labels = [
        'tag'       => $isSv ? 'ATT FUNDERA ÖVER'      : 'FOOD FOR THOUGHT',
        'showAnswer'=> $isSv ? 'Visa ett möjligt svar' : 'Show one possible answer',
        'answerTag' => $isSv ? 'ETT MÖJLIGT SVAR'      : 'ONE POSSIBLE ANSWER',
        'close'     => $isSv ? 'Stäng'                 : 'Close',
        'prev'      => $isSv ? 'Föregående'            : 'Previous',
        'next'      => $isSv ? 'Nästa'                 : 'Next',
    ];
@endphp

<script>
(function () {

    // ── helpers (mirrored verbatim from food-for-thought.blade.php) ──────────

    function wrapWords(ctx, str, maxW) {
        const words = str.split(' ');
        const lines = [];
        let line = '';
        for (const word of words) {
            const test = line ? line + ' ' + word : word;
            if (line !== '' && ctx.measureText(test).width > maxW) {
                lines.push(line);
                line = word;
            } else {
                line = test;
            }
        }
        if (line) lines.push(line);
        return lines;
    }

    function roundedRect(ctx, x, y, w, h, r) {
        ctx.beginPath();
        ctx.moveTo(x + r, y);
        ctx.lineTo(x + w - r, y);
        ctx.quadraticCurveTo(x + w, y, x + w, y + r);
        ctx.lineTo(x + w, y + h - r);
        ctx.quadraticCurveTo(x + w, y + h, x + w - r, y + h);
        ctx.lineTo(x + r, y + h);
        ctx.quadraticCurveTo(x, y + h, x, y + h - r);
        ctx.lineTo(x, y + r);
        ctx.quadraticCurveTo(x, y, x + r, y);
        ctx.closePath();
    }

    // ── constants from PHP ───────────────────────────────────────────────────

    const CHAPTERS   = @js($chapters);  // array of 13 chapter objects, index 0–12
    const LANG       = @js($lang);
    const TAG_TEXT   = @js($labels['tag']);
    const CANVAS_ID  = {{ Js::from($uid . '_c') }};
    const PREVIEW_ID = {{ Js::from($uid . '_p') }};

    // ── canvas drawing (mirrored from food-for-thought.blade.php) ───────────
    // Only change from the static component: questionText is a parameter
    // rather than a closure constant, enabling re-render on navigation.

    function drawCard(questionText) {
        const canvas  = document.getElementById(CANVAS_ID);
        const preview = document.getElementById(PREVIEW_ID);
        if (!canvas || !preview) return;

        const ctx = canvas.getContext('2d');
        const W = 1080, H = 1080;

        // 1. Cream parchment background
        ctx.fillStyle = '#FDF8EE';
        ctx.fillRect(0, 0, W, H);

        // 2. Outer border (warm beige)
        ctx.strokeStyle = '#D6CAAB';
        ctx.lineWidth   = 2.5;
        roundedRect(ctx, 42, 42, W - 84, H - 84, 26);
        ctx.stroke();

        // 3. Inner border (gold hairline)
        ctx.strokeStyle = '#D4AF5A';
        ctx.lineWidth   = 1;
        roundedRect(ctx, 60, 60, W - 120, H - 120, 18);
        ctx.stroke();

        // 4. Corner ornaments — L-shaped gold marks at each corner
        const CRNR = 72, ARM = 44;
        ctx.strokeStyle = '#C0A060';
        ctx.lineWidth   = 2;
        [
            // top-left
            [CRNR,     CRNR,     CRNR + ARM, CRNR      ],
            [CRNR,     CRNR,     CRNR,       CRNR + ARM ],
            // top-right
            [W-CRNR,   CRNR,     W-CRNR-ARM, CRNR      ],
            [W-CRNR,   CRNR,     W-CRNR,     CRNR + ARM ],
            // bottom-left
            [CRNR,     H-CRNR,   CRNR + ARM, H-CRNR    ],
            [CRNR,     H-CRNR,   CRNR,       H-CRNR-ARM ],
            // bottom-right
            [W-CRNR,   H-CRNR,   W-CRNR-ARM, H-CRNR    ],
            [W-CRNR,   H-CRNR,   W-CRNR,     H-CRNR-ARM ],
        ].forEach(([x1, y1, x2, y2]) => {
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.stroke();
        });

        // 5. Tag line — "FOOD FOR THOUGHT" in Cinzel, gold, centered
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle    = '#B8960C';
        ctx.font         = 'bold 26px "Cinzel", serif';
        if ('letterSpacing' in ctx) ctx.letterSpacing = '5px';
        ctx.fillText(TAG_TEXT, W / 2, 188);
        if ('letterSpacing' in ctx) ctx.letterSpacing = '0px';

        // 6. Gradient rule under tag + reusable helper for the bottom rule
        function gradRule(y, h) {
            const g = ctx.createLinearGradient(240, 0, 840, 0);
            g.addColorStop(0,   'rgba(212,175,90,0)');
            g.addColorStop(0.2, '#D4AF5A');
            g.addColorStop(0.8, '#D4AF5A');
            g.addColorStop(1,   'rgba(212,175,90,0)');
            ctx.fillStyle = g;
            ctx.fillRect(240, y, 600, h);
        }
        gradRule(216, 1.5);

        // 7. Question text — italic Cormorant Garamond, navy, auto-sized 82→68 px
        const CW    = 780;
        const Q_TOP = 258, Q_BOT = 850;
        const AVAIL = Q_BOT - Q_TOP;   // 592 px

        ctx.textAlign    = 'center';
        ctx.textBaseline = 'top';
        ctx.fillStyle    = '#1A2A44';

        let fontSize = 82, lineH, lines;
        for (;;) {
            ctx.font = `italic ${fontSize}px "Cormorant Garamond", "Georgia", serif`;
            lineH    = Math.round(fontSize * 1.35);
            lines    = wrapWords(ctx, questionText, CW);
            if (lines.length * lineH <= AVAIL || fontSize <= 68) break;
            fontSize -= 2;
        }

        const totalH = lines.length * lineH;
        let qY = Q_TOP + Math.max(0, (AVAIL - totalH) / 2);
        for (const line of lines) {
            ctx.fillText(line, W / 2, qY);
            qY += lineH;
        }

        // 8. Bottom section: diamond ornament, rule, book title, brand
        ctx.font         = '32px "Georgia", serif';
        ctx.fillStyle    = '#C8A050';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('♦', W / 2, 872);

        gradRule(900, 1);

        ctx.font         = 'italic 28px "Cormorant Garamond", "Georgia", serif';
        ctx.fillStyle    = '#B8960C';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Faustian Bargain? No Thanks!', W / 2, 940);

        ctx.font         = '22px "Cinzel", serif';
        ctx.fillStyle    = '#C8A050';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('ErikPleijel.se', W / 2, 982);

        preview.src = canvas.toDataURL('image/jpeg', 0.92);
    }

    // ── Alpine component ─────────────────────────────────────────────────────

    window[{{ Js::from($uid) }}] = function () {
        return {
            currentIndex: {{ (int) $startNumber }},
            answerOpen:   false,

            init() {
                // Wait for web fonts before the first draw; navigation re-draws
                // synchronously since fonts are guaranteed loaded by user-action time.
                Promise.all([
                    document.fonts.load('italic 82px "Cormorant Garamond"'),
                    document.fonts.load('bold 26px "Cinzel"'),
                ]).then(() => this._draw())
                  .catch(() => this._draw());
            },

            _draw() {
                drawCard(CHAPTERS[this.currentIndex][LANG]);
            },

            next() {
                this.currentIndex = (this.currentIndex + 1) % 13;
                this._draw();
            },

            prev() {
                this.currentIndex = (this.currentIndex + 12) % 13;
                this._draw();
            },

            goTo(i) {
                this.currentIndex = i;
                this._draw();
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

    {{-- Off-screen canvas used for drawing; never displayed directly --}}
    <canvas id="{{ $uid }}_c" width="1080" height="1080"
            class="hidden" aria-hidden="true"></canvas>

    {{-- 1×1 transparent GIF holds space while canvas renders --}}
    <div class="overflow-hidden rounded-xl border border-stone-200 bg-amber-50 aspect-square">
        <img id="{{ $uid }}_p"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             alt="Food for thought"
             class="w-full h-full object-cover block">
    </div>

    {{-- Navigation row: prev arrow · gold pill · next arrow --}}
    <div class="mt-3 flex items-center gap-2">
        <button type="button" @click="prev()"
                aria-label="{{ $labels['prev'] }}"
                class="flex-none w-10 h-10 rounded-full bg-amber-400 text-white hover:bg-amber-500 transition-colors flex items-center justify-center text-lg font-bold leading-none">
            ←
        </button>

        <button type="button" @click="showAnswer()"
                class="flex-1 rounded-full bg-amber-500 text-white py-2 px-3 text-sm font-bold hover:bg-amber-600 transition-colors text-center leading-tight">
            {{ $labels['showAnswer'] }}
        </button>

        <button type="button" @click="next()"
                aria-label="{{ $labels['next'] }}"
                class="flex-none w-10 h-10 rounded-full bg-amber-400 text-white hover:bg-amber-500 transition-colors flex items-center justify-center text-lg font-bold leading-none">
            →
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
                    class="rounded-full transition-all duration-150 focus:outline-none"
                    :class="currentIndex === i - 1
                        ? 'w-3 h-3 bg-amber-500'
                        : 'w-2 h-2 bg-stone-300 hover:bg-stone-400'">
            </button>
        </template>
    </div>

    {{-- ─── Answer popup ────────────────────────────────────────────────────── --}}
    {{--
        Rendered inside the same Alpine scope so currentAnswerHtml and
        currentDeepdive reactively derive from currentIndex. Clicking the
        backdrop (@click.self) closes the modal without closing when the
        inner panel is clicked.
    --}}
    <div x-show="answerOpen"
         x-cloak
         class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-4"
         style="background-color: rgba(0,0,0,0.6);"
         @click.self="closeAnswer()">

        <div class="relative w-full max-w-sm rounded-2xl bg-amber-50 border border-amber-200 shadow-2xl overflow-hidden">

            {{-- "ONE POSSIBLE ANSWER" tag --}}
            <div class="bg-amber-100 border-b border-amber-200 px-6 py-3 text-center">
                <p class="text-xs font-bold tracking-[0.2em] text-amber-700 uppercase">
                    {{ $labels['answerTag'] }}
                </p>
            </div>

            {{-- Answer paragraphs: <b>/<i> from config rendered via x-html.
                 The split-on-<br> → <p> conversion is done in the getter so each
                 paragraph is block-separated without needing a CSS hack. --}}
            <div class="px-6 py-5 space-y-3 text-stone-700 text-base leading-relaxed"
                 x-html="currentAnswerHtml">
            </div>

            {{-- Deepdive label (decorative text, NO link) --}}
            <div class="border-t border-amber-200 px-6 py-3 text-center text-sm font-semibold text-amber-700 leading-snug"
                 x-html="currentDeepdive">
            </div>

            {{-- Close button --}}
            <div class="px-6 pb-5 pt-2">
                <button type="button" @click="closeAnswer()"
                        class="w-full rounded-full bg-stone-200 py-2 text-sm font-medium text-stone-600 hover:bg-stone-300 transition-colors">
                    {{ $labels['close'] }}
                </button>
            </div>

        </div>
    </div>

</div>
