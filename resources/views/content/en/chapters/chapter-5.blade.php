@php
    $chapterKey = 'chapter-5';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            We live in a world of rigid beliefs and distorted worldviews. True
            wisdom begins with the humility to say, 'Maybe I'm wrong.' Surprisingly,
            faith can help keep reason grounded.
        </p>

        <h2 class="chapter-heading">World-Improvers Need This Virtue</h2>

        <p class="chapter-text">
            Creating a picture of reality is a bit like doing a jigsaw puzzle.
            Those who lack good judgement can put anything together. The result
            is a distorted view of the world. To put the pieces together, you need
            the simple realisation that you can be wrong.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/pzlhammare_sm.png"
            alt="Putting the pieces of the puzzle together with a hammer."
            caption="Stubbornness and poor judgement. You start with the image you want to see and adapt the pieces accordingly."
            width="30" />

        <p class="chapter-text">
            We live in a complicated and troubled world. Now more than ever, we
            need to learn the art of piecing together a true picture of reality.
        </p>

        <p class="chapter-text">
            Many people today want to work for a better future, and that is a good
            thing! Unfortunately, it is common to combine good intentions with
            stubborn certainty. The danger is that things will only get worse. The
            overconfident idealists must learn that good intentions are not enough.
            Practical wisdom is also a virtue.
        </p>

        <p class="chapter-text">
            In this complicated world, it is rarely possible to be absolutely
            certain about anything. What you can strive for is good judgement.
        </p>

        <h2 class="chapter-heading">The Art of Putting Together a Puzzle</h2>

        <p class="chapter-text">
            If you have a lack of patience, you can force the puzzle pieces into
            place. With some willpower you can create any picture you want. To
            really solve the puzzle, it is important to pay attention to the pieces
            that do not fit together.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/3pzl_eng.png"
            alt="Puzzle with a hammer (too much synthesis); Well-made puzzle: (both analysis and synthesis); Sawn puzzle (too much analysis)."
            width="80" />

        <p class="chapter-text">
            In Plato's dialogue Phaedrus, Socrates pointed out that it is a special
            art to be able both to "cut up every phenomenon" and to "see widely
            scattered phenomena with a comprehensive view". Today we call this
            analysis and synthesis.
        </p>

        <ul>
            <li>Analysis: These things are similar, but they don't really belong together.</li>
            <li>Synthesis: These things seem to be different, but in fact they go well together.</li>
        </ul>

        <p class="chapter-text">
            Socrates said: "I myself am a lover of these things, Phaedrus: of
            divisions and combinations, which enable me both to speak and to
            think."<x-footnote-trigger
                label="1"
                text="Plato, Phaedrus 265d – 266b." />
        </p>

        <p class="chapter-text">
            It is important to be able to see differences between similar things
            and similarities between different things. Good judgement is about
            finding a balance between these ways of thinking.<x-footnote-trigger
                label="2"
                text="See Bryan Magee, Confessions of a Philosopher. Magee criticises analytical philosophy because it rejects synthesis and focuses only on the analysis of concepts." />
        </p>

        <p class="chapter-text">
            Without analytical thinking, things can easily get out of hand. If
            you want to, you can connect almost anything. An example of this is
            conspiracy theories, which associate a certain group of people with
            all the misery in the world. In the same way, political ideologies can
            create images of enemies. Manipulative demagogues – the masters of
            deception – can make people completely stuck in this mental trap.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="en" :single="true" />
        </div>

        <h2 class="chapter-heading">How to Become a Religious Know-It-All</h2>

        <p class="chapter-text">
            In many religious contexts, synthesis dominates. There is a strong need
            for meaning, coherence and confirmation. Everything must fit together:
            the Bible, history, world events, everyday life. Critical analysis can
            be perceived as disrespecting the sacred.
        </p>

        <p class="chapter-text">
            Some people think that if everything doesn't fit together, everything
            will fall apart. But what are the consequences of trying to harmonise
            and reconcile the diversity of the Bible at all costs?
        </p>

        <p class="chapter-text">
            Synthetic puzzles provide a sense of affirmation and are stimulating.
            Analysis can involve a painful questioning of one's own beliefs. What
            happens when we follow the path of least resistance? Isn't there a
            danger that we will create a biblical puzzle coloured by our selfish
            interests and political values? And that we begin to imagine that God
            has the same views as we do?
        </p>

        <p class="chapter-text">
            The question is whether this appetite for synthesis has anything to do
            with real faith. With the help of imaginative associations, it is
            possible to see connections between all sorts of things and to convince
            oneself of almost anything. It is not at all difficult to become
            entangled in false insights.
        </p>

        <x-quotecard
            id="chapter-5"
            text="When we demand total certainty, we often settle for confident&nbsp;nonsense.
We should be grateful when our worldview is shaken once&nbsp;in&nbsp;a&nbsp;while."
            align="center"
            lang="en"
        />

        <h2 class="chapter-heading">Real Faith Is Not About Stubborn Certainty</h2>

        <p class="chapter-text">
            For those who believe in God, there is a surprising way out of the
            'follies trap'. The aim is to find a method of not getting too attached
            to your ideas, and to open yourself up to the possibility that you might
            be wrong.
        </p>

        <p class="chapter-text">
            It starts with recognising – rather counter-intuitively – that your
            capacity to believe is rather weak. It is impossible to make everything
            fit together. We can rejoice in reading about how Christ performed
            miracles, like how he turned water into wine in Canaan. At the same
            time, it may be hard to believe that the laws of nature can be
            overturned. Would our Creator be offended that we can't always reconcile
            the one with the other? Surely, as the Creator of our reason, He
            understands that these things can baffle us.
        </p>

        <p class="chapter-text">
            A Christian may believe with all his heart, but only with part of his
            head. Instead of relying on our own capacity to believe, we can shift
            the focus from ourselves to God, who sees and understands all our
            confusions. "When our hearts condemn us, we know that God is greater
            than our hearts and understands all things."<x-footnote-trigger
                label="3"
                text="1 John 3:20." />
        </p>

        <p class="chapter-text">
            In weakness there is strength, said the Apostle Paul. A weak capacity
            to believe can mean a greater trusting faith. Many questions remain
            unanswered, but so what? A trusting faith does not depend on
            understanding all the mysteries of Christianity.
        </p>

        <p class="chapter-text">
            Martin Luther wrote:
        </p>

        <blockquote class="chapter-blockquote">
            To have a God … does not mean that you can take him and grasp him with
            your hands, or put him in a purse, or enclose him in a coffin. It is
            to grasp him with the heart and cling to him.<x-footnote-trigger
                label="4"
                text="Martin Luther, Large Catechism." />
        </blockquote>

        <h2 class="chapter-heading">Faith as a Copernican Revolution</h2>

        <p class="chapter-text">
            Trusting faith creates a new centre that makes it easier to challenge
            your self-centred ways of thinking. This can be likened to a 'Copernican
            revolution'. It replaces the old egocentric worldview and places the
            divine at the centre.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/kop_rev.png"
            alt="From geocentric to heliocentric worldview. The planets orbit the sun, which is at the centre."
            caption="In the past, people believed that the earth was at the centre and that everything revolved around it. Copernicus showed that, on the contrary, the sun is at the centre."
            width="50" />

        <p class="chapter-text">
            Reason can make mistakes and put things together that don't belong
            together. Your political and religious beliefs can be based on fear
            and selfish desires. Total reliance on these things creates a
            self-centred worldview. Those who turn their hearts to God instead have
            a new centre. Everything appears in a clearer light.
        </p>

        <p class="chapter-text">
            It is good to have insights and opinions about things, but you should
            not get too attached to them. Trust in grace is linked to openness to
            the possibility that you may be wrong. Your ideas may need to be
            corrected and improved. In this way, faith can become a driving force
            for truth and education.
        </p>

        <x-quotecard-image
            src="/images/quotecard-eng-courage-to-be-wrong.jpg"
            alt="Faith gives you the courage to admit you may be wrong!"
            text="Faith gives you the courage to admit you may be wrong!"
            lang="en"
            id="courage-to-be-wrong"
        />

        <p class="chapter-text">
            To attach one's heart to God means not to fixate too much on one idea
            or the other. This gives you the important ability to hold two opposing
            ideas in your mind at the same time (integration). It makes the great
            puzzle of life easier to solve, because it doesn't matter so much if
            your worldview is shaken from time to time. Trusting faith is reason's
            best friend.
        </p>
        <x-food-for-thought :number="5" lang="en" />

        <x-toc heading="Chapters" />
    </article>
</x-layout>
<x-site-footer />
