<x-layout :alternates="['en' => 'https://erikpleijel.com/', 'sv' => 'https://erikpleijel.se/']">
    <x-slot:hero>
        <x-hero />
    </x-slot:hero>

    <article class="prose-stone max-w-none">

        <x-content-image
            src="/images/compass_magnet.png"
            alt="A magnet that interferes with a compass"
            width="40" />

        <h2 class="text-3xl font-bold tracking-tight">Does ‘Be Yourself’ Make You Better — or Worse?</h2>


        <p class="chapter-text font-bold">“My parents were Nazis,” she said. “And they taught me to be authentic.”</p>

        <p class="chapter-text">I was taken aback. <i>What did she mean?</i></p>

        <p class="chapter-text">We were talking in a church youth group, and she explained that she had later turned away from the ideology she had grown up with.</p>

        <p class="chapter-text font-bold">Being authentic – being true to yourself – was something I believed in deeply. How could such an ideal be connected to Nazism?</p>

        <p class="chapter-text">As she went on to describe her parents' worldview, I remember thinking: <i>this sounds a bit like Nietzsche</i> – the emphasis on unlimited self-assertion, contempt for inhibition and moral constraints, the "will to power." I began to see how such ideas could fit together.</p>

        <p class="chapter-text">What does it really mean to "be authentic"? Many understand it as giving free rein to one's feelings and not holding them back. <b>With such an interpretation, even an SS officer might have believed he was living "authentically" and "honestly." Without an ethical North Star, authenticity easily collapses into cruelty.</b></p>

        <p class="chapter-text">But it can also mean something very different: living in alignment with one's values and convictions. It means becoming a well-integrated person whose thoughts, emotions, and actions pull in the same direction – someone with the inner strength to resist not only external pressure, but also one's own impulses.</p>

        <p class="chapter-text">Both of these views are called authentic. Here we face a fork in the road, leading in radically different directions.</p>

        <p class="chapter-text">The question is not only which path feels more appealing and liberating, but where each path ultimately leads.</p>

        <p class="chapter-text font-bold">The next time someone urges you "to be true to yourself" ask for clarification. True to what, exactly? To a passing feeling or to good values? Is it an excuse to offload raw impulses? Or is it about being true to what is true?</p>

        <p class="chapter-text mb-10">At a deeper level, it becomes a question of identity. Who do you want to be when you are yourself? Some choose wisely, others choose poorly.</p>






        <x-quotecard-image
            src="/images/quotecard-eng-be-true-to-yourself.jpg"
            alt="'Be true to yourself!' we say. Does that make you better — or worse?"
            text="'Be true to yourself!' we say.\nDoes that make you better — or worse?"
            lang="en"
            id="be-true-to-yourself"
        />

        <div class="h-20"></div>

        <h2 class="text-3xl font-bold tracking-tight text-center">How To Lose Friends in 3 Steps</h2>

        <p class="text-center italic mb-4">From individual self-mastery to national self-mastery to the world.</p>

        <x-quotecard-grid>

            <x-quotecard-image
                src="/images/quotecard-eng-emotions-horses.jpg"
                alt="Emotions are powerful horses. They set you in motion. Do you master them — or do they master you?"
                text="Emotions are powerful horses.\nThey set you in motion.\nDo you master them — or do they master you?"
                lang="en"
                id="emotions-horses"
                :show-slogan="false"
                :number="1"
            />

            <x-quotecard-image
                src="/images/quotecard-eng-nationalism-alcohol.jpg"
                alt="National pride works like alcohol. Small doses provide courage and confidence. Larger doses bring tunnel vision, clouded judgment, and belligerence."
                text="National pride works like alcohol.\nSmall doses provide courage and confidence.\nLarger doses bring tunnel vision, clouded judgment, and belligerence."
                lang="en"
                id="nationalism-alcohol"
                :show-slogan="false"
                :number="2"
            />


            <x-quotecard-image
                src="/images/quotecard-eng-might-is-right.jpg"
                alt="Might makes right — is it worth it? Powerful nations may break the law and make the world tremble. But fear is not trust. Nations that are not trusted have no real friends."
                text="Might makes right — is it worth it?\nPowerful nations may break the law and make the world tremble.\nBut fear is not trust.\nNations that are not trusted have no real friends."
                lang="en"
                id="might-is-right"
                :show-slogan="false"
                :number="3"
            />

            <x-quotecard-image
                src="/images/quotecard_fb_eng.jpg"
                alt="Faustian Bargain, definition"
                text="faus·tian bar·gain\n /ˈfaʊstiən ˈbɑːrɡən/\n 1.In myth: a bargain with the devil, trading one’s soul for power or status.\n 2.More broadly: Any deal where immediate advantage is gained at the cost of freedom or integrity.\nSee also: temptation · corruption"
                lang="en"
                id="might-is-right"
                :show-slogan="false"
            />
        </x-quotecard-grid>

        <div class="h-20"></div>



        <x-book-title-badge />
        <div class="flex justify-center mb-2">
            <x-buy-book lang="en" :single="true" />
        </div>
        <x-book-actions book="faustian-bargain" />


        {{-- Table of contents --}}
        <x-toc heading="Chapters" id="chapters" />

        <x-food-for-thought-carousel :startNumber="0" lang="en" />

        <x-about-teaser />

    </article>
</x-layout>
<x-site-footer />
