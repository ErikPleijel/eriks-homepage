@php
    $isSv    = app()->getLocale() === 'sv';
    $uid     = 'sf_' . uniqid('', false);
    $pageUrl = url()->current();   // server-side: full URL, no query string
@endphp

<script>
(function () {
    window[{{ Js::from($uid) }}] = function () {
        return {
            copied:    false,
            lblCopy:   {{ Js::from($isSv ? 'Kopiera' : 'Copy') }},
            lblCopied: {{ Js::from($isSv ? 'Kopierad!' : 'Copied!') }},

            async copy() {
                try {
                    await navigator.clipboard.writeText({{ Js::from($pageUrl) }});
                    this.copied = true;
                    setTimeout(() => { this.copied = false; }, 2000);
                } catch (_) {}
            },
        };
    };
})();
</script>

<footer x-data="{{ $uid }}()"
        class="border-t-2 border-stone-300 bg-stone-100">
    <div class="mx-auto max-w-5xl px-6 py-8 text-sm text-stone-500">

        <div class="grid grid-cols-1 gap-x-12 gap-y-6 md:grid-cols-2">

            {{-- ── 1. Citation / share note ─────────────────────────────────── --}}
            <div>
                <p>
                    @if ($isSv)
                        Du får gärna citera innehåll från den här sidan. Kom bara ihåg att ange mig (Erik Pleijel) som källa och länka tillbaka hit.
                    @else
                        Feel free to quote content from this page — just remember to credit me (Erik Pleijel) and include this link back here.
                    @endif
                </p>
                <p class="mt-2 flex flex-nowrap items-center gap-2 max-w-full">
                    <a href="{{ $pageUrl }}"
                       class="truncate text-stone-600 underline underline-offset-2 transition-colors hover:text-amber-700"
                       title="{{ $pageUrl }}">{{ $pageUrl }}</a>
                    <button type="button"
                            @click="copy()"
                            x-text="copied ? lblCopied : lblCopy"
                            :aria-label="copied ? lblCopied : lblCopy"
                            class="btn-action btn-stone shrink-0">
                    </button>
                </p>
            </div>

            {{-- ── 2. Copyright / license ───────────────────────────────────── --}}
            <p>
                @if ($isSv)
                    © 2026 Erik Pleijel · Innehållet på denna webbplats är licensierat under Creative Commons
                    <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1"
                       target="_blank" rel="noopener noreferrer license"
                       class="text-stone-600 underline underline-offset-2 transition-colors hover:text-amber-700">BY-NC-SA 4.0</a>.
                @else
                    © 2026 Erik Pleijel · Content on this site is licensed under Creative Commons
                    <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1"
                       target="_blank" rel="noopener noreferrer license"
                       class="text-stone-600 underline underline-offset-2 transition-colors hover:text-amber-700">BY-NC-SA 4.0</a>.
                @endif

                    {{ $isSv ? 'Kontakt' : 'Contact' }}:
                    <a href="mailto:epost@erikpleijel.se"
                       class="text-stone-600 underline underline-offset-2 transition-colors hover:text-amber-700">{{ $isSv ? 'epost' : 'email' }}</a>
            </p>


            {{-- ── 3. Illustration credits ──────────────────────────────────── --}}
            {{--<div>
                <p class="mb-2 text-xs font-medium uppercase tracking-wide text-stone-400">
                    {{ $isSv ? 'Bildkällor' : 'Image credits' }}
                </p>
                <ul class="space-y-1">
                    @if ($isSv)
                        <li>Tecknad präst – ©
                            <a href="http://www.bradfitzpatrick.com/"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Brad Fitzpatrick</a>
                        </li>
                        <li>Aristoteles –
                            <a href="https://commons.wikimedia.org/wiki/File:Aristoteles.jpg"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Kaio hfd</a>
                            ·
                            <a href="https://creativecommons.org/licenses/by-sa/3.0/"
                               target="_blank" rel="noopener noreferrer license"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">CC BY-SA 3.0</a>
                        </li>
                        <li>bilder i public domain hämtade från Wikimedia Commons, till exempel:
                            <a href="https://commons.wikimedia.org/wiki/File:M-T-Cicero.jpg"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Cicero-staty</a>
                        </li>
                        <li>illustrationer av Erik Pleijel – publicerade under
                            <a href="https://creativecommons.org/publicdomain/zero/1.0/"
                               target="_blank" rel="noopener noreferrer license"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">CC0 1.0 (Public Domain Dedication)</a>
                        </li>
                    @else
                        <li>Cartoon priest – ©
                            <a href="http://www.bradfitzpatrick.com/"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Brad Fitzpatrick</a>
                        </li>
                        <li>Aristotle –
                            <a href="https://commons.wikimedia.org/wiki/File:Aristoteles.jpg"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Kaio hfd</a>
                            ·
                            <a href="https://creativecommons.org/licenses/by-sa/3.0/"
                               target="_blank" rel="noopener noreferrer license"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">CC BY-SA 3.0</a>
                        </li>
                        <li>public domain images sourced from Wikimedia Commons, for example:
                            <a href="https://commons.wikimedia.org/wiki/File:M-T-Cicero.jpg"
                               target="_blank" rel="noopener noreferrer"
                               class="underline underline-offset-2 transition-colors hover:text-amber-700">Cicero statue</a>
                        </li>

                    @endif
                </ul>
            </div>--}}

            {{-- ── 4. Contact ──────────────────────────────────────────────── --}}


        </div>
    </div>
</footer>
