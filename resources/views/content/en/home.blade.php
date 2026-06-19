<x-layout>
    <x-slot:hero>
        <x-hero />
    </x-slot:hero>

    <article class="prose-stone max-w-none">

        <x-content-image
            src="/images/compass_magnet.png"
            alt="A magnet that interferes with a compass"
            width="40" />

        <h1 class="text-3xl font-bold tracking-tight">Does ‘Be Yourself’ Make You Better — or Worse?</h1>

        <p class="chapter-text">I was taken aback. What did she mean?</p>

        <p class="chapter-text">We were talking in a church youth group, and she explained that she had later turned away from the ideology she had grown up with.</p>

        <p class="chapter-text">Being authentic – being true to yourself – was something I believed in deeply. How could such an ideal be connected to Nazism?</p>

        <p class="chapter-text">As she went on to describe her parents' worldview, I remember thinking: this sounds a bit like Nietzsche – the emphasis on unlimited self-assertion, contempt for inhibition and moral constraints, the "will to power." I began to see how such ideas could fit together.</p>

        <p class="chapter-text">What does it really mean to "be authentic"? Many understand it as giving free rein to one's feelings and not holding them back. With such an interpretation, even an SS officer might have believed he was living "authentically" and "honestly." Without an ethical North Star, authenticity easily collapses into cruelty.</p>

        <p class="chapter-text">But it can also mean something very different: living in alignment with one's values and convictions. It means becoming a well-integrated person whose thoughts, emotions, and actions pull in the same direction – someone with the inner strength to resist not only external pressure, but also one's own impulses.</p>

        <p class="chapter-text">Both of these views are called authentic.</p>

        <p class="chapter-text">Here we face a fork in the road, leading in radically different directions.</p>

        <p class="chapter-text">The question is not only which path feels more appealing and liberating, but where each path ultimately leads.</p>

        <p class="chapter-text">The next time someone urges you "to be true to yourself" ask for clarification. True to what, exactly? To a passing feeling or to good values? Is it an excuse to offload raw impulses? Or is it about being true to what is true?</p>

        <p class="chapter-text">At a deeper level, it becomes a question of identity. Who do you want to be when you are yourself? Some choose wisely, others choose poorly.</p>

        <x-quotecard-image
            src="/images/quotecard-eng-be-true-to-yourself.jpg"
            alt="'Be true to yourself!' we say. Does that make you better — or worse?"
            text="'Be true to yourself!' we say.\nDoes that make you better — or worse?"
            lang="en"
            id="be-true-to-yourself"
        />

        {{-- Sample quote cards --}}
        <x-quotecard-image
            src="/images/quotecard-eng-might-is-right.jpg"
            alt="Might makes right — is it worth it? Powerful nations may break the law and make the world tremble. But fear is not trust. Nations that are not trusted have no real friends."
            text="Might makes right — is it worth it?\nPowerful nations may break the law and make the world tremble.\nBut fear is not trust.\nNations that are not trusted have no real friends."
            lang="en"
            id="might-is-right"
        />

        <x-quotecard-image
            src="/images/quotecard-eng-emotions-horses.jpg"
            alt="Emotions are powerful horses. They set you in motion. Do you master them — or do they master you?"
            text="Emotions are powerful horses.\nThey set you in motion.\nDo you master them — or do they master you?"
            lang="en"
            id="emotions-horses"
        />

        <x-quotecard-image
            src="/images/quotecard-eng-nationalism-alcohol.jpg"
            alt="National pride works like alcohol. Small doses provide courage and confidence. Larger doses bring tunnel vision, clouded judgment, and belligerence."
            text="National pride works like alcohol.\nSmall doses provide courage and confidence.\nLarger doses bring tunnel vision, clouded judgment, and belligerence."
            lang="en"
            id="nationalism-alcohol"
        />

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
        <x-toc heading="Chapters" id="chapters" />

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
        <x-buy-book />

        {{-- EN page --}}
        <x-book-excerpt-carousel
            :slides="config('book-excerpts.adventures-and-reflections-en')"
            book="adventures-and-reflections" />

        <x-about-teaser />

    </article>
</x-layout>
<x-site-footer />
