@php
    $chapterKey = 'chapter-6';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Antikens tänkare visste detta: Demokratier kan lätt kapas av tyranniska
            demagoger, som förför människor med lögner och illusioner. Det finns en
            väg ut ur den mörka grottan.
        </p>

        <h2 class="chapter-heading">Ditt bibliotek är ditt paradis</h2>

        <p class="chapter-text">
            Renässanshumanisten Erasmus av Rotterdam var en förespråkare för klassisk
            bildning. Han förstod att människan är full av brister, men han hade hopp
            om att hon kan förbättras. Hon kan bli Guds medskapare genom nåden. Han
            hyllade medkänsla, ödmjukhet och måttfullhet. "Ditt bibliotek är ditt
            paradis", sade han.
        </p>

        <p class="chapter-text">
            Martin Luthers vän och kollega Philipp Melanchthon var inne på samma
            linje. Även han insåg vikten av bildning. Melanchthon kombinerade
            reformationens principer med det klassiska arvet från antikens Grekland
            och Rom. Detta lade grunden till en rik intellektuell tradition.
        </p>

        <p class="chapter-text">
            Tyvärr verkar många lutheraner i dag ha försummat detta. Nu är det dags
            att återupptäcka och återuppliva vårt bildningsarv!
        </p>

        <x-content-image
            src="/images/chapters/chapter-6/TreReformatorer.png"
            alt="Luther, Melanchthon, Erasmus"
            caption="Luther råkade i gräl med Erasmus, som han tyckte hade en alltför optimistisk människosyn. Melanchthon var vän med båda."
            width="70" />

        <h2 class="chapter-heading">En dyrbar skatt som inte får förloras</h2>

        <p class="chapter-text">
            En lämplig startpunkt är de gamla grekerna. Det finns somliga som
            avvisar den antika grekiska demokratin eftersom den exkluderade kvinnor
            och slavar. Visst fanns det under antiken ett inte så litet mått av
            elitism, sexism, rasism och fascism. Varken Bibelns människor eller de
            klassiska filosoferna var fria från sådant.
        </p>

        <p class="chapter-text">
            Men den mörka bakgrunden behöver inte avskräcka oss, snarare tvärtom.
            Det är själva frigörelsen från maktfilosofierna som är det viktiga. Både
            framgångar och misslyckanden kan vara relevanta för oss.
        </p>

        <p class="chapter-text">
            Eftersom dessa människor levde i en helt annan kultur kan vi försöka se
            "likheter mellan olika ting och olikheter mellan likartade ting". På så
            vis kan vi söka efter de principer som utgör grunden för konsten att
            vara människa.
        </p>

        <x-content-image
            src="/images/chapters/chapter-6/athens_edited1.JPG"
            alt="Skolan i Aten, av Rafael"
            caption="Studiecirkeln i Aten."
            width="90" />

        <p class="chapter-text">
            Mänsklighetens samlade erfarenhet är en dyrköpt skatt, och att låta den
            falla i glömska är inte speciellt progressivt. För att avancera framåt
            behöver vi lära av historien. Att vara okunnig om vad som hände innan
            man föddes är att alltid förbli ett barn, sade Cicero.
        </p>

        <h2 class="chapter-heading">En revolutionerande idé: Jakten på det bästa</h2>

        <p class="chapter-text">
            Det fanns en vändpunkt i den grekiska historien – kanske någon gång
            omkring 600–500 f.Kr. – då grekerna slutade fråga: "Vad behagar
            härskaren?" och i stället började fråga: "Vad är bäst – och varför?"
        </p>

        <p class="chapter-text">
            De rörde sig bort från en lydnadens värld, där undersåtar främst fanns
            till för att tjäna kungen, och där den högsta "dygden" var underkastelse.
            Detta var födelsen av ett samhälle där människor förväntades tänka – att
            argumentera, överlägga, söka sanningen. Inte bara att lyda eller behaga,
            utan att våga fråga vad som är bäst. I stället för att stå tyst inför
            en tron reste sig medborgaren på torget och talade.
        </p>

        <p class="chapter-text">
            När människor väl börjar fråga "vad är bäst?" öppnar sig en ny värld.
            Den blir en grogrund för stora kulturella prestationer: filosofi, drama,
            politiskt tänkande, konst och arkitektur, vetenskap och matematik.
        </p>

        <p class="chapter-text">
            Denna förskjutning förändrade allt, och den är fortfarande relevant i
            dag. Det var en sådan frihet grekerna var beredda att försvara med sina
            liv. I vår egen tid kan vi behöva försvara den igen, när ledare allt
            oftare vill att medborgare ska behaga dem snarare än ifrågasätta dem.
            De bygger hov av fruktan och smicker, och därigenom kväver de strävan
            efter det bästa.
        </p>

        <p class="chapter-text">
            Grekerna lade visserligen stor energi på att blidka gudarna (minns
            Eutyfron i ett tidigare kapitel), så de var inte helt fria. Men även
            med den begränsningen var det en enastående prestation av mänsklig
            skaparkraft.
        </p>

        <p class="chapter-text">
            Naturligtvis var det aldrig självklart vad "det bästa" egentligen var,
            eller vem som skulle få avgöra det. Det var just de frågorna grekerna
            brottades med. Att förstå deras kamp gör oss bättre rustade att försvara
            friheten – som aldrig får tas för given.
        </p>

        <h2 class="chapter-heading">Sökandet efter den bästa styrelseformen</h2>

        <p class="chapter-text">
            Det är ganska imponerande att antikens Aten hade ett styrelseskick som
            var så pass inkluderande som det faktiskt var. De utvecklade en demokrati
            som inte gav något inflytande till byråkrater och proffspolitiker. De
            förlitade sig hellre på medborgarnas engagemang och förmåga att använda
            sitt sunda förnuft.
        </p>

        <p class="chapter-text">
            Aten låg i konflikt med Sparta, som bedrev ett slaveri som var
            mångdubbelt mer brutalt. De kunde inte fatta varför Aten gav makten till
            den obildade folkhopen. Deras styrelseskick var i stället oligarki,
            fåmannavälde.
        </p>

        <p class="chapter-text">
            Spartanerna dyrkade guden Phobos (fruktan) eftersom han hade förmågan
            att skapa disciplin och likformighet. Deras samhälle präglades av extrem
            kollektivism och deras kultur var – spartansk. Atenarna hade också sina
            galenskaper, men de hade en rik och blomstrande kultur.
        </p>

        <p class="chapter-text">
            Aten och Sparta representerade två motsatta politiska ideal och kämpade
            om inflytande bland de grekiska stadsstaterna. Dessa två idéer ligger
            fortfarande på många sätt i strid med varandra.
        </p>

        <p class="chapter-text">
            Den ena idén säger att alla medborgare i princip är jämlikar och att
            alla skall få vara med och bestämma om samhällets angelägenheter. Var
            och en har nämligen ett sunt förnuft, och om de inte har det, kan
            engagemang och jämlik dialog göra att de utvecklar det med tiden. Om
            folk behandlas som vuxna och ansvariga, är det möjligt och troligt att
            de också blir det.
        </p>

        <p class="chapter-text">
            Den andra idén säger att människor inte alls är jämlikar. Mänskligheten
            kan nämligen delas in i "de smarta och upplysta" och "de dumma och
            oupplysta". För att skapa ett gott samhälle, måste de förra ha makten
            över de senare.
        </p>

        <p class="chapter-text">
            Platon bodde i Aten men han följde den andra linjen. Han ville införa
            aristokrati – "de bästas välde", ett styre av en ädel och kultiverad
            elit. Han var ytterst kritisk till demokratin, som han menade ger fritt
            utlopp för passioner och oförnuft. Förr eller senare kommer den att
            urarta i tyranni, hävdade han. Vår demokratis stora utmaning är att
            visa att Platon hade fel på den punkten.
        </p>

        <x-content-image
            src="/images/chapters/chapter-6/Cicero.JPG"
            alt="Cicero"
            align="right"
            width="15" />

        <p class="chapter-text">
            Vi bör dock komma ihåg att det vi idag kallar för demokrati är mer ett
            arv från antikens Rom än från Aten. Cicero levde i den romerska
            republiken som hade en sorts blandad styrelseform: monarki, aristokrati
            och demokrati. Ett styre av en ledare kan skapa handlingskraft. Ett
            styre av de klokaste kan ge expertkunskap. Ett styre av vanligt folk kan
            främja sunt förnuft. Cicero menade att en väl designad konstitution tar
            det bästa från varje.<x-footnote-trigger
                label="1"
                text="Se On Politics, Alan Ryan, 4. Roman Insights: Polybius and Cicero." />
        </p>

        <h2 class="chapter-heading">Vi kan lära av Platon</h2>

        <p class="chapter-text">
            I ett kapitel i essäboken Navigation i mångfalden berättar jag om mitt
            arbete med vattenförsörjning i inbördeskrigets Nepal, under maoisternas
            uppror. Där argumenterar jag för Karl Poppers idé om det öppna
            samhället. Popper är känd för sin hårda kritik mot Platon. Alltför hård,
            enligt min mening. Även vi som tror på demokrati kan lära av Platons
            idéer.
        </p>

        <p class="chapter-text">
            Platons skepticism mot demokratin kan vara svårt att ta till sig. Det
            blir dock mer begripligt när vi inser att han främst kritiserade det vi
            kallar för populism. I dag är vi smärtsamt medvetna om hur lätt
            demokratier kan falla in i ett mörker. Populism kan skapa en maktkult
            som leder till inkompetent ledarskap, auktoritärt styre och tyranni.
        </p>

        <p class="chapter-text">
            Vi kan också relatera till Platons kända liknelse om grottan. Vi
            bombarderas ständigt med osäker information från alla håll och kanter.
            Det är svårt att skilja fakta från fiktion. Falska nyheter sprids snabbt
            och många fastnar i en förvrängd bild av världen. Det känns som om vi
            lever i en skuggvärld där vi förväxlar illusioner med verklighet. Vi
            längtar efter äkta kunskap och en sann förståelse av världen.
        </p>

        <div class="flex justify-center m-12">
            <x-buy-book lang="sv" :single="true" />
        </div>

        <h2 class="chapter-heading">Illusionen om frihet i skugglandet</h2>

        <p class="chapter-text"><strong>Är detta frihet?</strong></p>

        <ul>
            <li>Att säga vad som faller en in utan hämningar.</li>
            <li>Att följa sina impulser och göra vad man vill.</li>
            <li>Att ge fritt utlopp för sitt uppblåsta ego.</li>
            <li>Att ge fria tyglar till sin inre tyrann.</li>
        </ul>

        <p class="chapter-text">
            Handlar inte sann frihet om att frigöra sig från sådana snäva och
            självcentrerade horisonter? Filosofen och folkbildaren Alf Ahlberg
            ansåg att en fungerande demokrati förutsätter att vi utvecklar förmågan
            att tänka fritt. Problemet handlar inte om brist på yttrandefrihet utan
            snarare om vår benägenhet att förslava oss själva.
        </p>

        <p class="chapter-text">
            I boken Tankelivets frigörelse beskrev Ahlberg hur vi människor är
            mästare på att övertyga oss själva om att vi är förnuftigare än vi
            egentligen är. Vi försvarar våra åsikter med skäl som gör sken av att
            vara logiska, men som i själva verket grundas på önskningar, sympatier
            och antipatier. Vi ser fakta som smickrar och behagar oss och blundar
            för det som förödmjukar och förargar oss. Vi faller lätt offer för
            sociala fördomar och vidskepelser. Han skrev:
        </p>

        <blockquote class="chapter-blockquote">
            Att tänka fritt betyder inte att blint följa alla dessa tankebanor, som
            våra böjelser och intressen, vår egenkärlek och vårt infantila
            storhetsvanvett stakar ut. Att bli en andligen fri människa är just att
            bli fri från denna begränsning av horisonten.
        </blockquote>

        <p class="chapter-text">
            I vår narcissistiska kultur är fritt tänkande liktydigt med att följa
            vad man innerst inne känner. Frihet att blåsa upp sitt ego och ge det
            fritt utlopp. Ens eget tyckande blir något heligt som inte får kränkas.
            Sant är det som känns rätt. Gott är det som känns behagligt.
        </p>

        <p class="chapter-text">
            Sokrates hävdade bestämt att det inte alls är samma sak. En sådan
            subjektivism gör att man blir ett enkelt byte för dem som är skickliga
            på att manipulera känslorna.<x-footnote-trigger
                label="2"
                text="Se t.ex. Sokrates diskussion med Polos och Kallikles i Platons dialog Gorgias." />
        </p>

        <p class="chapter-text">
            Ahlberg menade att fascism och andra totalitära ideologier baseras på
            primitiv subjektivism. Kollektiva känslor av smicker, hat och hämnd tros
            vara goda eftersom de känns behagliga.
        </p>

        <x-quotecard
            id="chapter-6"
            header="Vad är frihet?"
            text="Sann frihet är inte att säga vad som faller&nbsp;en&nbsp;in.
Sann frihet är att befrias från egots snäva&nbsp;horisonter."
            align="center"
            lang="sv"
        />

        <h2 class="chapter-heading">Vägen ut ur skuggvärlden</h2>

        <p class="chapter-text">
            Här kan Platon vara en vän i nöden. I dialogen Staten lade han visserligen
            fram en del odemokratiska och smått absurda idéer. För hans samtida i
            Aten var det chockerande att han använde Spartas kollektivism som modell.
            Hans elev Aristoteles tyckte att han gick på tok för långt.
        </p>

        <p class="chapter-text">
            Samtidigt finns en del i Staten som är förvånansvärt progressivt.
            Sokrates målade upp ett idealsamhälle där bildade och ädla ledare styr.
            Platons egen bror Glaukon lyssnade och var djupt imponerad:
        </p>

        <blockquote class="chapter-blockquote">
            – Vilka underbara gestalter du har skapat i dessa styrande män, Sokrates!
            sade han. Som en riktig bildhuggare! – Styrande kvinnor också, Glaukon!
            svarade jag. Du ska inte tro att det som jag har sagt gäller män mer
            än kvinnor …<x-footnote-trigger
                label="3"
                text="Platon, Staten 540c, Jan Stolpes översättning." />
        </blockquote>

        <p class="chapter-text">
            Kloka kvinnor måste utbildas så att de skall kunna styra samhället som
            filosof-drottningar, menade Platon. I Aten 400 f.Kr. var detta en
            revolutionerande idé.
        </p>

        <p class="chapter-text">
            I Staten finns både bra och dåliga politiska idéer. Men vad som framför
            allt kan vara relevant för oss idag är inte dess politik utan dess
            psykologi och dygdetik.
        </p>

        <p class="chapter-text">
            Platon delade in själen i tre delar. Den första är förnuftet och den
            andra är begären och drifterna. Den tredje kan beskrivas med ord som
            kampvilja, ambition, passion och handlingskraft.
        </p>

        <p class="chapter-text">
            Kaos uppstår när till exempel begären börjar styra över förnuftet. Eller
            när handlingskraft blir en ohämmad vilja till makt. Det får inte råda
            ett inre inbördeskrig mellan de tre delarna, menade Platon. Han skrev:
        </p>

        <blockquote class="chapter-blockquote">
            I stället ska den enskilde skapa verklig ordning i sitt eget hus, bli
            sin egen styresman, ordningsvakt och vän och stämma samman de tre delarna
            precis som tre toner i en skala … och själv träda fram ur mångfalden
            som en fullständig enhet, besinningsfull och väl sammanfogad, och i det
            skicket kan han skrida till handling …<x-footnote-trigger
                label="4"
                text="Platon, Staten 443d, Jan Stolpes översättning." />
        </blockquote>

        <p class="chapter-text">
            Inre hälsa är att skapa inre harmoni. Själens tre delar (förnuft, vilja
            och begär) behöver samordnas, så att var och en får sin rätta plats och
            funktion, ansåg Platon.
        </p>

        <p class="chapter-text">
            En oordnad själ är bunden av sina begär. Den är fixerad vid oreflekterat
            "tyckande" och dåligt grundade åsikter. Det är som att vara fastkedjad
            i en dunkel grotta och förvillas av skuggor och illusioner. "Det godas
            idé" är som solen som får allting att framstå i sin rätta belysning.
        </p>

        <p class="chapter-text">
            Vägen ut ur grottan är bildning och dygd, menade Platon. Han reflekterade
            kring det som senare skulle kallas för de fyra kardinaldygderna. Idag
            skulle vi kunna tolka dem ungefär så här:
        </p>

        <ul>
            <li>Klokhet, t.ex. att veta vad man inte vet.</li>
            <li>Rättrådighet, t.ex. att skilja mellan sak och person.</li>
            <li>Måttfullhet, t.ex. att inte gå till ytterligheter.</li>
            <li>Mod, t.ex. att inte låta rädslan styra över förnuftet.</li>
        </ul>

        <p class="chapter-text">
            Platon såg dessa dygder som skydd mot inre kaos och politiskt förfall.
            Hans varning gäller fortfarande: Om medborgare förlorar förmågan till
            självstyre kommer de snart att söka någon annan som kan styra dem.
        </p>

        <p class="chapter-text">
            Med detta sagt behöver vi inte följa hans dröm om ett perfekt, rationellt
            system som drivs av hängivna experter. Drömmen lever kvar – många har
            försökt förverkliga den, med varierande framgång – men den har en
            allvarlig brist: den undertrycker mänskliga passioner och förlamar
            därmed människorna.
        </p>

        <p class="chapter-text">
            Då är det bättre att omfamna demokratin som det röriga, ofullkomliga
            spel den är – ett spel som fungerar förvånansvärt bra, förutsatt att
            folk respekterar spelreglerna.
        </p>

        <p class="chapter-text">
            I dag utmanas demokratin och rättsstaten av den äldsta frestelsen av
            alla – den som Platon redan såg förtära Aten: den starkares rätt.
        </p>

        <p class="chapter-text">
            De antika grekiska stadsstaterna är sedan länge borta, men deras historia
            talar tydligare än någonsin. Deras värld är sedan länge borta, men
            aptiten på makt och kampen för rättvisa är lika levande i dag som då.
        </p>

        <x-food-for-thought :number="6" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
