<x-layout>
    <x-slot:hero>
        <x-hero />
    </x-slot:hero>

    <article class="prose-stone max-w-none">
        <h1 class="text-3xl font-bold tracking-tight">Välkommen</h1>

        <p class="mt-4 text-lg leading-relaxed text-stone-700">
            Detta är en platshållartext som inledning till webbplatsen. Den anger
            tonen för essäerna som följer och ger läsaren en känsla av vad som
            väntar innan kapitlen tar vid. Ersätt detta med den riktiga inledningen.
        </p>

        <x-quotecard-image
            src="/images/quotecard-swe-be-true-to-yourself.jpg"
            alt="'Var sann mot dig själv!' säger vi. Gör det oss bättre – eller sämre?"
            text="'Var sann mot dig själv!' säger vi.\nGör det oss bättre – eller sämre?"
            lang="sv"
            id="be-true-to-yourself"
        />
        <x-quotecard-image
            src="/images/quotecard-swe-might-is-right.jpg"
            alt="Makt är rätt — är det värt det? Mäktiga nationer kan bryta mot lagen och få världen att darra. Men rädsla är inte tillit. Nationer som inte går att lita på har inga verkliga vänner."
            text="Makt är rätt — är det värt det?\nMäktiga nationer kan bryta mot lagen och få världen att darra.\nMen rädsla är inte tillit.\nNationer som inte går att lita på har inga verkliga vänner."
            lang="sv"
            id="might-is-right"
        />



        {{-- Exempel på karusell med 3 bilder --}}
        <h2 class="mt-10 text-xl font-semibold">Några höjdpunkter</h2>

        <x-carousel label="Höjdpunkter">
            <div class="bg-amber-50 p-10 text-center">
                <p class="text-xl font-medium">Bild ett — en tanke värd att dröja vid.</p>
            </div>
            <div class="bg-stone-100 p-10 text-center">
                <p class="text-xl font-medium">Bild två — en fråga som boken återkommer till.</p>
            </div>
            <div class="bg-amber-50 p-10 text-center">
                <p class="text-xl font-medium">Bild tre — en inbjudan att läsa vidare.</p>
            </div>
        </x-carousel>

        <x-quotecard-image
            src="/images/quotecard-swe-emotions-horses.jpg"
            alt="Känslor är kraftfulla hästar. De sätter dig liv i rörelse. Behärskar du dem – eller behärskar de dig?"
            text="Känslor är kraftfulla hästar.\nDe sätter dig liv i rörelse.\nBehärskar du dem – eller behärskar de dig?"
            lang="sv"
            id="emotions-horses"
        />

        <x-quotecard-image
            src="/images/quotecard-swe-nationalism-alcohol.jpg"
            alt="Nationell stolthet fungerar som alkohol. Små doser ger mod och självförtroende. Större doser ger tunnelseende, grumlat omdöme och aggressivitet."
            text="Nationell stolthet fungerar som alkohol.\nSmå doser ger mod och självförtroende.\nStörre doser ger tunnelseende, grumlat omdöme och aggressivitet."
            lang="sv"
            id="nationalism-alcohol"
        />

        {{-- Innehållsförteckning --}}
        <x-toc heading="Kapitel" id="chapters" />

        {{-- //TODO use this?
        Amazon-CTA — använder BOKENS titel, inte webbplatsens titel. --}}

        <section class=" mt-12 rounded-lg bg-stone-900 p-8 text-center text-white">
            <h2 class="text-2xl font-bold">{{ config('site.book_title') }}</h2>
            <p class="mt-2 text-stone-300">Finns nu som pocket och e-bok.</p>
            {{-- Exempel på den kakfria klickloggaren. Ännu inte tillagd på andra
                 ställen — se DECISIONS.md. --}}
            <a href="#"
               onclick="window.logEvent('Amazon CTA')"
               class="mt-5 inline-block rounded-md bg-amber-500 px-6 py-3 font-semibold text-stone-900 hover:bg-amber-400">
                Beställ på Amazon
            </a>
        </section>

        {{-- Anmäl intresse för den tryckta utgåvan. --}}

        <x-buy-book lang="sv" />

        {{-- SV page --}}
        <x-book-excerpt-carousel
            :slides="config('book-excerpts.navigation-i-mangfalden-sv')"
            book="navigation-i-mangfalden" />

        <x-about-teaser />

    </article>

</x-layout>
<x-site-footer />
