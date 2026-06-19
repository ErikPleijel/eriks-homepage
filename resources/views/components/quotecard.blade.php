@props([
    'header'     => null,  // short amber line above the quote; null = omit
    'text'       => null,  // required for canvas mode; null = placeholder fallback
    'align'      => 'center',  // 'center' | 'left'
    'lang'       => 'en',      // 'en' | 'sv' — controls button labels + share strings
    'number'     => null,       // chapter number badge (int), shown top-left corner if set
    'id'         => 'chapter-1', // used as the download filename slug
    'showSlogan' => true,        // show/hide the "Ideas grow in group chats" line
])

@if ($text !== null)

{{-- ─── Canvas quote-card ───────────────────────────────────────────────── --}}
@php
    $uid      = 'qc_' . uniqid('', false);
    $filename = 'quote-' . $id . '-' . $lang . '-erik-pleijel.jpg';
    $isSv     = $lang === 'sv';
    $labels   = [
        'download'     => $isSv ? 'Ladda ner'                          : 'Download',
        'copyText'     => $isSv ? 'Kopiera text'                       : 'Copy text',
        'copied'       => $isSv ? 'Kopierad ✅'                        : 'Copied ✅',
        'share'        => $isSv ? 'Dela'                               : 'Share',
        'slogan'       => $isSv ? '💬 Idéer växer i gruppchattar 🌱'  : '💬 Ideas grow in group chats 🌱',
        'shareCaption' => '👉 ErikPleijel.se',
        'shareLink'    => $isSv ? 'https://ErikPleijel.se'             : 'https://ErikPleijel.se/eng',
    ];
@endphp

{{-- Define the Alpine component function before the element that uses it. --}}
<script>
(function () {

    // ── helpers ─────────────────────────────────────────────────────────────

    /** Wraps a single string to fit maxW px, returns array of lines. */
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

    /** Draws a rounded rectangle path (compatible with older browsers). */
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

    // ── canvas drawing ───────────────────────────────────────────────────────

    function drawCardContent(ctx, W, H, preview) {
        const HEADER_TEXT   = @js($header);
        const QUOTE_TEXT    = @js($text);
        const ALIGN         = @js($align);
        const NUMBER        = @js($number);

        // Layout constants
        const INSET       = 70;
        const CX = INSET, CY = INSET;
        const CW = W - 2 * INSET, CH = H - 2 * INSET;
        const PAD_H       = 88;           // horizontal padding inside card for text
        const CONTENT_L   = CX + PAD_H;  // 158
        const CONTENT_W   = CW - 2 * PAD_H; // 764
        const CENTER_X    = W / 2;
        const textX       = ALIGN === 'left' ? CONTENT_L : CENTER_X;
        const canvasAlign = ALIGN === 'left' ? 'left'    : 'center';

        // Semi-transparent dark overlay
        ctx.fillStyle = 'rgba(0,0,0,0.18)';
        ctx.fillRect(0, 0, W, H);

        // Card outline
        ctx.strokeStyle = 'rgba(255,255,255,0.55)';
        ctx.lineWidth   = 2;
        roundedRect(ctx, CX, CY, CW, CH, 22);
        ctx.stroke();

        // Optional chapter-number badge (top-left corner of card)
        if (NUMBER !== null && NUMBER !== undefined) {
            const bx = CX + 38, by = CY + 38, br = 28;
            ctx.fillStyle = 'rgba(255,255,255,0.15)';
            ctx.beginPath(); ctx.arc(bx, by, br, 0, Math.PI * 2); ctx.fill();
            ctx.strokeStyle = 'rgba(255,255,255,0.50)';
            ctx.lineWidth   = 1.5;
            ctx.beginPath(); ctx.arc(bx, by, br, 0, Math.PI * 2); ctx.stroke();
            ctx.fillStyle    = 'rgba(255,255,255,0.95)';
            ctx.font         = 'bold 22px Georgia, serif';
            ctx.textAlign    = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(String(NUMBER), bx, by);
        }

        // Footer — bottom-left of card content, drawn early so we know FOOTER_TOP
        const FOOTER_BOTTOM   = CY + CH - 80;  // 930
        const FOOTER_LINE_H   = 36;
        const FOOTER_TOP      = FOOTER_BOTTOM - FOOTER_LINE_H - 20; // ≈ 874

        ctx.textBaseline = 'alphabetic';
        ctx.textAlign    = 'left';
        ctx.font         = 'italic bold 26px Georgia, serif';
        ctx.fillStyle    = 'rgba(255,211,122,0.95)';
        ctx.fillText('Faustian Bargain? No Thanks!', CONTENT_L, FOOTER_BOTTOM - FOOTER_LINE_H);
        ctx.font      = '24px Georgia, serif';
        ctx.fillStyle = 'rgba(255,255,255,0.90)';
        ctx.fillText('ErikPleijel.se', CONTENT_L, FOOTER_BOTTOM);

        // Header (amber bold, optional)
        let cursorY = CY + 80; // 150

        if (HEADER_TEXT) {
            ctx.font         = 'bold 38px Georgia, serif';
            ctx.fillStyle    = 'rgba(255,211,122,0.95)';
            ctx.textAlign    = canvasAlign;
            ctx.textBaseline = 'top';
            const HDR_LINE_H = 50;
            const hdrLines   = wrapWords(ctx, HEADER_TEXT, CONTENT_W).slice(0, 4);
            hdrLines.forEach((line, i) => ctx.fillText(line, textX, cursorY + i * HDR_LINE_H));
            cursorY += hdrLines.length * HDR_LINE_H + 28;
        }

        // Quote text — auto-shrink 60→40 px to fit available vertical space
        const AVAIL_H   = FOOTER_TOP - 20 - cursorY;
        const paragraphs = QUOTE_TEXT.split('\n').filter(p => p.trim() !== '');

        let fontSize = 60;
        const MIN_PX = 40;
        let allLines, lineH;

        for (;;) {
            ctx.font = `${fontSize}px Georgia, serif`;
            lineH    = Math.round(fontSize * 1.45);
            allLines = [];
            for (const para of paragraphs) {
                allLines.push(...wrapWords(ctx, para.trim(), CONTENT_W));
                allLines.push(null); // paragraph gap marker
            }
            if (allLines[allLines.length - 1] === null) allLines.pop();

            const totalH = allLines.reduce((h, l) => h + (l === null ? lineH * 0.4 : lineH), 0);
            if (totalH <= AVAIL_H || fontSize <= MIN_PX) break;
            fontSize = Math.max(fontSize - 2, MIN_PX);
        }

        // Re-measure at clamped size
        ctx.font = `${fontSize}px Georgia, serif`;
        lineH    = Math.round(fontSize * 1.45);
        // (allLines already built at this fontSize in the last loop iteration)

        const totalH  = allLines.reduce((h, l) => h + (l === null ? lineH * 0.4 : lineH), 0);
        let drawY     = cursorY + Math.max(0, (AVAIL_H - totalH) / 2);

        ctx.textAlign    = canvasAlign;
        ctx.textBaseline = 'top';
        ctx.fillStyle    = 'rgba(255,255,255,0.97)';

        for (const line of allLines) {
            if (line === null) {
                drawY += lineH * 0.4;
            } else {
                ctx.fillText(line, textX, drawY);
                drawY += lineH;
            }
        }

        preview.src = ctx.canvas.toDataURL('image/jpeg', 0.92);
    }

    function drawCard(canvasId, previewId) {
        const canvas  = document.getElementById(canvasId);
        const preview = document.getElementById(previewId);
        if (!canvas || !preview) return;

        const ctx = canvas.getContext('2d');
        const W = 1080, H = 1080;

        const bg = new Image();
        bg.onerror = () => {
            // Fallback gradient when the background image isn't available
            const g = ctx.createLinearGradient(0, 0, W, H);
            g.addColorStop(0, '#1e3a5f');
            g.addColorStop(1, '#0f1f35');
            ctx.fillStyle = g;
            ctx.fillRect(0, 0, W, H);
            drawCardContent(ctx, W, H, preview);
        };
        bg.onload = () => {
            // Cover-fit: scale so the image fills the canvas, centred
            const scale = Math.max(W / bg.naturalWidth, H / bg.naturalHeight);
            const sw = bg.naturalWidth  * scale;
            const sh = bg.naturalHeight * scale;
            ctx.drawImage(bg, (W - sw) / 2, (H - sh) / 2, sw, sh);
            drawCardContent(ctx, W, H, preview);
        };
        bg.src = '/images/blue_bg_compass.jpg';
    }

    // ── Alpine component ─────────────────────────────────────────────────────

    const FILENAME      = @js($filename);
    const HEADER_TEXT   = @js($header);
    const QUOTE_TEXT    = @js($text);
    const SHARE_CAPTION = @js($labels['shareCaption']);
    const SHARE_LINK    = @js($labels['shareLink']);
    const LBL_COPY      = @js($labels['copyText']);
    const LBL_COPIED    = @js($labels['copied']);
    const LBL_SHARE     = @js($labels['share']);

    window[{{ Js::from($uid) }}] = function () {
        return {
            copiedText: false,
            copiedLink: false,
            canShare:   false,
            lblCopy:    LBL_COPY,
            lblCopied:  LBL_COPIED,
            lblShare:   LBL_SHARE,

            init() {
                drawCard({{ Js::from($uid . '_c') }}, {{ Js::from($uid . '_p') }});
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
                const parts = [];
                if (HEADER_TEXT) parts.push(HEADER_TEXT);
                parts.push(QUOTE_TEXT);
                parts.push(SHARE_CAPTION);
                await navigator.clipboard.writeText(parts.join('\n\n'));
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
    {{-- Off-screen canvas used for drawing; never shown to the user --}}
    <canvas id="{{ $uid }}_c" width="1080" height="1080"
            class="hidden" aria-hidden="true"></canvas>

    {{-- Preview: 1×1 transparent GIF holds space until canvas renders --}}
    <div class="overflow-hidden rounded-xl border border-stone-200 bg-stone-100 aspect-square">
        <img id="{{ $uid }}_p"
             src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
             alt="Quote card"
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

    {{-- Share-slogan line (visible by default, toggle via showSlogan prop) --}}
    @if ($showSlogan)
        <p class="mt-2 text-center text-sm italic text-stone-500">{{ $labels['slogan'] }}</p>
    @endif
</div>

@else

{{-- ─── Placeholder fallback (backward-compat for calls that pass slot only) ── --}}
<div class="my-8 rounded-lg border-2 border-dashed border-stone-400 bg-stone-100 p-5 text-stone-500">
    <p class="text-xs font-semibold uppercase tracking-wide text-stone-400">Placeholder · quote card</p>
    <div class="mt-2 italic">{{ $slot }}</div>
</div>

@endif
