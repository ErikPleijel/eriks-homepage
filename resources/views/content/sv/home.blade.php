<x-layout :alternates="['en' => 'https://erikpleijel.com/', 'sv' => 'https://erikpleijel.se/']">
    <x-slot:hero>
        <x-hero />
    </x-slot:hero>

    <article class="prose-stone max-w-none">

        <x-content-image
            src="/images/compass_magnet.png"
            alt="En magnet som stör en kompass"
            width="40" />

        <h2 class="text-3xl font-bold tracking-tight">”Var dig själv” – gör det oss bättre eller sämre?</h2>


        <p class="chapter-text font-bold">”Mina föräldrar var nazister,” sade hon. ”Och de lärde mig att vara autentisk.”</p>

        <p class="chapter-text">Jag blev smått chockerad. <i>Vad menade hon?</i></p>

        <p class="chapter-text">Vi samtalade i en kyrklig ungdomsgrupp, och hon förklarade att hon senare hade vänt sig bort från den ideologi hon vuxit upp med.</p>

        <p class="chapter-text font-bold">Att vara autentisk – att vara sann mot sig själv – var något jag själv trodde starkt på. Hur kunde ett sådant ideal kopplas till nazismen? </p>

        <p class="chapter-text">När hon fortsatte att beskriva sina föräldrars världsbild minns jag att jag tänkte: <i>det här låter lite grand som Nietzsche</i> – betoningen på gränslös självhävdelse, förakt för hämningar och moraliska begränsningar, ”viljan till makt”. Jag började ana hur det trots allt kunde hänga ihop.</p>

        <p class="chapter-text">Vad betyder det egentligen att ”vara autentisk”? Många uppfattar det som att ge fritt utlopp för sina känslor och inte hålla dem tillbaka. <b>Med en sådan tolkning hade till och med en SS-officer kunnat tro att han levde ”autentiskt” och ”ärligt”.</b> Utan en etisk polstjärna förfaller autenticitet lätt till grymhet.</p>

        <p class="chapter-text">Men det kan också betyda något helt annat: att leva i linje med sina värderingar och övertygelser. Det innebär att bli en väl integrerad människa vars tankar, känslor och handlingar drar åt samma håll – någon med inre styrka att stå emot inte bara yttre tryck, utan också sina egna impulser.</p>

        <p class="chapter-text">Båda dessa synsätt kallas autentiska. Frågan är inte bara vilken väg som känns mest tilltalande och befriande, utan också vart varje väg slutligen leder.</p>

        <p class="chapter-text">Frågan är inte bara vilken väg som känns mest tilltalande och befriande, utan också vart varje väg slutligen leder.</p>

        <p class="chapter-text font-bold">Nästa gång någon uppmanar dig att ”vara sann mot dig själv”, be om ett förtydligande. Sann mot vad, egentligen? Mot en flyktig känsla eller mot goda värden? Är det en ursäkt för att ge utlopp för sina råa impulser? Eller är det att vara sann mot det som är sant? </p>

        <p class="chapter-text mb-10">På ett djupare plan blir det en fråga om identitet. Vem vill du vara när du är dig själv? Somliga väljer klokt, andra väljer oklokt. </p>



        <x-quotecard-image
            src="/images/quotecard-swe-be-true-to-yourself.jpg"
            alt="'Var sann mot dig själv!' säger vi. Gör det oss bättre – eller sämre?"
            text="'Var sann mot dig själv!' säger vi.\nGör det oss bättre – eller sämre?"
            lang="sv"
            id="be-true-to-yourself"
        />


        <div class="h-20"></div>

        <h2 class="text-3xl font-bold tracking-tight text-center">Hur man förlorar vänner i 3&nbsp;steg</h2>

        <p class="text-center italic mb-4">Från individuell självbemästring till nationall självbemästring till världen.</p>

        <x-quotecard-grid>

            <x-quotecard-image
                src="/images/quotecard-swe-emotions-horses.jpg"
                alt="Känslor är kraftfulla hästar. De sätter dig liv i rörelse. Behärskar du dem – eller behärskar de dig?"
                text="Känslor är kraftfulla hästar.\nDe sätter dig liv i rörelse.\nBehärskar du dem – eller behärskar de dig?"
                lang="sv"
                id="emotions-horses"
                :show-slogan="false"
                :number="1"
                spacing="my-1"
            />

            <x-quotecard-image
                src="/images/quotecard-swe-nationalism-alcohol.jpg"
                alt="Nationell stolthet fungerar som alkohol. Små doser ger mod och självförtroende. Större doser ger tunnelseende, grumlat omdöme och aggressivitet."
                text="Nationell stolthet fungerar som alkohol.\nSmå doser ger mod och självförtroende.\nStörre doser ger tunnelseende, grumlat omdöme och aggressivitet."
                lang="sv"
                id="nationalism-alcohol"
                :show-slogan="false"
                :number="2"
                spacing="my-1"
            />

            <x-quotecard-image
                src="/images/quotecard-swe-might-is-right.jpg"
                alt="Makt är rätt — är det värt det? Mäktiga nationer kan bryta mot lagen och få världen att darra. Men rädsla är inte tillit. Nationer som inte går att lita på har inga verkliga vänner."
                text="Makt är rätt — är det värt det?\nMäktiga nationer kan bryta mot lagen och få världen att darra.\nMen rädsla är inte tillit.\nNationer som inte går att lita på har inga verkliga vänner."
                lang="sv"
                id="might-is-right"
                :show-slogan="false"
                :number="3"
                spacing="my-1"
            />

            <x-quotecard-image
                src="/images/quotecard_fb_swe.jpg"
                alt="Faustiski pakt, definition"
                text="faus·tisk pakt\n/ˈfaʊstɪsk pakt/1.\nI myten: en uppgörelse med djävulen där man säljer sin själ i utbyte mot makt eller status.\n2. I vidare mening: en överens-kommelse där man vinner en omedelbar fördel till priset av frihet eller integritet.\nSe även: frestelse · korruption"
                lang="en"
                id="faustian-bargain"
                spacing="my-1"
                :show-slogan="false"
            />
        </x-quotecard-grid>

        <div class="h-20"></div>

        <x-book-title-badge />
        <div class="flex justify-center mb-2">
            <x-buy-book lang="sv" :single="true" />
        </div>
        <x-book-actions book="faustian-bargain" />

        <x-toc heading="Kapitel" id="chapters" />

        <x-food-for-thought-carousel :startNumber="0" lang="sv" />

        <x-about-teaser />

    </article>

</x-layout>
<x-site-footer />
