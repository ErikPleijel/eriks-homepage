@php
    $chapterKey = 'chapter-7';
    $chMeta     = \App\Support\ChapterData::forView($chapterKey, app()->getLocale());
    $alternates = \App\Support\ChapterData::alternates($chapterKey);
@endphp
<x-layout :title="$chMeta['layout_title']" :alternates="$alternates">
    <article class="prose-stone max-w-none">
        <x-chapter-header :meta="$chMeta" />

        <p class="chapter-lead">
            Auktoritära ledare vinner popularitet genom att framstå som starka och
            tuffa. Den gamla stoiska filosofin avslöjar dock att de i grunden är
            svaga och bräckliga.
        </p>

        <h2 class="chapter-heading">Väst måste återfinna sin kompass</h2>

        <p class="chapter-text">
            Grekernas idéer fördes vidare till romarna, som utvecklade en
            livsfilosofi som heter stoicism. Den är relevant för den som vill vara
            förankrad i verkligheten och arbeta för det gemensamma goda. Stoikernas
            filosofi innehåller en del som hör till en föråldrad världsbild, men
            också sådant som är tidlöst.
        </p>

        <p class="chapter-text">
            På flera sätt är den inbyggd i kristendomen. Många av de kristna
            kyrkofäderna, och förmodligen också Paulus, var påverkade av stoikerna.
            Luther, Melanchthon och Erasmus hade en sak gemensamt: Alla tre gillade
            Ciceros skrifter, som innehåller många stoiska idéer.
        </p>

        <x-content-image
            src="/images/chapters/chapter-7/streckg_swe.png"
            alt="Aten och Jerusalem: Judendom, Kristendom, grekisk filosofi, stoicism, medeltiden, reformationen, renässansen, upplysningen."
            align="right"
            width="25" />

        <p class="chapter-text">
            Alf Ahlberg skrev: "Den humanistiska traditionen vilar framför allt på
            en sammansmältning mellan stoicism och kristendom." Han menade att den
            västerländska humanistiska traditionen har formats av en rad religioner,
            filosofier och epoker. Den utvecklades under medeltiden, renässansen,
            reformationen och upplysningen. Dess rötter i antiken är judendomen,
            kristendomen, den grekiska filosofin och stoicismen. Han skrev att detta
            är "den stora linjen i vår kultur, på vars bestånd och livskraft hela
            dess framtid beror".<x-footnote-trigger
                label="1"
                text="Ur Humanismen av Alf Ahlberg." />
        </p>

        <p class="chapter-text">
            Syntesen mellan stoicism och kristendom är ursprunget till en ovärderlig
            skatt: tron på de mänskliga rättigheterna. Den uppstod inte fix och
            färdig, utan mognade och utvecklades under historiens gång. Det skedde
            till stor del genom Cicero under antiken, och sedan genom kristna
            filosofer som till exempel Thomas av Aquino under medeltiden och Locke
            och Kant under upplysningen.
        </p>

        <p class="chapter-text">
            Det finns stunder då västvärlden helt tycks ha tappat sin moraliska
            kompass. Det är då vi behöver återknyta till våra historiska och andliga
            rötter.
        </p>

        <h2 class="chapter-heading">Modet att vara mild</h2>

        <p class="chapter-text">
            En vanlig missuppfattning är att stoicism leder till ett känslolöst och
            kallt sinnelag. Dess kärna ligger i självinsikt och självkontroll –
            vilket är anledningen till att KBT (kognitiv beteendeterapi) kan ses
            som dess moderna arvtagare. I sin ytterlighet förvandlas stoicismen till
            känslokyla, men i balans bidrar den till inre hälsa.
        </p>

        <p class="chapter-text">
            Vissa unga män idag ser sig som kulturkrigare med ett uppdrag att rädda
            den västerländska civilisationen från förfall. Ett vanligt drag är att
            de uppfattar dialog och empati som tecken på svaghet. Det ironiska är
            att det som framställs som styrka ofta bara är en förklädd skörhet.
        </p>

        <p class="chapter-text">
            Sann styrka behöver inte visa upp sin hårdhet. Stoisk disciplin handlar
            inte om att undertrycka känslorna utan om att styra dem – tänk på
            Platons bild av vagnföraren.
        </p>

        <p class="chapter-text">
            När stoicism möter kristen kärlek finner styrkan sin rätta riktning.
            Den ger mod att vara mild utan rädsla – att lyssna, att vara öppen för
            argument och att vara bestämd utan envishet. Det är verklig styrka.
        </p>

        <h2 class="chapter-heading">Övningar för själen</h2>

        <p class="chapter-text">
            Antikens stoiker hämtade inspiration från Sokrates livsfilosofi, som
            bland annat innebär att det är bättre att lida orätt än att göra orätt.
            De såg honom som en förebild för hur man lever i en stormig värld med
            ett inre lugn och utan att korrumpera sin själ.
        </p>

        <p class="chapter-text">
            Stoikerna menade att människans mest dyrbara egendom är själens
            integritet. Detta betyder att yttre saker som framgång och rikedom är
            mindre värdefulla. Det här kan jämföras med Jesu uttalande: "Vad hjälper
            det en människa om hon vinner hela världen men förlorar sin själ?"
        </p>

        <p class="chapter-text">
            Stoikern Epiktetos uppfattade Gud som en urkraft som skapar en inre
            själsstyrka. Sinnesrobönen har sin grund i hans filosofi.
        </p>

        <div class="my-8 border-l-4 border-stone-300 pl-6">
            <p class="text-center text-sm font-bold uppercase tracking-wide text-stone-500">Sinnesrobönen</p>
            <p class="chapter-blockquote mt-3 border-0 pl-0">
                Gud, ge mig sinnesro att acceptera det jag inte kan förändra, mod
                att förändra det jag kan, och förstånd att inse skillnaden.<x-footnote-trigger
                    label="2"
                    text="Sinnesrobönen formulerades av Reinhold Niebuhr 1926." />
            </p>
        </div>

        <p class="chapter-text">
            Det mesta som händer i världen ligger utanför vår kontroll, men vad vi
            kan råda över är våra reaktioner, menade Epiktetos. Det vi bestämmer
            över är våra åsikter, begär och aversioner. För en stoiker gäller det
            att behålla ett inre själslugn som är oberoende av yttre omständigheter.
            Man får inte låta sig förslavas under låga tankar.
        </p>

        <p class="chapter-text">
            "Vi har inget att frukta utom fruktan själv", sade Franklin D. Roosevelt.
            Förmågan att känna rädsla är naturligtvis helt livsnödvändig. Vi lever
            i en farlig värld och om vi inte kunde känna rädsla skulle vi försätta
            oss i riskfyllda situationer helt i onödan. Vad Roosevelt varnade för
            är en rädsla som minskar omdömesförmågan. Faror och hot måste bedömas
            med ett balanserat förstånd som varken överreagerar eller fegt blundar
            för verkligheten. Vi måste se upp så att rädsla inte skapar hjärnspöken,
            tunnelseende och blindhet.
        </p>

        <p class="chapter-text">
            Vardagslivets prövningar kan bli till övningar i att inte förlora
            jämvikten. Epiktetos gav följande råd till den som besöker ett badhus
            (i romarriket omkring 100 e.Kr.):
        </p>

        <blockquote class="chapter-blockquote">
            Om du till exempel tänker ta dig ett bad, påminn dig då i förväg hur
            det går till i ett badhus: folk stänker ner varann, knuffas, grälar och
            stjäl från varann. Du kan förverkliga din avsikt tryggare om du säger
            till dig själv: "Jag ska ta ett bad nu och samtidigt bevara min
            naturenliga jämvikt." Så ska du göra före allt du företar dig. Om
            någonting då stör dig när du badar, har du tanken aktuell att "jag
            tänkte ju inte bara bada utan samtidigt också bevara min naturgivna
            balans, och det kan jag ju inte om jag blir retad av det som nu
            sker."<x-footnote-trigger
                label="3"
                text="Epiktetos, Handbok i livets konst, punkt 4." />
        </blockquote>

        <p class="chapter-text">
            Enligt stoicismen är det viktigt att kunna tänka negativt och att
            försöka föreställa sig obehagliga överraskningar. Detta kan låta som
            pessimism, men i själva verket är det optimism. Det är som att säga
            till sig själv: "Även om jag råkar ut för svårigheter och motgångar,
            har jag en inre beredskap att hantera problemen."
        </p>

        <p class="chapter-text">
            För en stoiker är det särskilt viktigt att tänka på sin dödlighet och
            att vara tacksam för det liv man har. Genom att sätta parentes kring
            sig själv, framstår världen i ett riktigare perspektiv.
        </p>

        <p class="chapter-text">
            Det är dock viktigt att dessa stoiska övningar inte går till överdrift.
            Det får inte leda till känslokyla, likgiltighet och oförmåga att bry
            sig. Känslor av frustration och upprördhet kan vara viktiga drivfjädrar.
            Huvudsaken är att vrede inte blir ett nöje och en ohejdad vana.
        </p>


        <p></p>

        <x-quotecard-image
            src="/images/quotecard-swe-conversation-derails.jpg"
            alt="När samtalet spårar ur … Svara inte på elakhet med elakhet. Pausa. Stå emot impulsen att slå tillbaka. Ersätt reaktion med reflektion – och återvänd lugnt till sakfrågan. Ställ en klargörande fråga – utan sarkasm eller ironi. Om inget förbättras har du gjort din del – dra dig ur med värdighet. Detta är sann styrka."
            text="När samtalet spårar ur …\nSvara inte på elakhet med elakhet.\nPausa. Stå emot impulsen att slå tillbaka.\nErsätt reaktion med reflektion – och återvänd lugnt till sakfrågan.\nStäll en klargörande fråga – utan sarkasm eller ironi.\nOm inget förbättras har du gjort din del – dra dig ur med värdighet.\nDetta är sann styrka."
            lang="sv"
            id="conversation-derails"
        />

        <h2 class="chapter-heading">Makt korrumperar inte alltid</h2>

        <p class="chapter-text">
            Det brukar sägas att makt korrumperar och att absolut makt korrumperar
            absolut. Det tycks dock som att det finns ett undantag och det är
            kejsaren och stoikern Marcus Aurelius. Han hade obegränsad makt att
            göra precis som han ville, men han ansträngde sig för att motstå den
            frestelsen.
        </p>

        <p class="chapter-text">
            En stoiker sätter gränser för sig själv och sitt handlande – allt som
            kan göras bör inte göras – och har tillräcklig självdisciplin att
            respektera dessa gränser. Makt ger inte frihet från bördan att följa
            principer.
        </p>

        <p class="chapter-text">
            "Akta dig för att bli en tyrann", sade Marcus till sig själv. "Var
            alltså ärlig, god och högsinnad, älska rättvisan, var from, var
            välvillig och kärleksfull och ståndaktig i pliktuppfyllelsen."<x-footnote-trigger
                label="4"
                text="Marcus Aurelius, Självbetraktelser, Bok VI." />
        </p>

        <p class="chapter-text">
            Den som har makt över andra behöver först och främst ha självinsikt och
            självkontroll. Denna livsfilosofi är relevant för politiker, tjänstemän,
            poliser, chefer och andra personer vars plikt det är att tjäna en högre
            etik och det gemensamma bästa. Rättrådighet är att vara rättvis och
            hederlig. Orättrådighet är att vara orättvis och korrumperad.
        </p>

        <p class="chapter-text">
            Men varför vara hederlig när det är mer lönsamt att vara korrupt? Detta
            var Glaukons utmanande fråga i Staten. Sokrates svar var skarpsinnigt.
            Att ha en frisk kropp har ett värde i sig självt. På samma sätt är det
            med själen. Den orättrådiges själ är sjuk, medan den rättrådiges är
            frisk. Inre hälsa har ett egenvärde, även om det inte i alla lägen är
            "lönsamt".
        </p>

        <p class="chapter-text">
            Rättrådighet är försvaret mot idén att makt är rätt. Det finns somliga
            som säger att de kämpar för rättvisa, fastän de i själva verket är ute
            efter makt och hämnd. Detta är vad som händer när man saknar
            rättrådighet. Kampen för rättvisa är lika mycket en inre som en yttre
            kamp.
        </p>

        <p class="chapter-text">
            Vrede kan vara en drivkraft för att bekämpa orättvisor, men hur är det
            med hat? Det är viktigt att lära sig att skilja mellan dessa känslor.
            Hat kan skapa lidande för andra och det kan allvarligt skada ens eget
            intellekt. Det är klokt att göra detta till en levnadsregel: Vrede kan
            vara OK, men hat är inte OK. Det gäller att sätta upp gränser för sig
            själv och att lära sig att inte överskrida dem.
        </p>

        <x-content-image
            src="/images/chapters/chapter-7/MarcusAurelius.JPG"
            alt="Marcus Aurelius"
            caption="'Det bästa sättet att hämnas är att inte likna dem som gjort oss orätt.' Marcus Aurelius"
            width="30" />



        <h2 class="chapter-heading">Hopp när allt verkar gå fel</h2>

        <p class="chapter-text">
            Den kristna tron på ett liv efter döden är något som skapar en inre
            styrka. I stället för att vara en from världsflykt kan den bli en
            kraftkälla. Hoppet skyddar mot tomhet och cynism.
        </p>

        <p class="chapter-text">
            Det himmelska hoppet ger känslan av att ha ett hem. Detta skapar en
            naturlig stoicism som inte är krampaktig eller framtvingad. Även om allt
            går åt skogen är inte allt förlorat. Livsviljan blir en inre källa som
            är mindre beroende av omständigheter. Det himmelska hoppet kan därför
            också skapa ett jordiskt hopp. Bonhoeffer skrev:
        </p>

        <blockquote class="chapter-blockquote">
            Optimism är till sitt väsen inte en åsikt om den aktuella situationen
            utan en livskraft, en kraft att hoppas där andra resignerar, en kraft
            att hålla huvudet högt där allt ser ut att slå fel, en kraft att bära
            bakslag, en kraft som inte släpper ifrån sig framtiden till pessimisten
            utan tar den i anspråk för hoppet. Det finns visserligen också en feg
            och enfaldig optimism, som bör utmönstras. Men optimismen som vilja
            till en framtid får ingen förakta, även om den tar miste hundra gånger;
            den är livets hälsa som den sjuke inte får besmitta. Det finns folk som
            anser det för brist på allvar, kristna som räknar det för brist på
            fromhet, att hoppas på en bättre jordisk framtid och bereda sig för
            den. De tror på kaos, oordning, katastrof som skeendets mening just nu
            och undandrar sig i resignation eller from världsflykt ansvaret för
            livets fortgång, för återuppbyggandet, för det kommande släktet. Må
            vara att den yttersta dagen kommer i morgon, då skall vi gärna släppa
            arbetet för framtiden ur händerna, men inte förr.<x-footnote-trigger
                label="5"
                text="Ur Motstånd och underkastelse." />
        </blockquote>
        <x-food-for-thought :number="7" lang="sv" />

        <x-toc heading="Kapitel" />
    </article>
</x-layout>
<x-site-footer />
