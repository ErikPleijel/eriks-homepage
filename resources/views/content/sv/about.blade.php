<x-layout title="Om mig" :alternates="['en' => 'https://erikpleijel.com/about', 'sv' => 'https://erikpleijel.se/om-mig']">

    <article class="prose-stone max-w-none">

        {{-- ── Biografi ─────────────────────────────────────────────────────────── --}}
        <h1 class="chapter-title">Om mig</h1>

        <div class="mt-4 block overflow-hidden">
            <img
                src="/images/ErikPleijelPortrait_sm.jpg"
                alt="Portrait of Erik Pleijel"
                class="float-left mr-4 mb-2 w-[120px] rounded object-cover"
            >

            <p class="chapter-text">Jag heter Erik Pleijel. Min världsbild har formats av både studier och erfarenhet, inklusive praktiskt arbete med vattenförsörjningsprojekt i Afrika och Asien. För mig är teologi och filosofi som mest värdefulla när de kan ge vägledning i vardagen.</p>

            <p class="chapter-text mt-3">”Var dig själv” är kanske det mest populära självhjälpsrådet i världen. För mig kom det som en liten chock att autenticitet kan ha en mörk sida (<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="underline">läs här</a>). Att vända blicken inåt innebär inte alltid att hitta en skatt av underbara saker.
            </p>

            <p class="chapter-text mt-3">Några år senare kom en ännu större chock. Jag bevittnade på nära håll de tragiska följderna av otyglade passioner. I inledningskapitlet av <i>Navigation i mångfalden</i> berättar jag om mina erfarenheter under folkmordet i Rwanda 1994. Detta är vad som händer när den faustiska pakten accepteras i stor skala. Det var ingen behaglig syn.</p>
        </div>
        <div>
            <h2 class="chapter-heading ">Utdrag ur boken:</h2>
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
