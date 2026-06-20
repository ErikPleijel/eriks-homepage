@php
    $chapterKey = 'chapter-10';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Some say that science has demystified the world. Is this triumphalism
            an attempt to gain control over people's beliefs? There is a special
            case of the Faustian temptation.
        </p>

        <p class="chapter-text">
            This chapter deals with the origin of the world and life. Its purpose
            is not to question the scientific models of the Big Bang or evolution.
            What I am sceptical about is the popular but strange idea that these
            models provide support for atheism.
        </p>

        <h2 class="chapter-heading">In the Beginning</h2>

        <p class="chapter-text">
            It seems that many believers are uncomfortable with the Big Bang theory.
            The whole world was created with a bang, just like that. Science has
            explained everything and there is no need for God, say some atheists.
            Many believers feel provoked, while many atheists feel vindicated.
        </p>

        <p class="chapter-text">
            But it could also be the other way around. The person who coined the
            term "Big Bang" was the astronomer Sir Fred Hoyle, who was an atheist.
            He was initially very sceptical about the whole theory and suspected
            that its proponents had deeply religious motives. In an interview with
            the BBC, he said: "The reason why scientists like the 'Big Bang' is
            because they are overshadowed by the Book of Genesis [i.e. the creation
            story in the Bible]. It is deep within the psyche of most scientists to
            believe in the first page of Genesis." He invented the term as a mockery.
        </p>

        <p class="chapter-text">
            For an atheist that really understands science, the Big Bang can be a
            rather provocative theory. It is not about the creation of the universe,
            but about its history. Specifically, what happened in the first
            microseconds, hours and years, and how the universe expanded and cooled.
        </p>

        <p class="chapter-text">
            How it all began, how the "explosion" itself was initiated, how matter
            and the laws of nature were created – these are questions about which
            science finds it difficult to even speculate. If a miracle is an event
            without a natural cause, then the entire universe is one gigantic miracle.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/andromeda.JPG"
            alt="Andromeda galaxy"
            width="40" />

        <p class="chapter-text">
            The Big Bang does not explain the creation of the world, but its
            historical evolution. Similarly, Darwinism does not explain the creation
            of life, but its evolution. How the first living cell came into being is
            a notoriously difficult puzzle for science to solve. The two most
            important questions – the creation of the world and of life – are
            unanswered by science.
        </p>

        <h2 class="chapter-heading">Beware of The Illusion of Understanding</h2>

        <p class="chapter-text">
            Evolutionary biologist Henry Gee blames the mass media and popular
            science for spreading false ideas about evolution. In an article in the
            journal Nature, he writes:
        </p>

        <blockquote class="chapter-blockquote">
            We've all seen the commercials. A line of figures walking from left to
            right, first a shambling ape on all fours; the second, semi-erect with
            a vague glimmer of intelligence, and perhaps holding a hand-axe; further
            along, a tall, proud man, carrying a spear and wearing furs; and finally,
            a user of the latest car or washing machine. The caption will speak of
            advancement and progression, something like "Evolution – the Next
            Step".<x-footnote-trigger
                label="1"
                text="Progressive evolution: Aspirational thinking, Nature." />
        </blockquote>

        <p class="chapter-text">
            What Gee objects to is that such images give the false impression that
            evolution is some kind of progressive principle of improvement. Nature
            is seen through the lens of human optimism. You are led to believe that
            there is an inherent force in nature that pulls everything towards the
            higher, the better, the stronger.
        </p>

        <p class="chapter-text">
            There is hardly any doubt that species have evolved over time, but
            popular science sometimes gives explanations that have nothing to do
            with serious science. For example, they use phrases like "the struggle
            for survival leads to the improvement of species as weaknesses are
            gradually eliminated" and "nature's blind watchmaker randomly produces
            new prototypes" and "nature uses the principle of trial and error". And
            so on.
        </p>

        <p class="chapter-text">
            This brings to mind competing companies that are driven to constantly
            improve their products. Or innovators creating and refining their
            inventions. You see similarities between very different things and get a
            strong sense that everything fits together – "synthesis without
            analysis". It is believed that competition among animals is similar to
            competition among humans, and that both cases lead to the same kind of
            progress and development.
        </p>

        <p class="chapter-text">
            Nature is thought to work in much the same way as human creativity and
            invention, which is rational and goal oriented. Many people therefore
            believe – unconsciously – that nature is imbued with a human-like
            intelligence and will.
        </p>

        <p class="chapter-text">
            It becomes somewhat comical when one realises that many who claim to be
            atheists actually believe in a supernatural vital force. Needs that are
            denied in the conscious mind often play their tricks in the subconscious.
        </p>

        <h2 class="chapter-heading">The Mysterious X-Factor</h2>

        <p class="chapter-text">
            Over hundreds of millions of years, bacteria have evolved into lions,
            birds and humans. The question is, how did this happen? Everyone should
            agree that mutation and natural selection are at least part of the
            explanation. It is a combination of law and chance. But scientists
            disagree about which is more important. So there are two schools of
            thought, one emphasising law and the other chance.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/bird.JPG"
            alt="Osprey"
            caption="Why did evolution create birds? Was it a happy coincidence and pure chance? Or is there some kind of natural law of evolution that increases the odds?"
            width="40" />

        <p class="chapter-text">
            To understand the difference, imagine a casino where the player is
            pitted against the "house" (i.e. the casino owner). A game like roulette
            is designed so that the house always wins in the long run. In order to
            make a profit, the house must ensure that the odds and laws of
            probability are in its favour. However, the player can win if he is
            lucky. So he has to rely on chance. Or he can hope for a miracle.
        </p>

        <p class="chapter-text">
            Serious scientists look for regularities in nature and try to explain
            them. Their reasoning is analytical. It revolves around observations,
            experiments, DNA molecules and proteins. Like the casino owner, they are
            interested in mathematical calculations of the odds.
        </p>

        <p class="chapter-text">
            On the other side there are those who have a strong belief in the
            creative power of chance. "Chance believers" do not calculate the odds
            or think analytically. They make no distinction between what is possible
            and what is plausible. They are arguing less like scientists and more
            like gambling addicts.
        </p>

        <p class="chapter-text">
            If evolution is a law-based process, then it is hard to escape the idea
            that everything has been planned from the very beginning. Why are the
            laws of nature formulated in such a way that matter is self-creating and
            develops life?
        </p>

        <p class="chapter-text">
            Law-evolution can lead to the idea of God as the legislator of nature.
            This position suggests that the laws of nature – and perhaps even the
            first living cell – were designed in such a way that life would
            inevitably emerge and grow in complexity. God becomes something like a
            master programmer who writes the code and presses "Enter." Once
            everything is set in motion, nature takes care of itself. God creates
            the universe and life's starting point, but then steps back. He is not
            a micromanager of his creation. This is a more or less strict form of
            what is known as "deism."
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/evol_tab_eng.png"
            alt="1. Law-evolution (Deism) 2. Chance-evolution (Atheism) 3. Guided evolution (Theism) 4. Living force-evolution (Pantheism)"
            width="50" />

        <p class="chapter-text">
            In the second case, chance-evolution, there is no need for a God. This
            is something that fits well with atheism. The path from bacteria to
            birds depended on a long series of lucky accidents.
        </p>

        <p class="chapter-text">
            But how can you tell whether an improbable event was the result of blind
            luck or a godsent wonder? Who can tell the difference between chance and
            miracle? Chance-evolution leaves the door wide open for God.
        </p>

        <p class="chapter-text">
            Guided evolution means that species were created by an intelligence.
            This position fits well with the idea that God creates everything with
            his finger, i.e. theism. A related alternative is living force
            evolution, which is similar to pantheism. It is also known as vitalism.
        </p>

        <p class="chapter-text">
            Whichever way you look at it, it is hard to escape a mysterious
            X-factor. It is difficult to find a position that provides a firm and
            secure foundation for atheism.
        </p>

        <x-quotecard
            id="chapter-10"
            text="Excessive faith in reason can damage reason&nbsp;itself.
If we demand answers to everything, we often settle for bad&nbsp;answers."
            align="center"
            lang="en"
        />

        <h2 class="chapter-heading">The True, the Good, the Beautiful</h2>

        <p class="chapter-text">
            If evolution were driven solely by the principle of survival of the
            fittest, we would presumably value those qualities that favour our
            physical survival. But everything does not fit into this pattern.
        </p>

        <p class="chapter-text">
            How is it possible that a brain shaped by life in the jungle and
            savannah could produce such sophisticated intellectual endeavours as
            algebra, quantum physics and space exploration? How can you ascribe
            almost divine qualities to the mind while claiming that man is nothing
            more than an animal?
        </p>

        <p class="chapter-text">
            If the human brain is built purely for survival, then the scientist is
            little more than a master manipulator – incapable of seeking truth for
            its own sake. To trust science at all, we must believe reason reaches
            beyond survival – hungry not only for food, but for truth.
        </p>

        <p class="chapter-text">
            Think about how we care for others, even if they do not directly
            contribute to our survival. We care for all children, regardless of
            ability, and we care for the elderly, whether they are productive or
            not. This is a clear sign that we value more than just survival. Many
            of us react with resistance to cold, rational calculations that suggest
            we should get rid of the weakest.
        </p>

        <p class="chapter-text">
            Also, why is it in our genes to love music? Isn't this an unnecessary
            trait for a 'survival machine'? Music has been man's constant companion
            throughout history. It is deeply rooted in the human soul. The value of
            music is enormous, even if it serves no direct practical purpose.
        </p>

        <p class="chapter-text">
            Science is a quest for truth. Ethics is the quest for what is good and
            right. Art is the quest for the beautiful. The true, the good, the
            beautiful – this is sometimes called "the Platonic Trinity". Does it
            originate from the mysterious X-factor?
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="en" :single="true" />
        </div>

        <h2 class="chapter-heading">The Thrill of Emptiness</h2>

        <p class="chapter-text">
            Some people believe there are simple explanations for things like art.
            They argue that music, for example, provided evolutionary advantages –
            such as strengthening group cohesion or promoting pair bonding. Over
            time, such benefits helped this trait spread.
        </p>

        <p class="chapter-text">
            Anyone who thinks critically will pause here and ask a few questions.
            It is an explanation, certainly – but is it a good one? Does it really
            account for our love of Beethoven's symphonies, for example? A healthy
            response is to dig deeper and analyse whether it truly holds up.
        </p>

        <p class="chapter-text">
            Some people seem ready to accept such explanations without hesitation.
            The reason may be less intellectual than emotional: there is a certain
            thrill in emptiness. If nothing stands above me, then I stand at the
            top of the world. By insisting that the universe is empty, they gain a
            sense of total control.
        </p>

        <p class="chapter-text">
            This becomes a kind of reverse faith – one they are unwilling to
            examine. It creates a blind spot in what they call "rationality." The
            conclusion comes first: the universe is void of meaning and purpose.
            The evidence is then arranged to fit it. What emerges is a fixed dogma
            of meaninglessness – ironically at odds with the very virtue of critical
            thinking.
        </p>

        <p class="chapter-text">
            There is no doubt that the Darwinian principle – random mutation and
            natural selection – can explain a great deal. The concern is that some
            try to force-fit everything into this framework. Even if that were
            successful, it would arguably point more toward deism than atheism. The
            origin of the first living cell remains the ultimate enigma – the spark
            that set the evolutionary engine in motion. The idea that science can
            explain away meaning and purpose altogether is an atheist pipe dream.
        </p>

        <p class="chapter-text">
            There are those who believe they can solve the mystery of life's origin
            and complexity. They don't seem to grasp the immensity of the challenge.
            They are not unlike a gambler who thinks he has a system that can beat
            the house. He wants there to be a solution. The desire to detect a
            pattern is strong – and so he spots one. He confuses the feeling of
            understanding with actual understanding. His willpower has taken charge
            of his intellect.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/QuestForSigns.png"
            alt="Road signs pointing in different directions: 'Quest for truth' and 'Quest for control'."
            caption="A wrong turn may damage the intellect."
            width="50" />

        <h2 class="chapter-heading">Beyond the Illusion of Control</h2>

        <p class="chapter-text">
            Excessive faith in reason can, paradoxically, damage reason. When we
            demand answers to everything, we often settle for poor answers, thereby
            abandoning the true quest for truth.
        </p>

        <p class="chapter-text">
            Science has not and will never demystify the world. On the contrary, the
            more you discover, the more you realise how little you know. This is
            true of the individual as well as of science as a whole. The mysteries
            just keep getting deeper.
        </p>

        <p class="chapter-text">
            Albert Einstein said:
        </p>

        <blockquote class="chapter-blockquote">
            The most beautiful and deepest experience a man can have is the sense
            of the mysterious. It is the underlying principle of religion as well as
            all serious endeavour in art and science. He who never had this
            experience seems to me, if not dead, then at least blind.<x-footnote-trigger
                label="2"
                text="Albert Einstein, My Credo, a speech to the German League of Human Rights, Berlin 1932." />
        </blockquote>

        <p class="chapter-text">
            We must let go of the intellectual desire for control and accept that
            there are things we will never understand. We need to move away from the
            illusion of understanding towards genuine insight, however limited. In
            this age of growing anti-science sentiment, we need to light a spark of
            love for sound science and real truth-seeking.
        </p>
        <x-food-for-thought :number="10" lang="en" />

        <x-toc heading="Chapters" />
    </article>
</x-layout>
<x-site-footer />
