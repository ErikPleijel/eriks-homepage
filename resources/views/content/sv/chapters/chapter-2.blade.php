@php
    $chapterKey = 'chapter-2';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Vad händer när tron blir en affärsuppgörelse och Gud liknar en
            maffiaboss? Det här kapitlet undersöker hur förvrängd teologi skapar
            moralisk kollaps i politiken.
        </p>

        <h2 class="chapter-heading">Att göra affärer med högre makter</h2>

        <p class="chapter-text">
            Platon skrev en intressant och underhållande dialog som heter
            <em>Eutyfron</em>. I denna dialog samtalade Sokrates med Eutyfron,
            som uppfattade sig själv som expert på gudomliga ting. Sokrates var
            nyfiken på hans teologiska kunskaper och frågade vad sann fromhet och
            gudaktighet egentligen är.
        </p>

        <p class="chapter-text">
            Eutyfron svarade på ett sätt som visade att han förmodligen inte hade
            funderat på den saken tidigare. Men efter en stunds diskussion blev
            det tydligt hur han egentligen trodde. För Eutyfron innebar fromhet
            att ha en transaktionell affärsrelation med gudarna: belöningar och
            förmåner i utbyte mot offer och vördnad. Genom att behaga dem kan man
            bringa lycka och framgång för sin familj och sin stad.
        </p>

        <p class="chapter-text">
            Sokrates bad honom förklara varför dessa handlingar behagar dem, men
            det kunde han inte riktigt svara på. Vad gudarna önskar och vill är
            av definitionen gott, och inte något som människan behöver förklara
            eller förstå, verkade han mena. Det är de som har makten, så det är
            bara att lyda deras befallningar.
        </p>

        <p class="chapter-text">
            Sokrates gillade inte detta och tyckte att Eutyfron var en lat tänkare.
            Han förkastade denna "makt är rätt"-filosofi. Han ville förstå vad som
            är rätt och sant genom att samtala och resonera.
        </p>

        <p class="chapter-text">
            Platon såg faran i att överbetona "vilja" och "makt" som de viktigaste
            egenskaperna hos Gud (eller gudarna). När detta sker riskerar man att
            överge förnuftet och förkasta moraliska principer helt och hållet,
            vilket leder till etisk nihilism. Vår enda plikt är då att "lyda order"
            utan att tänka.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="sv" :single="true" />
        </div>

        <h2 class="chapter-heading">Dyrka inte maffians gudfader!</h2>

        <p class="chapter-text">
            Många tror att det går att ingå ett "avtal" och en affärsrelation med
            Gud. De använder tron för att köpa sig förmåner och privilegier. Quid
            pro quo: Rätt tro belönas med jordisk och evig lycka. Gudsbilden
            påminner lite grand om maffians gudfader, som ger beskydd och privilegier
            till dem som är trogna och betalar. Detta sätt att tänka om Gud påverkar
            mer än bara den personliga tron – det formar hur man ser på makt,
            ledarskap och till och med politik.
        </p>

        <p class="chapter-text">
            Detta kan bidra till att förklara ett av de mest förbryllande
            fenomenen i dagens politik: Varför ger så många religiösa människor
            sitt orubbliga stöd till omoraliska och skrupelfria ledare? Varför har
            de accepterat en faustisk pakt? Många är villiga att sälja sin själ
            för status, makt och inflytande. På så sätt möjliggör de för demagoger
            att skapa en värld där lagar och principer inte längre spelar någon
            roll – en värld där makt är rätt och de starkare kan göra vad de vill
            mot de svagare.
        </p>

        <p class="chapter-text">
            Hur kan detta ske? Här är ett möjligt svar: Om folk tror att Gud är
            som en "maffiaboss" är det inte förvånande om de tror han utväljer
            ledare som beter sig på samma sätt. De ser inget fel i att stödja
            politiker som har ett transaktionellt tankesätt. För dem blir det
            viktigare att skaffa förmåner och privilegier än att fokusera på
            värderingar och principer.
        </p>

        <p class="chapter-text">
            Vi behöver påminnas om en av de mest värdefulla och befriande
            insikterna från den protestantiska reformationen, som leddes av Martin
            Luther på 1500-talet: Vi måste överge all tanke på "tjänster och
            gentjänster" i relation till Gud. Tron handlar om nåd, inte om
            transaktioner. Gud är inte en maffiagudfader.
        </p>

        <p class="chapter-text">
            I centrum av dagens stora politiska storm pågår en kamp om
            kristendomens själ.
        </p>

        <x-quotecard
            id="chapter-2"
            header="Trons skuggsida:"
            text="I samma ögonblick som dyrkan av Gud blir dyrkan av makt, urholkas moralen till “den&nbsp;starkares&nbsp;rätt”."
            align="center"
            lang="sv"
        />

        <h2 class="chapter-heading">Inget köpslående med Gud</h2>

        <p class="chapter-text">
            Enligt den lutherska traditionen är frälsningen inte baserad på ett
            avtal av typen "gör X så blir du frälst". Anta att någon säger: "För
            att bli frälst och undvika straff är det nödvändigt att bekänna sin
            synd, ångra sig och visa ödmjukhet." Sådana villkor kan underminera
            just de dygder de är avsedda att främja: ånger och ödmjukhet.
        </p>

        <p class="chapter-text">
            Detta framställs som ett fritt val, men för många kan det kännas mer
            som ett "erbjudande under pistolhot" – be om nåd eller dö! Kan
            bekännelser under hot vara äkta och trovärdiga? Är inte risken att
            man blåser upp sin synd och skuld och bekänner allt möjligt i blotta
            förskräckelsen? Sådana hot uppväcker självbevarelsedriften och inte
            förmågan till självinsikt.
        </p>

        <p class="chapter-text">
            "Visa ödmjukhet, annars…" Vi kan föreställa oss en person som strävar
            efter ödmjukhet för att bli frälst. Han bekänner att han är full av
            synd och egoism. Han förnekar sig själv och hävdar att han är
            värdelös. Han säger att alla hans ansträngningar är lönlösa och att
            han inte förtjänar någonting. Men paradoxalt nog kan denna övning i
            självförakt vara en handling av stolthet. Hoppas han i hemlighet att
            Gud kommer att beundra honom för hans ödmjukhet? Börjar han förakta
            dem som han tycker inte är lika ödmjuka som han själv? Om han är stolt
            över sin ödmjukhet är han allt annat än ödmjuk.
        </p>

        <p class="chapter-text">
            "Gör X så blir du frälst!" Men hur vet man att man gör X med
            tillräcklig äkthet, iver och intensitet? Det finns bara två alternativ.
            Antingen tvivlar man på om man har uppfyllt kraven, vilket leder till
            rädsla och ångest. Eller så tror man att man har det, vilket leder
            till självbelåtenhet och självrättfärdighet. Rädsla eller fåfänga –
            det finns ingen utväg.
        </p>

        <p class="chapter-text">
            I vilket fall är det människan som vill ha kontrollen. Det är hon som
            vill kunna ställa krav på Gud, som måste uppfylla sin del av avtalet.
            Men detta transaktionella tankesätt leder till ytlighet – det främjar
            inte sann självkännedom eller ett reflekterat liv.
        </p>

        <p class="chapter-text">
            "Det är lättare för en kamel att komma igenom ett nålsöga än för en
            rik att komma in i Guds rike.", sade Jesus. Det är knappast enklare
            för den som har en transaktionell tro och som inte kan släppa taget om
            sina inbillade privilegier. När Jesu lärjungar förstod hur svårt det
            är, blev de helt förskräckta. "Vem kan då bli räddad?", frågade de.
            "Jesus såg på dem och sade: 'För människor är det omöjligt, men inte
            för Gud. Ty för Gud är allting möjligt.'"<x-footnote-trigger
                label="1"
                text="Markus 10:25–27, Bibel 2000." />
        </p>

        <p class="chapter-text">
            Den lutherska traditionen lär att människan inte kan rädda sig själv.
            Vi måste avstå från våra inbillade privilegier och illusionen att vi
            har någon kontroll. Till en början kan denna idé verka oroande – till
            och med skrämmande. Men i slutändan är det djupt befriande.
        </p>
        <x-food-for-thought :number="2" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
