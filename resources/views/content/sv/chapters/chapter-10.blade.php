@php
    $chapterKey = 'chapter-10';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
@endphp
<x-layout :title="$chMeta['layout_title']">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            En del hävdar att vetenskapen har avmystifierat världen. Är denna
            triumfalism ett försök att få kontroll över människors övertygelser?
            Det finns ett specialfall av den faustiska frestelsen.
        </p>

        <p class="chapter-text">
            Detta kapitel handlar om världens och livets uppkomst. Syftet är inte
            att ifrågasätta de vetenskapliga modellerna för Big Bang eller för
            evolutionen. Vad jag är skeptisk till är den populära men märkliga idén
            att dessa modeller utgör ett stöd för ateism.
        </p>

        <h2 class="chapter-heading">I begynnelsen</h2>

        <p class="chapter-text">
            Det verkar som att många troende känner ett visst obehag över
            Big-bang-teorin. Hela världen skapades med en stor smäll, bara sådär.
            Vetenskapen har förklarat alltihop och någon Gud behövs inte, säger en
            del ateister. Många troende känner sig provocerade, medan många ateister
            känner sig bekräftade.
        </p>

        <p class="chapter-text">
            Men det kan också vara tvärtom. Den person som myntade begreppet "Big
            Bang" var astronomen Sir Fred Hoyle, som var ateist. Han var till en
            början mycket skeptisk till hela teorin och misstänkte att dess
            förespråkare hade djupt religiösa motiv. I en intervju med BBC sade han:
            "Anledningen till att forskare gillar 'Big Bang' är att de överskuggas
            av [Bibelns skapelseberättelse]. Det ligger djupt i de flesta forskares
            psyke att tro på den första sidan i Första Moseboken." Han uppfann
            termen som ett försök att göra den till åtlöje.
        </p>

        <p class="chapter-text">
            För en ateist som verkligen förstår sig på vetenskap kan Big Bang vara
            en ganska provocerande teori. Den handlar inte om universums skapelse,
            utan om dess historia. Närmare bestämt vad som hände under de första
            mikrosekunderna, timmarna och åren, och hur universum expanderade och
            svalnade.
        </p>

        <p class="chapter-text">
            Hur allting började, hur själva "explosionen" initierades, hur materien
            och naturlagarna skapades – detta är frågor som vetenskapen har svårt
            att ens spekulera om. Om ett mirakel är en händelse utan en naturlig
            orsak, så är hela universum ett enda gigantiskt mirakel.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/andromeda.JPG"
            alt="Andromedagalaxen"
            width="40" />

        <p class="chapter-text">
            Big Bang förklarar inte världens skapelse, utan dess historiska
            utveckling. På samma sätt förklarar darwinismen inte livets uppkomst,
            utan dess evolution. Hur den första levande cellen uppstod är ett
            notoriskt svårt pussel för vetenskapen att lösa. De två viktigaste
            frågorna – världens och livets uppkomst – är obesvarade av vetenskapen.
        </p>

        <h2 class="chapter-heading">Se upp för illusionen av förståelse</h2>

        <p class="chapter-text">
            Evolutionsbiologen Henry Gee kritiserar massmedia och populärvetenskapen
            för att de sprider missförstånd om evolutionen. I en artikel i tidskriften
            Nature skriver han:
        </p>

        <blockquote class="chapter-blockquote">
            Vi har alla sett reklamen. En rad av figurer som går från vänster till
            höger: först en apa som lufsar på alla fyra; sedan en halvt upprättgående
            man med ett svagt sken av intelligens och som kanske håller i en yxa;
            längre fram en lång och stolt man som bär på ett spjut och har päls; och
            till slut, användaren av den senaste bilen eller tvättmaskinen. Rubriken
            handlar om avancemang och progression och säger någonting i stil med
            "Evolution – nästa steg".<x-footnote-trigger
                label="1"
                text="Progressive evolution: Aspirational thinking, Nature." />
        </blockquote>

        <p class="chapter-text">
            Vad Gee reagerar emot är att sådana här bilder ger det felaktiga
            intrycket att evolutionen är en slags progressiv förbättringsprincip.
            Naturen skådas genom den mänskliga utvecklingsoptimismens lins. Man
            suggereras till att tro att det finns en i naturen inneboende kraft som
            drar allting mot det högre, det bättre, det starkare.
        </p>

        <p class="chapter-text">
            Det råder knappast något tvivel om att arter har utvecklats över tid,
            men populärvetenskapen ger ibland förklaringar som inte har något med
            seriös vetenskap att göra. Till exempel används formuleringar som
            "kampen för överlevnad leder till att arterna förbättras eftersom
            svagheter successivt elimineras" och "naturens blinde urmakare
            producerar slumpvis nya prototyper" och "naturen prövar sig fram enligt
            principen trial and error". Och så vidare.
        </p>

        <p class="chapter-text">
            Detta för associationerna till konkurrerande företag som drivs till att
            ständigt förbättra sina produkter. Eller till innovatörer som skapar och
            förfinar sina uppfinningar. Man ser likheter mellan vitt skilda ting och
            får en stark känsla att allt går ihop – "syntes utan analys". Man tror
            att konkurrensen bland djur liknar konkurrensen bland människor, och att
            båda fallen leder till samma sorts framsteg och utveckling.
        </p>

        <p class="chapter-text">
            En del tror att naturen fungerar på ungefär samma vis som mänskligt
            skapande och uppfinnande, som är rationellt och målstyrt. Därför tror
            de – undermedvetet – att naturen är besjälad med en människoliknande
            intelligens och vilja.
        </p>

        <p class="chapter-text">
            Det blir smått komiskt när man märker att många, som utger sig för att
            vara ateister, i själva verket tror på en övernaturlig livskraft. Behov,
            som förnekas i det medvetna, spelar ju gärna sina spratt i det
            undermedvetna.
        </p>

        <h2 class="chapter-heading">Den mystiska X-faktorn</h2>

        <p class="chapter-text">
            Under en tidsrymd av hundratals miljoner år har bakterier utvecklats
            till lejon, fåglar och människor. Frågan är hur detta har gått till.
            Alla borde vara överens om att mutation och naturligt urval är åtminstone
            en del av förklaringen. Detta är en kombination av naturlag och slump.
            Vetenskapsmän är dock inte eniga om vilken av de två som är viktigast.
            Det finns därför två skolor där den ena betonar lag och den andra slump.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/bird.JPG"
            alt="Fiskgjuse"
            caption="Varför skapade evolutionen fåglar? Berodde det på en lycklig slump och rena tillfälligheter? Eller finns det någon slags evolutionär naturlag som ökar chanserna?"
            width="40" />

        <p class="chapter-text">
            För att förstå skillnaden kan man föreställa sig hur det går till på
            ett kasino där hasardspelaren står mot "huset" (det vill säga
            kasinoägaren). Ett spel som till exempel roulette är designat så att
            huset alltid vinner i längden. För att gå med vinst måste huset
            försäkra sig om att det har oddsen och sannolikhetslagarna på sin sida.
            Hasardspelaren kan dock vinna om han har tur. Han måste således förlita
            sig på slumpen. Eller så hoppas han på ett underverk.
        </p>

        <p class="chapter-text">
            Seriösa vetenskapsmän söker efter regelbundenheter i naturen och försöker
            förklara dem. Resonemanget är analytiskt och kretsar kring observationer,
            experiment, Dna-molekyler och proteiner. I likhet med kasinoägaren är
            de intresserade av matematiska beräkningar av oddsen.
        </p>

        <p class="chapter-text">
            I kontrast till detta är de som har en stark tro på slumpens skapande
            förmåga. Slump-troende beräknar inte oddsen och tänker inte analytiskt.
            De gör ingen åtskillnad mellan vad som är möjligt och vad som är
            sannolikt. De argumenterar mindre som vetenskapsmän och mer hasardspelare
            som drabbats av speldjävulen.
        </p>

        <p class="chapter-text">
            Om evolutionen är lagbunden är det svårt att frigöra sig från tanken
            att allting var planerat från början. Varför är naturlagarna formulerade
            på ett sådant vis att materien är självskapande och utvecklar liv?
        </p>

        <p class="chapter-text">
            Lagsstyrd evolution kan leda till idén om Gud som naturens lagstiftare.
            Denna position antyder att naturlagarna – och kanske till och med den
            första levande cellen – har utformats på ett sådant sätt att livet
            oundvikligen skulle uppstå och växa i komplexitet. Gud blir då något av
            en programmerare som skriver koden och trycker på "Enter". När allt väl
            har satts i rörelse tar naturen hand om resten. Gud skapar universum och
            livets utgångspunkt, men tar sedan ett steg tillbaka. Han detaljstyr
            inte sin skapelse. Detta är en mer eller mindre strikt form av det som
            kallas "deism".
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/evol_tab4_swe.jpg"
            alt="1. Lag-evolution (deism) 2. Slump-evolution (ateism) 3. Målstyrd evolution (teism) 4. Livskraft-evolution (panteism)"
            width="50" />

        <p class="chapter-text">
            I det andra fallet, slumpstyrd evolution, behövs ingen Gud. Detta är
            alltså något som går bra ihop med ateism. Vägen från bakterier till
            fåglar var i så fall beroende av en lång serie lyckokast.
        </p>

        <p class="chapter-text">
            Men hur kan man avgöra om en osannolik händelse var resultatet av en
            blind lyckträff eller om det var ett gudomligt underverk? Vem kan skilja
            mellan slump och mirakel? Slump-evolutionismen lämnar en vidöppen dörr
            för Gud.
        </p>

        <p class="chapter-text">
            Målstyrd evolution innebär att arterna har skapats av en intelligens.
            Denna position går bra ihop med föreställningen att Gud styr och skapar
            allt med sitt finger, det vill säga teism. En annan variant är
            livskraft-evolution, vilket påminner om någon slags panteism. Detta
            brukar också kallas för "vitalism".
        </p>

        <p class="chapter-text">
            Hur man än vrider och vänder på det så är det svårt att undkomma en
            mystisk X-faktor. Det är svårt att hitta en position som ger en fast och
            säker grund för ateism.
        </p>

        <x-quotecard
            id="chapter-10"
            text="Överdriven tro på förnuftet kan skada förnuftet&nbsp;självt.
Om vi kräver svar på allt nöjer vi oss ofta med dåliga&nbsp;svar."
            align="center"
            lang="sv"
        />

        <h2 class="chapter-heading">Det sanna, det goda, det sköna</h2>

        <p class="chapter-text">
            Om evolutionen enbart hade drivits av principen om den bäst anpassades
            överlevnad, skulle vi förmodligen främst värdesätta de egenskaper som
            främjar vår fysiska överlevnad. Men allt passar inte in i detta mönster.
        </p>

        <p class="chapter-text">
            Hur är det möjligt att en hjärna, som formats av livet i djungeln och
            på savannen, kan syssla med sådant som algebra, kvantfysik och
            månfärder? Hur kan man tillskriva förnuftet rent gudomliga kvalitéer,
            och samtidigt hävda att människan inte är något annat än ett djur?
        </p>

        <p class="chapter-text">
            Om den mänskliga hjärnan enbart är byggd för överlevnad, är forskaren
            i grunden bara en mästare på manipulation – inte en genuin
            sanningssökare. För att överhuvudtaget kunna lita på vetenskapen måste
            vi tro att förnuftet når bortom överlevnaden – att det inte bara
            hungrar efter föda, utan också efter sanning.
        </p>

        <p class="chapter-text">
            Tänk på hur vi tar hand om andra, även om de inte direkt bidrar till
            vår överlevnad. Vi vårdar alla barn, oavsett förmåga, och vi tar hand
            om de äldre, oavsett om de är produktiva eller inte. Det är ett tydligt
            tecken på att vi värdesätter mer än bara överlevnad. Vi reagerar med
            motstånd mot kalla, rationella beräkningar som föreslår att vi ska göra
            oss av med de svagaste.
        </p>

        <p class="chapter-text">
            Och varför ligger det i våra gener att älska musik? Är inte detta en
            onödig egenskap för en "överlevnadsmaskin"? Musik har varit människans
            ständiga följeslagare genom historien. Den är djupt rotad i hennes själ.
            Värdet av musik är enormt, även om den inte tjänar något direkt praktiskt
            syfte.
        </p>

        <p class="chapter-text">
            Vetenskap är en strävan efter sanning. Etik är sökandet efter vad som
            är gott och rätt. Konst är sökandet efter det sköna. Det sanna, det
            goda, det sköna – detta kallas ibland för "den platonska treenigheten".
            Har detta sitt ursprung i den mystiska X-faktorn?
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="sv" :single="true" />
        </div>

        <h2 class="chapter-heading">Tomhetens lockelse</h2>

        <p class="chapter-text">
            En del anser att det finns enkla förklaringar till sådant som konst. De
            hävdar till exempel att musik uppstod eftersom den gav evolutionära
            fördelar – som att stärka gemenskapen i en grupp eller underlätta
            parbildning. Med tiden bidrog dessa fördelar till att egenskapen spreds.
        </p>

        <p class="chapter-text">
            Den som tänker kritiskt stannar upp här och ställer några frågor. Det
            är en förklaring, visst – men är den verkligen bra? Förklarar den till
            exempel vår kärlek till Beethovens symfonier? Ett sunt förhållningssätt
            är att gå djupare och analysera om den verkligen håller.
        </p>

        <p class="chapter-text">
            Vissa tycks redo att acceptera sådana förklaringar utan att tveka.
            Skälet kan vara mindre intellektuellt än känslomässigt: det finns en
            viss lockelse i tomheten. Om inget står över mig, står jag själv högst.
            Genom att hävda att universum är tomt får de en känsla av total kontroll.
        </p>

        <p class="chapter-text">
            Detta blir en sorts omvänd tro – en de inte är villiga att granska. Den
            skapar en blind fläck i det de kallar "rationalitet". Slutsatsen kommer
            först: universum saknar mening och syfte. Bevisen ordnas sedan för att
            passa den. Det som växer fram är en fast dogm om meningslöshet –
            ironiskt nog i strid med själva dygden kritiskt tänkande.
        </p>

        <p class="chapter-text">
            Det råder ingen tvekan om att den darwinistiska principen – slumpmässiga
            mutationer och naturligt urval – kan förklara mycket. Problemet är att
            vissa försöker pressa in allt i denna mall. Även om det skulle lyckas,
            skulle det snarare peka mot deism än ateism. Ursprunget till den första
            levande cellen förblir det yttersta mysteriet – gnistan som satte
            evolutionsmotorn i rörelse. Tanken att vetenskapen helt kan förklara
            bort mening och syfte är ateistiskt önsketänkande.
        </p>

        <p class="chapter-text">
            Det finns de som tror att de kan lösa mysteriet kring livets ursprung
            och komplexitet. De verkar inte inse hur enorm utmaningen är. De påminner
            om en hasardspelare som tror att han har ett system som kan spränga
            banken. Han vill att det ska finnas en lösning. Viljan att upptäcka
            mönster är stark – och därför upptäcker han ett. Han förväxlar känslan
            av förståelse med verklig förståelse. Viljestyrkan har tagit överhanden
            över intellektet.
        </p>

        <x-content-image
            src="/images/chapters/chapter-10/vagval_vetensk.png"
            alt="Vägskyltar som pekar i olika riktningar: 'Vilja till sanning' och 'Vilja till kontroll'."
            caption="En felsväng kan skada intellektet."
            width="50" />

        <h2 class="chapter-heading">Bortom illusionen av kontroll</h2>

        <p class="chapter-text">
            Överdriven tilltro till förnuftet kan, paradoxalt nog, skada förnuftet.
            När vi kräver svar på allt nöjer vi oss ofta med dåliga svar – och
            överger därmed det verkliga sanningssökandet.
        </p>

        <p class="chapter-text">
            Vetenskapen har inte avmystifierat världen och kommer aldrig att göra
            det. Tvärtom, ju mer man upptäcker, desto mer inser man hur lite man
            vet. Detta gäller såväl för den enskilde individen som för vetenskapen
            som helhet. Mysterierna blir bara djupare och djupare.
        </p>

        <p class="chapter-text">
            Albert Einstein sade:
        </p>

        <blockquote class="chapter-blockquote">
            Den vackraste och djupaste erfarenhet en människa kan ha är känslan av
            det mysteriösa. Det är den underliggande principen i både religion och
            i all seriös strävan i konst och vetenskap. Den som aldrig haft denna
            erfarenhet tycks mig vara, om inte död, så åtminstone blind.<x-footnote-trigger
                label="2"
                text="Ur «Mitt Credo», tal inför German League of Human Rights, Berlin 1932." />
        </blockquote>

        <p class="chapter-text">
            Vi måste släppa det intellektuella kontrollbegäret och acceptera att
            det finns saker vi aldrig kommer att förstå. Vi behöver röra oss bort
            från illusionen om förståelse och mot genuin insikt, även om den är
            begränsad. I denna tid av växande vetenskapsfientlighet måste vi tända
            en gnista av kärlek till sund vetenskap och verkligt sanningssökande.
        </p>

        <x-food-for-thought :number="10" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
