<x-layout title="About me" :alternates="['en' => 'https://erikpleijel.com/about', 'sv' => 'https://erikpleijel.se/om-mig']">

    <article class="prose-stone max-w-none">

        {{-- ── Biography ──────────────────────────────────────────────────────── --}}
        <h1 class="chapter-title">About me</h1>

        <div class="mt-8 flex flex-col gap-8 sm:flex-row sm:items-start">
            <div class="flex-shrink-0 sm:w-1/3">
                <img
                    src="/images/ErikPleijelPortrait_sm.jpg"
                    alt="Portrait of Erik Pleijel"
                    class="w-full max-w-[280px] rounded object-cover"
                >
            </div>
            <div class="sm:w-2/3">
                {{-- Bio text — edit here to update the author description --}}
                <p class="chapter-text">My name is Erik Pleijel, and I'm from Sweden. My outlook has been shaped by both study and experience, including hands-on work with water supply projects in Africa and Asia. To me, theology and philosophy are most valuable when they offer guidance for everyday life.</p>
            </div>
        </div>



        <x-book-excerpt-carousel
            :slides="config('book-excerpts.adventures-and-reflections-en', [])"
            book="adventures-and-reflections" />

        {{-- ── Press reviews ────────────────────────────────────────────────────── --}}
        <section class="mt-12">
            <h2 class="chapter-heading">Reviews</h2>

            <x-quote-card
                text="In fast-moving, sometimes dramatic texts, he takes us to genocidal Rwanda, civil war Sri Lanka and an absurdly closed North Korea. ... But he is not an ordinary technology nerd, rather a humanist, philosopher and theologian."
                attribution="Column in Bohusläningen newspaper (6 Oct 2014), by Stefan Edman" />

            <x-quote-card
                text="Based on his life experience, he reflects on aid, philosophy and Christian faith on a Lutheran basis. It is a wise man who writes and his wisdom is often easily transferable to everyday life in Sweden."
                attribution="Review in KT, the Swedish church newspaper (issue 34-2014), by Bishop Mikael Mogren" />
        </section>

    </article>

</x-layout>
<x-site-footer />
