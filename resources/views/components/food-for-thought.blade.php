@props([
    'number'     => 0,       // chapter number; 0 = Introduction
    'lang'       => 'en',   // 'en' | 'sv'
    'id'         => null,   // override filename slug (defaults to chapter-{number})
    'showSlogan' => true,
    // 'label' is NOT declared: legacy label="Introduction" callers pass it as an
    // attribute that is silently absorbed by $attributes and never emitted to HTML.
])

{{-- Google Fonts for canvas drawing (browser deduplicates duplicate <link> hrefs) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@1,400&family=Cinzel:wght@400&display=swap">

@php
    $uid      = 'fft_' . uniqid('', false);
    $slug     = $id ?? 'chapter-' . $number;
    $filename = 'food-for-thought-' . $slug . '-' . $lang . '-erik-pleijel.jpg';
    $isSv     = $lang === 'sv';

    $entry    = config('foodforthought.chapter-' . $number, []);
    $question = $entry[$lang] ?? '';

    $labels = [
        'tag'          => $isSv ? 'ATT FUNDERA ÖVER'                   : 'FOOD FOR THOUGHT',
        'download'     => $isSv ? 'Ladda ner'                          : 'Download',
        'copyText'     => $isSv ? 'Kopiera text'                       : 'Copy text',
        'copied'       => $isSv ? 'Kopierad ✅'                        : 'Copied ✅',
        'share'        => $isSv ? 'Dela'                               : 'Share',
        'slogan'       => $isSv ? '💬 Idéer växer i gruppchattar 🌱'  : '💬 Ideas grow in group chats 🌱',
        'shareCaption' => $isSv ? '👉 ErikPleijel.se' : '👉 ErikPleijel.com',
        'shareLink' => $isSv ? 'https://ErikPleijel.se' : 'https://ErikPleijel.com',
    ];
@endphp

<script>
(function () {

    // ── helpers ──────────────────────────────────────────────────────────────

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

    const FILENAME      = @js($filename);
    const QUESTION_TEXT = @js($question);
    const TAG_TEXT      = @js($labels['tag']);
    const SHARE_CAPTION = @js($labels['shareCaption']);
    const SHARE_LINK    = @js($labels['shareLink']);
    const LBL_COPY      = @js($labels['copyText']);
    const LBL_COPIED    = @js($labels['copied']);
    const LBL_SHARE     = @js($labels['share']);
    const SITE_DOMAIN = @js($isSv ? 'ErikPleijel.se' : 'ErikPleijel.com');
    const BOOK_TITLE  = @js($isSv ? 'Faustisk pakt? Nej tack!' : 'Faustian Bargain? No Thanks!');

    // ── canvas drawing ───────────────────────────────────────────────────────

    function drawCard(canvasId, previewId) {
        const canvas  = document.getElementById(canvasId);
        const preview = document.getElementById(previewId);
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

        // 6. Gradient rule under tag, and a shared helper for the bottom rule
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
        const CW = 780;   // content width centered on 1080
        const Q_TOP  = 258, Q_BOT = 850;
        const AVAIL  = Q_BOT - Q_TOP;   // 592 px

        ctx.textAlign    = 'center';
        ctx.textBaseline = 'top';
        ctx.fillStyle    = '#1A2A44';

        let fontSize = 82, lineH, lines;
        for (;;) {
            ctx.font = `italic ${fontSize}px "Cormorant Garamond", "Georgia", serif`;
            lineH    = Math.round(fontSize * 1.35);
            lines    = wrapWords(ctx, QUESTION_TEXT, CW);
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

        ctx.font         = 'italic bold 42px "Cormorant Garamond", "Georgia", serif';
        ctx.fillStyle    = '#8B6F1E';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        if ('letterSpacing' in ctx) ctx.letterSpacing = '1.5px';
        ctx.fillText(BOOK_TITLE, W / 2, 940);
        if ('letterSpacing' in ctx) ctx.letterSpacing = '0px';

        ctx.font         = 'bold 33px "Cinzel", serif';
        ctx.fillStyle    = '#8B6F1E';
        ctx.textAlign    = 'center';
        ctx.textBaseline = 'middle';
        if ('letterSpacing' in ctx) ctx.letterSpacing = '2px';
        ctx.fillText(SITE_DOMAIN, W / 2, 990);
        if ('letterSpacing' in ctx) ctx.letterSpacing = '0px';

        preview.src = canvas.toDataURL('image/jpeg', 0.92);
    }

    // ── Alpine component ─────────────────────────────────────────────────────

    window[{{ Js::from($uid) }}] = function () {
        return {
            copiedText: false,
            copiedLink: false,
            canShare:   false,
            lblCopy:    LBL_COPY,
            lblCopied:  LBL_COPIED,
            lblShare:   LBL_SHARE,

            init() {
                // Request font load before drawing so canvas text uses the correct typeface
                Promise.all([
                    document.fonts.load('italic 82px "Cormorant Garamond"'),
                    document.fonts.load('bold 26px "Cinzel"'),
                ]).then(() => {
                    drawCard({{ Js::from($uid . '_c') }}, {{ Js::from($uid . '_p') }});
                }).catch(() => {
                    drawCard({{ Js::from($uid . '_c') }}, {{ Js::from($uid . '_p') }});
                });

                try {
                    const f = new File(['x'], 'x.jpg', { type: 'image/jpeg' });
                    this.canShare = !!(navigator.canShare && navigator.canShare({ files: [f] }));
                } catch (_) {
                    this.canShare = false;
                }
            },

            download() {
                const c = document.getElementById({{ Js::from($uid . '_c') }});
                const a = document.createElement('a');
                a.download = FILENAME;
                a.href     = c.toDataURL('image/jpeg', 0.92);
                a.click();
            },

            async copyText() {
                await navigator.clipboard.writeText(QUESTION_TEXT + '\n\n' + SHARE_CAPTION);
                this.copiedText = true;
                setTimeout(() => { this.copiedText = false; }, 2000);
            },

            async copyLink() {
                await navigator.clipboard.writeText(SHARE_LINK);
                this.copiedLink = true;
                setTimeout(() => { this.copiedLink = false; }, 2000);
            },

            share() {
                const c = document.getElementById({{ Js::from($uid . '_c') }});
                c.toBlob((blob) => {
                    const file = new File([blob], FILENAME, { type: 'image/jpeg' });
                    navigator.share({ files: [file], text: SHARE_CAPTION }).catch(() => {});
                }, 'image/jpeg', 0.92);
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

    {{-- Action buttons --}}
    <div class="mt-3 flex flex-wrap items-center justify-center gap-2">
        <button type="button" @click="download()" class="btn-action btn-stone">
            {{ $labels['download'] }}
        </button>

        <button type="button" @click="copyText()"
                x-text="copiedText ? lblCopied : lblCopy"
                class="btn-action btn-stone">
        </button>

        <button type="button" @click="copyLink()"
                x-text="copiedLink ? '✅' : '🔗'"
                class="btn-action btn-stone">
        </button>

        <template x-if="canShare">
            <button type="button" @click="share()"
                    x-text="lblShare"
                    class="btn-action btn-amber">
            </button>
        </template>
    </div>

    @if ($showSlogan)
        <p class="mt-2 text-center text-sm italic text-stone-500">{{ $labels['slogan'] }}</p>
    @endif
</div>
