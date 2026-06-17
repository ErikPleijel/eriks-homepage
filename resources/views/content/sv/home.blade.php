@php
    // Innehållsförteckning för alla 12 kapitel (bokens faktiska struktur).
    // Kapiteltitlarna är platshållare tills vidare; de engelska titlarna är
    // redan ifyllda i en-versionen. Riktigt innehåll är en separat uppgift.
    $chapters = collect(range(1, 12))->map(fn ($n) => [
        'title' => "Kapitel {$n}",
        'route' => route('chapter', ['locale' => 'sv', 'chapter' => "chapter-{$n}"]),
    ])->all();
@endphp

<x-layout>
    <article class="prose-stone max-w-none">
        <h1 class="text-3xl font-bold tracking-tight">Välkommen</h1>

        <p class="mt-4 text-lg leading-relaxed text-stone-700">
            Detta är en platshållartext som inledning till webbplatsen. Den anger
            tonen för essäerna som följer och ger läsaren en känsla av vad som
            väntar innan kapitlen tar vid. Ersätt detta med den riktiga inledningen.
        </p>

        {{-- Exempel på citatkort --}}
        <x-quote-card
            text="Stormen frågar inte om du är redo; den frågar bara om du är förankrad."
            attribution="Platshållarmotto" />

        <x-quote-card
            text="Att navigera i mångfalden är inte att välja en strand, utan att lära sig strömmarna emellan dem."
            attribution="Erik Pleijel" />

        <x-quote-card
            text="Ett köpslående som kostar dig din kompass var aldrig något fynd." />

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

        {{-- Innehållsförteckning --}}
        <x-toc :items="$chapters" heading="Kapitel" />

        {{-- Amazon-CTA — använder BOKENS titel, inte webbplatsens titel. --}}
        <section class="mt-12 rounded-lg bg-stone-900 p-8 text-center text-white">
            <h2 class="text-2xl font-bold">{{ config('site.book_title') }}</h2>
            <p class="mt-2 text-stone-300">Finns nu som pocket och e-bok.</p>
            {{-- Exempel på den kakfria klickloggern. Ännu inte tillagd på andra
                 ställen — se DECISIONS.md. --}}
            <a href="#"
               onclick="window.logEvent('Amazon CTA')"
               class="mt-5 inline-block rounded-md bg-amber-500 px-6 py-3 font-semibold text-stone-900 hover:bg-amber-400">
                Beställ på Amazon
            </a>
        </section>

        {{-- Anmäl intresse för den tryckta utgåvan. --}}
        <x-book-interest-form />
    </article>
</x-layout>
