@php
    $chapterKey = 'chapter-5';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Vi lever i en värld av rigida övertygelser och snedvridna världsbilder.
            Vishet börjar med ödmjukheten att säga: "Jag kanske har fel."
            Överraskande nog kan tron hjälpa förnuftet att hålla sig på jorden.
        </p>

        <h2 class="chapter-heading">Världsförbättrare behöver denna dygd</h2>

        <p class="chapter-text">
            Att skapa en verklighetsbild är lite grand som att lägga pussel. Den
            som saknar omdöme kan pussla ihop vad som helst. Resultatet blir en
            förvrängd världsbild. För att passa ihop bitarna behövs den enkla
            insikten att man kan tänka fel.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/pzlhammare_sm.png"
            alt="Pussel med hjälp av hammare"
            caption="Envishet och dåligt omdöme. Man utgår från den bild man vill se och anpassar bitarna därefter."
            width="30" />

        <p class="chapter-text">
            Vi lever i en komplicerad och problemfylld värld. Nu mer än någonsin
            behöver vi lära oss konsten att foga ihop en riktig bild av verkligheten.
        </p>

        <p class="chapter-text">
            Det är många idag som vill arbeta för en bättre framtid, och det är
            bra! Tyvärr är det vanligt att goda intentioner förenas med alltför
            säkra åsikter. Risken är att saker i stället förvärras. Tvärsäkra
            idealister behöver lära sig att det inte räcker med goda avsikter.
            Även klokhet är en dygd.
        </p>

        <p class="chapter-text">
            I denna komplicerade värld är det sällan möjligt att vara helt
            tvärsäker på någonting. Det man kan sträva efter är ett gott omdöme.
        </p>

        <h2 class="chapter-heading">Konsten att lägga pussel</h2>

        <p class="chapter-text">
            Den som saknar tålamod kanske försöker tvinga pusselbitarna på plats.
            Med lite vilja går det att skapa vilken bild som helst. För att
            verkligen lösa uppgiften är det viktigt att vara uppmärksam på de
            bitar som inte passar ihop.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/3pussel.png"
            alt="Tre sätt att lägga pussel. 1. Sammanfogning av pusselbitar med hjälp av en hammare: För mycket syntes. 2. Vällagt pussel: Både analys och syntes. 3. Pusselbitar sågas itu av en såg: För mycket analys."
            width="90" />

        <p class="chapter-text">
            I Platons dialog Faidros påpekade Sokrates att det är en speciell konst
            att både kunna "stycka upp varje företeelse" och att kunna "se vitt
            spridda företeelser med en sammanfattande blick". Idag kallar vi detta
            för analys och syntes.
        </p>

        <ul>
            <li>Analys: De här sakerna liknar varandra, men egentligen hör de inte alls ihop.</li>
            <li>Syntes: De här sakerna kan tyckas vara olika, men egentligen passar de bra ihop.</li>
        </ul>

        <p class="chapter-text">
            Sokrates sade: "Själv är jag en älskare av de här sakerna, Faidros:
            av uppdelningar och sammanföranden, som ger mig möjlighet att både
            tala och tänka."<x-footnote-trigger
                label="1"
                text="Platon, Faidros 265d – 266b, Jan Stolpes översättning." />
        </p>

        <p class="chapter-text">
            Det gäller att både kunna se skillnader mellan likartade ting och att
            se likheter mellan olikartade ting. Ett gott omdöme består i att finna
            en balans mellan dessa sätt att tänka.<x-footnote-trigger
                label="2"
                text="Se Bryan Magee, En filosofs bekännelser, s. 168. Magee kritiserar den analytiska filosofin eftersom den förkastar syntesen och bara fokuserar på analys av begrepp." />
        </p>

        <p class="chapter-text">
            Utan analytiskt tänkande går det lätt över styr. Om man bara vill, går
            det att koppla ihop nästan vad som helst. Ett exempel på detta är
            konspirationsteorier, där en viss grupp människor associeras med all
            världens elände. Även politiska ideologier kan måla upp fiendebilder
            på ungefär samma sätt. Manipulativa demagoger – bedrägeriets mästare –
            kan få människor att helt fastna i denna mentala fälla.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="sv" :single="true" />
        </div>

        <h2 class="chapter-heading">Hur man blir en religiös besserwisser</h2>

        <p class="chapter-text">
            I många religiösa sammanhang är det syntesen som dominerar. Där finns
            ett mycket starkt behov av mening, sammanhang och bekräftelse. Allting
            måste gå ihop: Bibeln, historien, världshändelserna, vardagslivet. Den
            kritiska analysen kan upplevas som ett brutalt sågande i allt som är
            heligt.
        </p>

        <p class="chapter-text">
            Om inte allt går ihop kommer allt att ramla isär, tänker en del. Men
            vad blir följden om vi till varje pris vill harmonisera och sammanjämka
            Bibelns spretande mångfald?
        </p>

        <p class="chapter-text">
            Syntetiskt pusslande ger en känsla av bekräftelse och är stimulerande.
            Analyser kan innebära ett smärtsamt ifrågasättande av den egna
            övertygelsen. Vad händer om vi följer minsta motståndets lag? Är inte
            risken att vi skapar ett bibelpussel som färgas av våra själviska
            intressen och politiska värderingar? Och att vi börjar inbilla oss att
            Gud har ungefär samma åsikter som vi har?
        </p>

        <p class="chapter-text">
            Frågan är om aptiten på synteser har någonting med en verklig tro att
            göra. Med hjälp av fantasifulla associationer går det att se samband
            mellan allt möjligt och övertyga sig själv om precis vad som helst.
            Det är inte alls svårt att snärja in sig själv i falska insikter.
        </p>

        <x-quotecard
            id="chapter-5"
            text="När vi kräver total visshet nöjer vi oss ofta med tvärsäkert&nbsp;nonsens.
Vi bör vara tacksamma när vår världsbild skakas&nbsp;om&nbsp;ibland."
            align="center"
            lang="sv"
        />


        <h2 class="chapter-heading">Verklig tro handlar inte om tvärsäkerhet</h2>

        <p class="chapter-text">
            För den som tror på Gud finns en överraskande väg ut ur "tokerifällan".
            Målet är att hitta en metod för att inte bli alltför fäst vid sina
            idéer och att öppna sig för möjligheten att man kan ha fel.
        </p>

        <p class="chapter-text">
            Det börjar med att erkänna – ganska kontraintuitivt – att ens
            trosförmåga är ganska svag. Det är omöjligt att få allting att gå ihop.
            Vi kan glädja oss över att läsa om hur Kristus utförde underverk, som
            hur han förvandlade vatten till vin i Kanan. Samtidigt kan det vara
            svårt att tro att naturlagarna kan sättas ur spel. Skulle vår Skapare
            bli förtörnad över att vi inte alltid får det ena att gå ihop med det
            andra? Det är ju han som skapat vårt förnuft så rimligen borde han
            förstå att sådana här saker kan göra oss förbryllade.
        </p>

        <p class="chapter-text">
            En kristen kan mycket väl tro av hela sitt hjärta men bara halva sitt
            förstånd. Istället för att förlita sig på sin egen trosförmåga, kan
            man flytta fokus från sig själv till Gud, som ser och förstår alla våra
            bryderier. "... om vårt hjärta dömer oss kan vi inför honom övertyga
            det om att Gud är större än vårt hjärta och förstår allt."<x-footnote-trigger
                label="3"
                text="1 Johannesbrevet 3:20, Bibel 2000." />
        </p>

        <p class="chapter-text">
            I svagheten är kraften störst, sade Paulus. En svag trosförmåga kan
            betyda större tillit. Mängder av frågor lämnas obesvarade, men än sen?
            Hjärtats tro är inte beroende av om man har fullt grepp om
            kristendomens hemligheter.
        </p>

        <p class="chapter-text">
            Luther skrev i Stora katekesen:
        </p>

        <blockquote class="chapter-blockquote">
            Att hava en Gud, det kan du väl härav lära, betyder icke, att man kan
            taga honom och fatta om honom med händerna, eller stoppa honom i en
            pung eller innesluta honom i en kista. Utan det är att fatta honom,
            när man med hjärtat griper om honom och hänger fast vid honom.
        </blockquote>

        <h2 class="chapter-heading">Tron som en kopernikansk revolution</h2>

        <p class="chapter-text">
            En tillitsfull tro skapar en ny fixpunkt som gör det lättare att rubba
            ens självcentrerade tankebanor. Detta kan liknas vid en "kopernikansk
            revolution". Den gamla egocentriska världsbilden ersätts och placerar
            det gudomliga i centrum.
        </p>

        <x-content-image
            src="/images/chapters/chapter-5/kop_rev.png"
            alt="Från geocentrisk till heliocentrisk världsbild. Planeterna kretsar kring solen, som står i centrum."
            caption="Förr i tiden trodde folk att jorden står i centrum och att allting kretsar kring dem. Kopernikus visade att det tvärtom är solen som står i centrum."
            width="50" />

        <p class="chapter-text">
            Förnuftet kan göra misstag och foga ihop saker som egentligen inte alls
            hör ihop. Ens politiska och religiösa övertygelse kan bygga på rädsla
            och själviska önskningar. Att totalt förlita sig på sådant skapar en
            egocentrisk världsbild. Den som i stället fäster sitt hjärta vid Gud
            får en ny fixpunkt. Detta får allting att framstå i en bättre belysning.
        </p>

        <p class="chapter-text">
            Det är bra att ha insikter och åsikter men man bör inte klänga sig
            fast vid dem. Förtröstan på nåden hör ihop med öppenhet för att man
            kan ha fel. Ens föreställningar kanske behöver korrigeras och
            förbättras. På så vis kan tron bli en drivkraft till sanning och
            bildning.
        </p>

        <x-quotecard-image
            src="/images/quotecard-swe-courage-to-be-wrong.jpg"
            alt="Tron ger dig mod att erkänna att du kan ha fel!"
            text="Tron ger dig mod att erkänna att du kan ha fel!"
            lang="en"
            id="courage-to-be-wrong"
        />

        <p class="chapter-text">
            Att fästa sitt hjärta vid Gud innebär att inte fixera sig för mycket
            på en eller annan idé. Detta öppnar för den viktiga förmågan att hålla
            två motsatta idéer i huvudet samtidigt (integrering). Det blir lättare
            att lägga livets stora pussel eftersom det spelar mindre roll om ens
            världsbild rubbas då och då. Tillitstron är förnuftets bästa vän.
        </p>

        <x-food-for-thought :number="5" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
