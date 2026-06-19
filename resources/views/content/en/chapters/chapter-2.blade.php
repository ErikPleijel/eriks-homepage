@php
    $chapterKey = 'chapter-2';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
@endphp
<x-layout :title="$chMeta['layout_title']">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />


        <p class="chapter-lead">
            What happens when faith becomes a transaction and God resembles a mafia
            boss? This chapter examines how distorted theology can lead to a moral
            collapse in politics.
        </p>

        <h2 class="chapter-heading">Doing Business with Higher Powers</h2>

        <p class="chapter-text">
            Plato wrote an interesting and entertaining dialogue called
            <em>Euthyphro</em>. In this dialogue, Socrates speaks with Euthyphro,
            a man who considers himself an expert on divine matters. Socrates was
            curious about his theological knowledge and asked what true piety and
            godliness really were.
        </p>

        <p class="chapter-text">
            Euthyphro's response suggested he had never truly considered the
            question before. But after some discussion, it became clear what he
            really believed. To Euthyphro, piety meant a transactional relationship
            with the gods, offering sacrifices and worship in exchange for rewards
            and favours. By pleasing them, you can bring happiness and prosperity
            to your family and your city.
        </p>

        <p class="chapter-text">
            Socrates asked him to explain why these actions pleased the gods, but
            Euthyphro struggled to answer. Euthyphro seemed to believe that whatever
            the gods desired was, by definition, good – beyond the need for human
            explanation or understanding. They are the ones in power, so you just
            have to obey their commands.
        </p>

        <p class="chapter-text">
            Socrates didn't like this and thought Euthyphro was a lazy thinker.
            He rejected this 'might-is-right' philosophy. He wanted to understand
            what is right and true through dialogue and reasoning.
        </p>

        <p class="chapter-text">
            Plato saw the danger of overemphasising 'will' and 'power' as the most
            important attributes of God (or gods). When this happens, you risk
            abandoning reason and rejecting moral principles altogether, leading to
            ethical nihilism. Our only duty then is to 'obey orders' without
            thinking.
        </p>

        <h2 class="chapter-heading">Don't Worship the Mafia Godfather!</h2>

        <p class="chapter-text">
            Many people believe they can make a "contract" or "deal" with God –
            using their faith to buy favours and privileges. Quid pro quo: the
            right beliefs are expected to bring earthly and eternal rewards. Their
            image of God resembles a mafia godfather, offering protection and
            privileges to those who 'pay their dues.' This way of thinking about
            God influences more than just personal faith – it shapes how people
            view power, leadership, and even politics.
        </p>

        <p class="chapter-text">
            This may help explain one of the most puzzling phenomena in
            contemporary politics: Why do so many religious people give their
            unwavering support to immoral and unscrupulous leaders? Why have they
            accepted a Faustian bargain? Many are willing to sell their souls for
            status, power, and influence. In doing so, they enable demagogues to
            reshape the world into one where laws and principles no longer matter
            – where might is right and the strong are free to dominate the weak.
        </p>

        <p class="chapter-text">
            How can this happen? One possible answer is this: If people believe
            that God is like a mafia boss, it is not surprising that they expect
            him to choose leaders who behave the same way. They see nothing wrong
            with supporting politicians who have a transactional mindset. For them,
            securing benefits and privileges becomes more important than focusing
            on values and principles.
        </p>

        <p class="chapter-text">
            We need to be reminded of one of the most valuable and liberating
            insights of the Protestant Reformation, led by Martin Luther in the
            16th century: There is no quid pro quo deal with God. Faith is about
            grace, not transactions. God is not a mafia godfather.
        </p>

        <p class="chapter-text">
            At the heart of today's great political storm is a battle for the soul
            of Christianity.
        </p>

        <x-food-for-thought :number="2" />

        <h2 class="chapter-heading">No Bargains with God</h2>

        <p class="chapter-text">
            According to the tradition of the Reformation, salvation is not based
            on a "do X and you will be saved" kind of deal. Suppose someone says,
            "In order to be saved and avoid punishment, it is necessary to confess
            one's sin, repent, and show humility." Such conditions can undermine
            the very virtues they are meant to promote: repentance and humility.
        </p>

        <p class="chapter-text">
            It is sometimes presented as a free choice, but in reality, it can
            feel more like an "offer at gunpoint" – ask for mercy or perish! Can
            confessions made under threat be genuine and credible? Isn't there a
            risk of exaggerating one's sins out of sheer fear, confessing all
            sorts of things just to escape punishment? Such fear does not cultivate
            self-knowledge; it only triggers the instinct for self-preservation.
        </p>

        <p class="chapter-text">
            "Show humility, or else…" We can imagine a person striving for humility
            in order to be saved. He confesses that he is full of sin and
            selfishness, denies himself, and renounces his own worth. He declares
            that all his efforts are futile and that he deserves nothing. Yet,
            paradoxically, this exercise in self-loathing can itself be an act of
            pride. Does he secretly hope that God will admire him for his humility?
            Does he begin to feel superior to those who, in his view, are not as
            humble as he is? If he is proud of his humility, he is anything but
            humble.
        </p>

        <p class="chapter-text">
            "Do X and you will be saved!" But how do you know that you are doing
            X with sufficient sincerity, passion and intensity? There are only two
            ways. Either you doubt that you have met the requirements, leading to
            fear and anxiety. Or you believe you have, leading to complacency and
            self-righteousness. Fear or vanity – there is no escape.
        </p>

        <p class="chapter-text">
            In either case, it is man who seeks to remain in control. He wants to
            place demands on God, expecting Him to fulfil His part of the bargain.
            But this transactional mindset leads to superficiality – it does not
            cultivate true self-knowledge or an examined life.
        </p>

        <p class="chapter-text">
            "It is easier for a camel to pass through the eye of a needle than for
            a rich man to enter the kingdom of God," said Jesus. But it is hardly
            any easier for those who have a transactional faith and don't want to
            let go of their illusions of privilege and entitlement. When Jesus'
            disciples realised how difficult it was, they were terrified. "Who then
            can be saved?" they asked. "Jesus looked at them and said, 'For men it
            is impossible, but not for God. For with God all things are
            possible.'"<x-footnote-trigger
                label="1"
                text="Mark 10:25–27." />
        </p>

        <p class="chapter-text">
            The Reformation tradition teaches that man cannot save himself. We must
            relinquish our imagined privileges and illusions of control. At first,
            this idea may seem unsettling – even frightening. But in the end, it
            is profoundly liberating.
        </p>
    </article>
</x-layout>
