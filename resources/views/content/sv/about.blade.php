<x-layout title="Om mig">

    <article class="prose-stone max-w-none">

        {{-- ── Biografi ─────────────────────────────────────────────────────────── --}}
        <h1 class="chapter-title">Om mig</h1>

        <div class="mt-8 flex flex-col gap-8 sm:flex-row sm:items-start">
            <div class="flex-shrink-0 sm:w-1/3">
                <img
                    src="/images/ErikPleijelPortrait_sm.jpg"
                    alt="Porträtt av Erik Pleijel"
                    class="w-full max-w-[280px] rounded object-cover"
                >
            </div>
            <div class="sm:w-2/3">
                {{-- Biografitext — redigera här för att uppdatera författarens beskrivning --}}
                <p class="chapter-text">Jag heter Erik Pleijel. Min världsbild har formats av både studier och erfarenhet, inklusive praktiskt arbete med vattenförsörjningsprojekt i Afrika och Asien. För mig är teologi och filosofi som mest värdefulla när de kan ge vägledning i vardagen.</p>
            </div>
        </div>

        {{-- ── Bokutdrag ────────────────────────────────────────────────────────── --}}
        <x-book-excerpt-carousel
            :slides="config('book-excerpts.navigation-i-mangfalden-sv', [])"
            book="navigation-i-mangfalden" />



        {{-- ── Recensioner ──────────────────────────────────────────────────────── --}}
        <section class="mt-12">
            <h2 class="chapter-heading">Recensioner</h2>

            <x-quote-card
                text="I flyhänta, bitvis dramatiska texter tar han oss med till det folkmordsdrabbade Rwanda, inbördeskrigets Sri Lanka och ett absurt igenbommat Nordkorea... Fast någon vanlig tekniknörd är han inte, snarare en humanist, filosof och teolog."
                attribution="Från krönika av Stefan Edman i Bohusläningen [6/10-2014]" />
            <div class="mb-6 -mt-2">
                <x-image-popup
                    src="/images/press/EdmanKronika.jpg"
                    alt="Krönika av Stefan Edman i Bohusläningen"
                    triggerLabel="Läs artikeln" />
            </div>

            <x-quote-card
                text="Ur sina erfarenheter från livet reflekterar han om bistånd, filosofi och kristen tro på luthersk grund."
                attribution="Från recension av Mikael Mogren i Kyrkans Tidning [34-2014]" />
            <div class="mb-6 -mt-2">
                <x-image-popup
                    src="/images/press/RecensionKyrkansTidning.jpg"
                    alt="Recension av Mikael Mogren i Kyrkans Tidning"
                    triggerLabel="Läs recensionen" />
            </div>
        </section>

    </article>

</x-layout>
<x-site-footer />
