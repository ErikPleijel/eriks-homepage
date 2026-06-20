@php
    $chapterKey = 'chapter-8';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            När demagoger skapar splittring längtar vi efter harmoni. Kanske detta
            är ett misstag. Kanske vi borde sträva efter ett annat ideal: förmågan
            att hålla ihop en komplex värld.
        </p>

        <h2 class="chapter-heading">Fyra fallgropar i försöken att skapa harmoni</h2>

        <p class="chapter-text">
            Hur kan människor från olika kulturer leva i ett harmoniskt förhållande?
            Vad ska de göra om de är främlingar för varandra och inte har så mycket
            gemensamt? Ska de eftersträva enhet eller mångfald? Vill de leva i
            jämlikhet eller försöker en grupp dominera? Detta ger fyra möjligheter.
        </p>

        <ol>
            <li class="mt-3"><strong>Mosaik: Jämlikhet och mångfald.</strong> I en mosaik lever folk
            från olika kulturer sida vid sida. De håller fast vid sina respektive
            traditioner och de byter inte språk eller ändrar sitt sätt att leva och
            tänka. Ingen kultur ses som överlägsen den andre. Harmonin blir dock
            lätt rubbad och man är hela tiden rädd för att någon ska börja dominera.
            I den här situationen måste man vara politiskt korrekt och gå som på
            nålar för att inte kränka någon. Allting är förknippat med identitet,
            stolthet och mindervärdeskomplex. Risken är att folk går varandra på
            nerverna.</li>

            <li class="mt-3"><strong>Segregering: Dominans och mångfald.</strong> I ett segregerat
            samhälle flyter vissa folkgrupper ovanpå. Det är som olja och vatten:
            de kan aldrig blandas hur mycket man än rör om. Ett exempel på detta är
            Sydafrika och Namibia under apartheid. Maktreligionens förespråkare tror
            att det är en gudomlig ordning att vissa får ha makt och privilegier. Om
            de andra bara underkastar sig kan de bli accepterade likt barn i en
            familj. Sammanhållningen bör grundas på underdånig respekt och
            patriarkalisk välvilja, anser de.</li>

            <li class="mt-3"><strong>Smältdegel: Jämlikhet och enhet.</strong> En smältdegel skapas
            när alla folkgrupper skär bort rötterna till sina respektive traditioner
            och bara ser till det som är gemensamt. Den kan lätt absorbera idéer och
            intryck från jordens alla hörn. Här utvecklas en världskultur med
            lättkonsumerad mat, konst och musik. Smältdegeln blir flyktig och
            ohistorisk och skyr allt som är komplicerat. De som håller fast vid sin
            tradition betraktas som onormala och blir utfrysta.</li>

            <li class="mt-3"><strong>Homogenisering: Dominans och enhet.</strong> Människor i en
            likformig grupp tänker gärna att det som är vanligt måste vara normalt.
            Och det som är normalt måste också vara naturligt. Och det som är
            naturligt är förmodligen en gudomligt inrättad ordning. Alla avvikande
            element måste motas ut eller transformeras. Här blir det beundransvärt
            att vara politiskt inkorrekt och den som hackar ned på minoriteter blir
            betraktad som tuff och stark. De mest brutala formerna av homogenisering
            är etnisk rensning och folkmord.</li>
        </ol>

        <p class="chapter-text">
            Vilken av dessa strategier bör vi välja? Lägg märke till att alla har
            en sak gemensamt. De är olika sätt att undvika det som är annorlunda.
            Förhoppningen är att man till slut ska uppnå ett harmoniskt tillstånd,
            fritt från friktioner. Följden blir dock ofta det rakt motsatta.
        </p>

        <p class="chapter-text">
            I stället för att söka harmoni till varje pris kan vi sätta upp ett
            nytt ideal. Vi kan eftersträva förmågan att integrera.
        </p>

        <h2 class="chapter-heading">Ödmjuk stolthet och respektfull uppriktighet</h2>

        <p class="chapter-text">
            Vi behöver lära oss att hantera stoltheten över den egna nationen,
            traditionen, tron, särarten, identiteten etc. Vi borde sträva efter ett
            slags "ödmjuk stolthet". Vi bör vara tillräckligt stolta för att vårda
            om våra egna samhällen och bevara vårt kulturarv. Och vi bör vara
            ödmjuka nog att inte se ner på andra folk och att erkänna de mörkare
            delarna av vår historia.
        </p>

        <p class="chapter-text">
            Vi behöver lära oss konsten att förena motsatser. Det som ofta orsakar
            polarisering är kampen mellan det politiskt korrekta och det politiskt
            inkorrekta. Detta är två ytterligheter som bör undvikas. Politiskt
            korrekt innebär att vara respektfull men inte uppriktig. Det leder lätt
            till hyckleri. Politiskt inkorrekt innebär att säga vad man tycker utan
            att visa respekt. Det leder lätt till mobbning.
        </p>

        <p class="chapter-text">
            En väl integrerad person kan hålla två tankar i huvudet samtidigt. Det
            går att vara både sanningsenlig och hänsynsfull. Förmågan att lösa
            denna runda kvadrat är väsentlig för den som verkligen vill kommunicera
            och göra sig förstådd.
        </p>

        <p class="chapter-text">
            Brutal ärlighet utan respekt leder sällan till sanning. Alltför ofta
            leder den i stället till missförstånd.
        </p>

        <x-content-image
            src="/images/chapters/chapter-8/roundsquare.png"
            alt="En rund kvadrat"
            caption="Lösningen på en skenbar motsägelse. En rund kvadrat är i själva verket en cylinder: Från ett perspektiv ser den ut som en cirkel, från ett annat ser den ut som en kvadrat. Genom äkta synteser kan livets motsatser förenas."
            width="35" />



        <x-quotecard
            id="chapter-8"
            header="Undvik två ytterligheter:"
            text="“Politiskt korrekt” – respektfull&nbsp;men&nbsp;oärlig.
“Politiskt inkorrekt” — ärlig&nbsp;men&nbsp;respektlös.
Var sanningsenlig – och&nbsp;hänsynsfull."
            align="center"
            lang="sv"
        />

        <p class="chapter-text">
            Rättroende dogmatiker kan inte ha fel. Men det kan inte heller
            relativister, för i deras tankevärld finns ju inget som är rätt eller
            fel. Båda är ovilliga att lyssna på motargument. Ingen av dem förstår
            att de är instängda i sina intellektuella fixeringar.
        </p>

        <p class="chapter-text">
            Sokrates kunde engagera människor och locka fram bättre tankar och
            idéer. Känn dig själv! sade han. Var medveten om din egen okunnighet!
            Bara så kan vi frigöra oss från skenvetande. För att bli klokare behöver
            vi hjälpas åt genom att samtala, menade han.<x-footnote-trigger
                label="1"
                text="Läs Försvarstalet av Platon!" />
        </p>

        <p class="chapter-text">
            Detta var inte en dialog mellan döva, där ingen lyssnar på andras
            argument. Om den som motsäger mig har rätt är jag den förste att ge
            efter, sade Sokrates. Han sade att "vart resonemangets vindar än blåser
            – dit måste vi bege oss." Det är den här formen av ge-och-ta-dialog som
            kan ge den platonska insikten: Sanningen är något som man kan närma sig
            och som i någon slags mening existerar.<x-footnote-trigger
                label="2"
                text="Platon, Staten 394d, Jan Stolpes översättning." />
        </p>

        <p class="chapter-text">
            "Jag har den absoluta Sanningen", säger dogmatikern. "Din sanning är
            inte min sanning", säger relativisten. Ingen av dem söker sanningen
            genom dialog med andra. Eftersom de är instängda i sina skal, kan de
            inte förändras, växa och utvecklas.
        </p>

        <p class="chapter-text">
            Men säg att det finns en objektiv Sanning som står över våra privata
            favoritidéer. I så fall öppnas möjligheten att våra åsikter behöver
            korrigeras. Att ha Sanningen som ledstjärna håller oss vakna från både
            dogmatisk och relativistisk slummer. De som gör det kan bidra med en
            viktig sak i vår problemfyllda värld: att sprida konsten att samtala
            och resonera.
        </p>

        <h2 class="chapter-heading">Fronesis – en gammal dygd som behöver återupplivas</h2>

        <p class="chapter-text">
            En viktig nyckel till integrering är det som Aristoteles kallade för
            fronesis, vilket kan översättas som praktisk klokhet, sunt förnuft och
            gott omdöme. Detta är något som utvecklas genom arbets- och
            livserfarenhet och genom bildning.
        </p>

        <p class="chapter-text">
            Det är en intuitiv kunskapsform som innebär att kunna urskilja vad som
            är väsentligt och oväsentligt i varje enskild situation. Det gäller att
            kunna överväga olika handlingsalternativ för att välja det bästa av dem.
        </p>

        <x-content-image
            src="/images/chapters/chapter-8/aristoteles_2.png"
            alt="Aristoteles"
            caption="Aristoteles"
            width="25" />

        <p class="chapter-text">
            I boken Den nikomachiska etiken utvecklade Aristoteles en teori om hur
            vi kan kultivera känslorna så att de harmoniserar med omdömet. Han
            framhävde betydelsen av goda vanor. När vi var barn, var våra känslor
            lite oslipade och inte finjusterade till ett gott omdöme. Vi hade en
            tendens att gilla att göra dåliga och okloka saker. Vi hyste motvilja
            mot att göra bra och kloka saker. Känslomässig förfining kräver
            konsekvent övning. När vi skapar goda vanor lär vi oss att tycka om att
            göra bra saker och ogilla att göra dåliga saker.
        </p>

        <p class="chapter-text">
            Denna process är relaterad till kultiveringen av dygder, särskilt
            fronesis, som hör ihop med måttfullhet. I det praktiska livet behöver
            vi ofta finna den gyllene medelvägen och inte gå till överdrift åt något
            håll. Vi får varken överreagera eller underreagera.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="sv" :single="true" />
        </div>

        <h2 class="chapter-heading">"Halvbildade experter"</h2>

        <p class="chapter-text">
            Experter är helt oumbärliga eftersom de är kunniga inom ett visst
            område. Samtidigt hör det till sakens natur att de är mer okunniga om
            vad som ligger utanför. Som alla människor är de begränsade.
        </p>

        <p class="chapter-text">
            Men tänk om de saknar kunskap om en viktig sak, nämligen kunskap om sin
            okunskap. Tänk om de har en svag och diffus förståelse för sina
            begränsningar. Om de brister i självkännedom drabbas de lätt av
            självöverskattning och uttalar sig tvärsäkert om saker de inte förstår.
            Eftersom kompetensområdet är som en liten ö i en stor ocean, är det
            troligt att de ofta är ute på okänt vatten utan att de inser det.
        </p>

        <p class="chapter-text">
            Det är den här sortens "halvbildning" som Sokrates tyckte sig se hos
            den tidens tekniker och ingenjörer. Han märkte att de visserligen var
            mycket kunniga inom sitt område men …
        </p>

        <blockquote class="chapter-blockquote">
            … eftersom de var skickliga på att utöva sin konst ansåg sig var och en
            därtill visast också i de högsta ting, och den felbedömningen fördunklade
            den vishet som de faktiskt hade …<x-footnote-trigger
                label="3"
                text="Platon, Sokrates försvarstal 22d, Jan Stolpes översättning." />
        </blockquote>

        <p class="chapter-text">
            En teknokrati är ett styre av halvbildade experter. Att vara expert på
            ett område kan skapa en falsk känsla att vara expert på allt möjligt.
        </p>

        <h2 class="chapter-heading">Bildning har praktisk betydelse</h2>

        <p class="chapter-text">
            Kunskapsluckor fylls ofta med illusioner av kunskap – fördomar,
            felaktiga antaganden, förenklade lösningar. Detta är den blinda
            okunnighetens logik.
        </p>

        <p class="chapter-text">
            Bildning och humaniora skapar en medvetenhet om våra egna begränsningar.
            De odlar en form av upplyst okunnighet – en klarare insikt om vad vi
            inte vet. Denna medvetenhet stärker vår förmåga att navigera i en värld
            präglad av förändring, tvetydighet och motsägelser.
        </p>

        <p class="chapter-text">
            Detta är särskilt viktigt för dem i ledande ställning. Vi behöver
            bildade ledare som förenar expertkunskap med omdöme. De har kanske inte
            alltid de rätta svaren, men de vet hur man ställer bättre frågor – och
            hur man närmar sig problem genom dialog snarare än genom reflexmässiga
            reaktioner.
        </p>

        <p class="chapter-text">
            Denna förmåga utvecklas när vi lär oss att urskilja livets olika
            dimensioner – till exempel trygghet och frihet, rättvisa och
            barmhärtighet, det globala och det lokala, tro och förnuft, individ och
            kollektiv, tradition och framsteg.
        </p>

        <p class="chapter-text">
            Dessa motsatspar utlöser ofta stamreflexer: vi känner oss tvungna att
            välja sida och försvara den till varje pris. Komplexitet reduceras till
            slagord. Nyanser offras för känslan av tillhörighet.
        </p>

        <p class="chapter-text">
            En integrerad människa står emot den impulsen. Hon kan hålla samman
            motsatser och leva med tvetydighet utan att gripas av panik och utan
            att förklara krig.
        </p>

        <p class="chapter-text">
            Men integrering är svårt. Vi lever i en tid som erbjuder en genväg:
            att överlåta tänkandet till datorer.
        </p>

        <p class="chapter-text">
            I takt med att artificiell intelligens vuxit fram har uttrycket 'att
            sälja sin själ' fått en ny innebörd. Människan har något som AI saknar:
            fronesis. AI kan ha dåligt omdöme eftersom den saknar livserfarenhet,
            ansvarskänsla och intuitiv förståelse för tid och historia. Varje gång
            vi överlåter åt AI att fatta beslut vi själva kunde ha resonerat oss
            fram till, blir vi lite svagare. Mänsklig fronesis måste aktivt odlas –
            eftersom det är vi, inte våra verktyg, som i slutändan bär ansvaret för
            den värld vi skapar. Bildning är vårt existentiella försvar – det är så
            vi förhindrar att vår tjänare blir vår herre.
        </p>

        <x-food-for-thought :number="8" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
