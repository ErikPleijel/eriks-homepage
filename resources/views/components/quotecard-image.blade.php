@props([
    'src',                   // path to the pre-made image, e.g. "/images/whatever.jpg"
    'alt',                   // plain alt text for the <img>
    'text',                  // copy/share text; literal "\n" becomes actual newlines
    'lang'       => 'en',   // 'en' | 'sv' — controls button labels + share strings
    'id'         => 'image-card', // download filename slug
    'showSlogan' => true,   // show/hide the "Ideas grow in group chats" line
])

@php
    $uid      = 'qci_' . uniqid('', false);
    $filename = 'quote-' . $id . '-' . $lang . '-erik-pleijel.jpg';
    $isSv     = $lang === 'sv';
    $labels   = [
        'download'     => $isSv ? 'Ladda ner'                         : 'Download',
        'copyText'     => $isSv ? 'Kopiera text'                      : 'Copy text',
        'copied'       => $isSv ? 'Kopierad ✅'                       : 'Copied ✅',
        'share'        => $isSv ? 'Dela'                              : 'Share',
        'slogan'       => $isSv ? '💬 Idéer växer i gruppchattar 🌱' : '💬 Ideas grow in group chats 🌱',
        'shareCaption' => '👉 ErikPleijel.se',
        'shareLink'    => $isSv ? 'https://ErikPleijel.se'            : 'https://ErikPleijel.se/eng',
    ];
@endphp

<script>
(function () {

    const IMAGE_URL     = @js($src);
    const FILENAME      = @js($filename);
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
                try {
                    const f = new File(['x'], 'x.jpg', { type: 'image/jpeg' });
                    this.canShare = !!(navigator.canShare && navigator.canShare({ files: [f] }));
                } catch (_) {
                    this.canShare = false;
                }
            },

            async download() {
                try {
                    const resp = await fetch(IMAGE_URL);
                    const blob = await resp.blob();
                    const url  = URL.createObjectURL(blob);
                    const a    = document.createElement('a');
                    a.download = FILENAME;
                    a.href     = url;
                    a.click();
                    URL.revokeObjectURL(url);
                } catch (_) {}
            },

            async copyText() {
                await navigator.clipboard.writeText(QUOTE_TEXT + '\n\n' + SHARE_CAPTION);
                this.copiedText = true;
                setTimeout(() => { this.copiedText = false; }, 2000);
            },

            async copyLink() {
                await navigator.clipboard.writeText(SHARE_LINK);
                this.copiedLink = true;
                setTimeout(() => { this.copiedLink = false; }, 2000);
            },

            async share() {
                try {
                    const resp = await fetch(IMAGE_URL);
                    const blob = await resp.blob();
                    const file = new File([blob], FILENAME, { type: blob.type });
                    await navigator.share({ files: [file], text: SHARE_CAPTION });
                } catch (_) {}
            },
        };
    };

})();
</script>

<div x-data="{{ $uid }}()" class="my-12 max-w-sm mx-auto">
    {{-- Static image — no canvas, no placeholder GIF; the file already exists --}}
    <div class="overflow-hidden rounded-xl border border-stone-200 aspect-square">
        <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover block">
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
