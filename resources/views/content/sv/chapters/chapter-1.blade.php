@php
    $chapterKey = 'chapter-1';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
@endphp
<x-layout :title="$chMeta['layout_title']">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Jag berättar om mina erfarenheter från Rwanda 1994. Dessa "lärdomar från
            nollpunkten" belyser vad som kan hända när den inre moralkompassen inte
            fungerar.
        </p>

        <div role="note"
             class="my-8 rounded-md border-l-4 border-amber-500 bg-amber-50 p-4 text-amber-900">
            <strong>Obs!</strong> Det följande innehåller en beskrivning av ett
            folkmord och kan vara ganska upprörande.
        </div>

        <h2 class="chapter-heading">En otäck syn</h2>

        <p class="chapter-text">
            Vad är den värsta tänkbara konsekvensen av polarisering? En gång för
            länge sedan fick jag se detta med mina egna ögon.
        </p>

        <p class="chapter-text">
            I det första kapitlet i min essäbok <em>Navigation i mångfalden</em>
            berättar jag om de upplevelser jag hade när jag reste i Rwanda under
            folkmordet 1994. Jag skildrar en resa med en rebellofficer som visade
            en plats där människor hade blivit massakrerade. Att gå omkring bland
            mängder av döda kroppar är en omskakande upplevelse kan jag lova.
        </p>

        <p class="chapter-text">
            Kapitlet avslutas med en reflektion om Gud, det onda och livets mening.
        </p>

        <h2 class="chapter-heading">Jag besöker ett fängelse och träffar mördarna</h2>

        <p class="chapter-text">
            I bokens andra kapitel berättar jag om mitt besök i ett rwandiskt
            fängelse, med fångar som gjort sig skyldiga till övergreppen. Det var
            två år efter folkmordet. Det var helt fullpackat med mångdubbelt fler
            fångar än fängelset var byggt för. En av dem visade mig runt och jag
            pratade med några av dem. Till min förvåning var de rätt vänliga och
            trevliga.
        </p>

        <p class="chapter-text">
            På fängelsegården såg jag en grupp med fångar som stod och sjöng
            medan en dirigerade. Efter en stund förstod jag att det var kyrkokören
            som övade inför mässan på söndag.
        </p>

        <p class="chapter-text">
            Det här gjorde mig mest förbryllad. Var det verkligen dessa män som
            hade begått sådana fruktansvärda grymheter?
        </p>

        <h2 class="chapter-heading">Vägen till den mörka sidan</h2>

        <p class="chapter-text">
            En rwandisk man som hade deltagit i dödandet, men som efteråt kände djup
            ånger, berättade i en tidningsintervju: "Man fick beröm och blev
            respekterad om man dödat tutsier. Man var stolt. Vi var alla
            hjärntvättade, och trodde att om inte vi dödade tutsierna skulle de
            döda oss."<x-footnote-trigger
                label="1"
                text="Ur artikeln Hon fick två svenskar dömda för folkmord av Gunilla von Hall i Svenska Dagbladet." />
        </p>

        <p class="chapter-text">
            Smicker och rädsla, med andra ord. Utan inre försvar mot giftiga
            passioner börjar något ge vika. Integriteten spricker – och själen
            blir till salu. Sluga demagoger och agitatorer utnyttjar tillfället
            för att manipulera och kontrollera. De har ingen användning för
            egenskaper som medkänsla och gott omdöme.
        </p>

        <x-content-image
            src="/images/chapters/chapter-1/kompass2_sve.png"
            alt="Kompass som pekar på rädsla och smicker, snarare än medkänsla och klokhet."
            caption="Rädsla och smicker kan störa den inre kompassen och leda oss i fel riktning."
            width="30" />

        <p class="chapter-text">
            Jag kan bara spekulera om vad fångarna tänkte och trodde, men jag
            misstänker att de aldrig hade fått lära sig att detta är "vägen till
            den mörka sidan". Rädsla, vrede, hat, lidande – vid någon punkt måste
            man kunna bryta den onda kedjan. Är det inte sådana här saker som
            kyrkorna borde lära unga människor?
        </p>

        <p class="chapter-text">
            Besöket i fängelset gjorde mig förvånad. Hur kunde så till synes
            trevliga och vänliga människor bli så grymma och brutala i vissa
            situationer? Var detta en samling extremt sjuka individer? Eller var
            de människor som inte skiljer sig så mycket från oss?
        </p>

        <p class="chapter-text">
            Jag tror att de är mer lika oss än vi vill erkänna. Problemet med
            rädsla, vrede och hat berör även oss. Vi behöver alla utveckla ett
            inre försvar mot den "mörka sidan". Vem är helt immun mot ondskans
            stora drivkraft – den berusande maktkänslan? Finns det någon som har
            en inre kompass som fungerar perfekt?
        </p>

        <p class="chapter-text">
            En felinställd kompass kan skapa ett helvete på jorden och leda till
            ett andligt fängelse. Vi behöver vägledas mer av vishet och medkänsla.
            Inte bara kroppen utan också själen behöver medicin och motion. Alla
            behöver bygga upp en inre hälsa och motståndskraft.
        </p>

        <h2 class="chapter-heading">Vad gör oss mänskliga?</h2>

        <x-content-image
            src="/images/chapters/chapter-1/prst_hund.png"
            alt="En man matar en hund."
            align="right"
            width="30"
        />

        <p class="chapter-text">
            Det finns en grundläggande skillnad mellan att dressera ett djur –
            som en hund – och att fostra en människa. En hund kan vara ostyrig
            till en början, men med belöningar och straff kan den formas till att
            bete sig väl. Den lär sig att vifta på svansen åt välbekanta ansikten
            och att skälla på främlingar.
        </p>

        <p class="chapter-text">
            Till skillnad från djur är människan kapabel till moralisk utveckling –
            formad av förnuft och medkänsla snarare än av belöningar och straff.
            Integritet kan inte påtvingas utifrån; den måste växa fram inifrån.
        </p>

        <p class="chapter-text">
            Men vad händer om vi uppfostrar ett barn som om det vore en hund? I
            bästa fall blir det väluppfostrat – men utan en äkta känsla för rätt
            och fel. Det kan lära sig att "skälla" på främlingar enbart för att de
            är annorlunda. Det kommer att sakna en inre moralkompass.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="en" :single="true" />
        </div>

        <h2 class="chapter-heading">Gott och ont</h2>

        <p class="chapter-text">
            Är kampen mellan gott och ont en yttre eller inre konflikt? Den
            skrämmande verkligheten är att karismatiska psykopater kan bli ledare
            för nationer. Dessa individer tror att makt är rätt och de kan förföra
            miljontals människor till att blint följa dem. Hitler är ett typexempel.
            När detta händer finns det en extern konflikt. Då måste vi göra
            motstånd med fasthet, beslutsamhet och oräddhet.
        </p>

        <p class="chapter-text">
            Men när vi ser dramat i världen enbart som en kamp mellan "vi" och
            "dem" – vi som är goda mot dem som är onda – då går vi en farlig väg.
            När vi tycker att vi är moraliskt överlägsna andra människor, anser vi
            att vi har rätt att förödmjuka och trycka ned dem. Om vi kallar andra
            för "monster" riskerar vi att själva bli "monster". Vi kan bli så
            blinda att vi inte ser självmotsägelsen. Det är då vi förlorar vår
            moraliska kompass.
        </p>

        <p class="chapter-text">
            Kampen mellan gott och ont är inte bara något som sker där ute, i
            världen eller mellan nationer. Det är något som utspelar sig inom var
            och en av oss.
        </p>

        <x-quotecard
            id="chapter-1"
            text="Kampen mellan ont och gott utspelar sig inte bara mellan nationer och ideologier.
Den är också ett drama&nbsp;inom&nbsp;oss.
Att kalla andra monster är det första steget mot att själv&nbsp;bli&nbsp;ett."
            align="center"
            lang="sv"
        />

        <p class="chapter-text">
            De gamla grekiska tänkarna uppmanade till självreflektion. "Känn dig
            själv", sade de. Sokrates ansåg att ett liv utan självreflektion –
            ett "oreflekterat liv" – är utan mening. Detta är avgörande för att
            vi ska kunna växa och utvecklas som människor.
        </p>

        <p class="chapter-text">
            Många kyrkor ägnar en del av mässan åt självbesinning och bekännelse.
            De menar att den gudomliga kärleken befriar oss från rädsla och minskar
            behovet av falska försvar och ursäkter. Det gör det lättare att erkänna
            och hantera våra egna mörka sidor. Självinsikt är nyckeln till att
            undvika moralisk blindhet.
        </p>

        <p class="chapter-text">
            Dessa två traditioner brukar symboliseras med "Aten" och "Jerusalem".
            Aten står för filosofi, förnuft, bildning och forskning. Jerusalem
            representerar tro, andlighet, gudomlighet och hopp. Detta är den goda
            alliansen som vi behöver återupptäcka och återuppliva.
        </p>

        <x-food-for-thought :number="1" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
