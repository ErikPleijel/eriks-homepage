@php
    use App\Http\Controllers\BookInterestController;

    // Stamp the form-load time into the session so the controller's minimum-time
    // anti-bot check has a server-side reference it can't be tricked on.
    session([BookInterestController::FORM_TIME_KEY => now()->timestamp]);

    $locale = app()->getLocale();
    $bookCode = config('site.book_slug').'-'.$locale;
    $contact = config('site.contact_email');
    $status = session('book_interest_status');

    // Per-locale copy. Swedish is the original wording from the one.com form;
    // English is the adapted equivalent. See DECISIONS.md.
    $t = $locale === 'sv'
        ? [
            'heading' => 'Håll dig uppdaterad om den tryckta utgåvan',
            'intro' => 'Fyll i din e-postadress (och gärna ditt namn) om du vill få ett meddelande när boken finns att köpa i tryckt form.',
            'name' => 'Namn (valfritt)',
            'email' => 'E-postadress',
            'hp' => 'Lämna detta fält tomt',
            'gdpr_heading' => 'Hur jag använder dina uppgifter (GDPR)',
            'gdpr' => [
                'Jag samlar in din e-postadress (och eventuellt ditt namn) för att kunna skicka ett eller några få mejl när boken finns att köpa i tryckt form eller om det sker något viktigt kring utgivningen.',
                'Dina uppgifter lagras i en lösenordsskyddad databas hos min webbhotellsleverantör. Uppgifterna säljs inte vidare och delas inte med någon annan än utgivaren i syfte att skicka information om boken.',
            ],
            'consent_label' => 'Jag samtycker till att mina personuppgifter lagras och används enligt ovan för att skicka information om den tryckta boken.',
            'submit' => 'Skicka',
            'msg_success' => 'Tack! Din e-postadress är nu registrerad. Du kommer att få ett mejl när den tryckta boken finns att köpa.',
            'msg_already' => 'Din e-postadress finns redan på listan. Du kommer att få information när den tryckta boken finns att köpa.',
            'msg_error' => 'Ett tekniskt fel uppstod. Försök igen om några sekunder.',
        ]
        : [
            'heading' => 'Stay updated about the printed edition',
            'intro' => 'Enter your email (and your name if you like) to be notified when the book is available in print.',
            'name' => 'Name (optional)',
            'email' => 'Email address',
            'hp' => 'Leave this field empty',
            'gdpr_heading' => 'How I use your information (GDPR)',
            'gdpr' => [
                "I'm collecting your email address (and optionally your name) so I can send you one or a few emails when the printed book becomes available, or if something important happens regarding its publication.",
                "Your information is stored in a password-protected database with my hosting provider. It isn't sold or shared with anyone other than the publisher, for the purpose of sending you information about the book.",
            ],
            'consent_label' => 'I consent to my personal data being stored and used as described above to send me information about the printed book.',
            'submit' => 'Sign up',
            'msg_success' => "Thanks! Your email address is now registered. You'll get an email when the printed book is available to buy.",
            'msg_already' => "Your email address is already on the list. You'll get information when the printed book is available to buy.",
            'msg_error' => 'Something went wrong. Please try again in a few seconds.',
        ];

    // The "ask to be removed" line carries the contact email, so it's built
    // separately rather than baked into the static array above.
    $gdprContact = $locale === 'sv'
        ? 'Du kan när som helst begära att bli borttagen genom att kontakta mig på '
        : 'You can ask to be removed at any time by contacting ';
@endphp

<section {{ $attributes->merge(['class' => 'mt-12 rounded-lg border border-stone-200 bg-white p-8']) }}>
    <h2 class="text-2xl font-bold">{{ $t['heading'] }}</h2>
    <p class="mt-2 text-stone-600">{{ $t['intro'] }}</p>

    {{-- Flash result of the last submission. --}}
    @if ($status === 'success')
        <div class="mt-5 rounded-md border border-green-200 bg-green-50 p-4 text-green-800">
            {{ $t['msg_success'] }}
        </div>
    @elseif ($status === 'already')
        <div class="mt-5 rounded-md border border-green-200 bg-green-50 p-4 text-green-800">
            {{ $t['msg_already'] }}
        </div>
    @elseif ($status === 'error')
        <div class="mt-5 rounded-md border border-red-200 bg-red-50 p-4 text-red-800">
            {{ $t['msg_error'] }}
        </div>
    @endif

    {{-- Validation errors (invalid email / missing consent). --}}
    @if ($errors->any())
        <div class="mt-5 rounded-md border border-red-200 bg-red-50 p-4 text-red-800">
            <ul class="list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('book-interest.store') }}" novalidate class="mt-6">
        @csrf

        {{-- Honeypot: hidden from people (display:none), so any value = bot.
             Not an accessibility concern — it's an anti-bot trap. --}}
        <div style="display:none;" aria-hidden="true">
            <label for="bi-website">{{ $t['hp'] }}</label>
            <input type="text" id="bi-website" name="website" tabindex="-1" autocomplete="off">
        </div>

        {{-- Locale-derived book edition this sign-up is for. --}}
        <input type="hidden" name="book_code" value="{{ $bookCode }}">

        <label for="bi-name" class="block text-sm font-semibold text-stone-700">
            {{ $t['name'] }}
        </label>
        <input type="text" id="bi-name" name="name" value="{{ old('name') }}"
               class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:ring-amber-500">

        <label for="bi-email" class="mt-4 block text-sm font-semibold text-stone-700">
            {{ $t['email'] }}
        </label>
        <input type="email" id="bi-email" name="email" required value="{{ old('email') }}"
               class="mt-1 w-full rounded-md border border-stone-300 px-3 py-2 focus:border-amber-500 focus:ring-amber-500">

        <div class="mt-5 rounded-md bg-stone-50 p-4 text-sm text-stone-600">
            <p class="font-semibold text-stone-700">{{ $t['gdpr_heading'] }}</p>
            @foreach ($t['gdpr'] as $paragraph)
                <p class="mt-2">{{ $paragraph }}</p>
            @endforeach
            <p class="mt-2">
                {{ $gdprContact }}<a href="mailto:{{ $contact }}" class="font-medium text-amber-700 underline">{{ $contact }}</a>.
            </p>

            <label class="mt-4 flex items-start gap-2 font-normal text-stone-700">
                <input type="checkbox" name="consent" value="1" required
                       class="mt-1 rounded border-stone-300 text-amber-600 focus:ring-amber-500">
                <span>{{ $t['consent_label'] }}</span>
            </label>
        </div>

        <button type="submit"
                class="mt-5 inline-block rounded-md bg-amber-500 px-6 py-3 font-semibold text-stone-900 hover:bg-amber-400">
            {{ $t['submit'] }}
        </button>
    </form>
</section>
