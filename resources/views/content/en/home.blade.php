@php
    // TOC for all 12 chapters (the book's actual structure). Titles below match
    // the live site's TOC; chapter 1's title is a placeholder pending the final
    // wording. Chapter views are stubs — real content is a separate follow-up.
    $chapterTitles = [
        1 => 'Breakout: Escaping the Prison of Toxic Passions',
        2 => "Reformation: The Battle at the Centre of Today's Political Storm",
        3 => 'Trust: A Leap of Faith Begins an Adventure and Gives Life a Direction',
        4 => "Growth: A Cunning Snake Whispers That We Don't Need to Change",
        5 => 'Wisdom: How Trusting Faith Can Be Reason\'s Best Friend',
        6 => 'Illumination: Education as a Way Out of the Shadowlands',
        7 => 'Strength: Keep Your Head up When Everything Goes Wrong',
        8 => 'Integration: Handle Differences and the Round Squares of Life',
        9 => 'Secular: The Christian Invention That Saves Faith from Power',
        10 => "X-Factor: Embrace Life's Mystery and Spark a Love of Science",
        11 => 'Resilience: Can Humanism Survive Without a Divine Spark?',
        12 => 'Anchor: The Primal Force that Makes the Soul Unsellable',
    ];
    $chapters = collect($chapterTitles)->map(fn ($title, $n) => [
        'title' => $title,
        'route' => route('chapter', ['locale' => 'en', 'chapter' => "chapter-{$n}"]),
    ])->values()->all();
@endphp

<x-layout>
    <article class="prose-stone max-w-none">
        <h1 class="text-3xl font-bold tracking-tight">Welcome</h1>

        <p class="mt-4 text-lg leading-relaxed text-stone-700">
            This is placeholder introductory copy for the site. It sets the tone for
            the essays that follow and gives the reader a sense of what to expect
            before they dive into the chapters. Replace this with the real intro.
        </p>

        {{-- Sample quote cards --}}
        <x-quote-card
            text="The storm does not ask whether you are ready; it only asks whether you are anchored."
            attribution="Placeholder epigraph" />

        <x-quote-card
            text="To navigate plurality is not to choose one shore, but to learn the currents between them."
            attribution="Erik Pleijel" />

        <x-quote-card
            text="A bargain that costs you your bearings was never a bargain at all." />

        {{-- Sample 3-slide carousel --}}
        <h2 class="mt-10 text-xl font-semibold">A few highlights</h2>
        <x-carousel label="Highlights">
            <div class="bg-amber-50 p-10 text-center">
                <p class="text-xl font-medium">Slide one — an idea worth sitting with.</p>
            </div>
            <div class="bg-stone-100 p-10 text-center">
                <p class="text-xl font-medium">Slide two — a question the book returns to.</p>
            </div>
            <div class="bg-amber-50 p-10 text-center">
                <p class="text-xl font-medium">Slide three — an invitation to read on.</p>
            </div>
        </x-carousel>

        {{-- Table of contents --}}
        <x-toc :items="$chapters" heading="Chapters" />

        {{-- Amazon CTA — uses the BOOK title, not the site title. --}}
        <section class="mt-12 rounded-lg bg-stone-900 p-8 text-center text-white">
            <h2 class="text-2xl font-bold">{{ config('site.book_title') }}</h2>
            <p class="mt-2 text-stone-300">Available now in paperback and ebook.</p>
            {{-- Example wiring of the cookie-free click logger. Not yet added
                 elsewhere — see DECISIONS.md. --}}
            <a href="#"
               onclick="window.logEvent('Amazon CTA')"
               class="mt-5 inline-block rounded-md bg-amber-500 px-6 py-3 font-semibold text-stone-900 hover:bg-amber-400">
                Order on Amazon
            </a>
        </section>

        {{-- Register interest in the printed edition. --}}
        <x-book-interest-form />
    </article>
</x-layout>
