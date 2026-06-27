<x-layout title="About me" :alternates="['en' => 'https://erikpleijel.com/about', 'sv' => 'https://erikpleijel.se/om-mig']">

    <article class="prose-stone max-w-none">

        {{-- ── Biography ──────────────────────────────────────────────────────── --}}
        <h1 class="chapter-title">About me</h1>

        <div class="mt-4 block overflow-hidden">
            <img
                src="/images/ErikPleijelPortrait_sm.jpg"
                alt="Portrait of Erik Pleijel"
                class="float-left mr-4 mb-2 w-[120px] rounded object-cover"
            >

            <p class="chapter-text">My name is Erik Pleijel, and I'm from Sweden. My outlook has been shaped by both study and experience, including hands-on work with water supply projects in Africa and Asia. To me, theology and philosophy are most valuable when they offer guidance for everyday life.</p>

            <p class="chapter-text mt-3">'Be yourself' may be the most popular piece of self-help advice in the world. It came as a small shock to me that authenticity can have a dark side (<a href="{{ route('home', ['locale' => app()->getLocale()]) }}" class="underline">read here</a>). To look inward is not always to find a treasure of wonderful things.</p>

            <p class="chapter-text mt-3">A few years later, I was hit by an even greater shock. I witnessed firsthand the tragic consequences of unrestrained passions. In the opening chapter of <i>Adventures and Reflections</i>, I describe my experiences during the 1994 genocide in Rwanda. This is what happens when the Faustian Bargain is accepted on a massive scale. It was not a pleasant sight.</p>
        </div>
        <div>
            <h2 class="chapter-heading">Excerpts from the book:</h2>
        </div>


        <x-book-excerpt-carousel
            :slides="config('book-excerpts.adventures-and-reflections-en', [])"
            book="adventures-and-reflections" />

        <div class="flex justify-center m-12">
            <x-buy-book lang="en" :single="true" />
        </div>
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
