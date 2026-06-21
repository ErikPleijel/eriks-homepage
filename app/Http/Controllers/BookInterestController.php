<?php

namespace App\Http\Controllers;

use App\Models\BookInterestSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Printed-book interest sign-ups, ported from the old one.com PHP form
 * (tsv/register_interest.php). Anti-spam measures carried over:
 *
 *  - Honeypot "website" field: if filled, exit silently (no insert, no error,
 *    no message) so bots aren't told the trap exists.
 *  - Minimum-time check: the form-load time is stored in the session when the
 *    form renders (not a tamperable hidden field); a submission under 3s after
 *    load is treated as a bot and rejected with a generic error.
 *  - Rate limiting lives on the route (throttle:5,10), replacing the old
 *    hand-rolled SQL COUNT() query.
 */
class BookInterestController extends Controller
{
    /** Session key holding the timestamp the form was last rendered. */
    public const FORM_TIME_KEY = 'book_interest_form_loaded_at';

    /** Minimum seconds that must elapse between form render and submit. */
    private const MIN_SECONDS = 3;

    public function store(Request $request): RedirectResponse
    {
        // Honeypot — real visitors never see this field, so any value means a
        // bot. Match the original's silent exit: do nothing, reveal nothing.
        if (filled($request->input('website'))) {
            return back();
        }

        // Minimum-time check. The load time is server-side (session), so it
        // can't be forged by replaying a hidden field.
        $loadedAt = $request->session()->pull(self::FORM_TIME_KEY);

        if (! $loadedAt || (now()->timestamp - (int) $loadedAt) < self::MIN_SECONDS) {
            return back()->with('book_interest_status', 'error');
        }

        $messages = match (app()->getLocale()) {
            'sv' => ['consent.accepted' => 'Du behöver godkänna villkoren för att skicka in formuläret.'],
            default => [],
        };

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'book_code' => ['required', 'string', Rule::in($this->allowedBookCodes())],
            'consent' => ['accepted'],
        ], $messages);

        // A repeat sign-up for the same edition isn't an error — tell the
        // visitor they're already on the list instead.
        $exists = BookInterestSubscriber::where('email', $validated['email'])
            ->where('book_code', $validated['book_code'])
            ->exists();

        if ($exists) {
            return back()->with('book_interest_status', 'already');
        }

        try {
            BookInterestSubscriber::create([
                'name' => $validated['name'] ?? null,
                'email' => $validated['email'],
                'book_code' => $validated['book_code'],
                'consent_ip' => $request->ip(),
                'consent_user_agent' => $request->userAgent(),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // 23000 = unique violation: a race between the check above and the
            // insert. Treat it as "already on the list", same as the old form.
            if ($e->getCode() === '23000') {
                return back()->with('book_interest_status', 'already');
            }

            return back()->with('book_interest_status', 'error');
        }

        return back()->with('book_interest_status', 'success');
    }

    /**
     * Valid book_code values: the book slug joined to each configured locale.
     * The form submits one as a hidden field; validating against this set stops
     * a tampered/garbage code from being stored.
     *
     * @return list<string>
     */
    private function allowedBookCodes(): array
    {
        $slug = config('site.book_slug');

        return array_map(
            fn (string $locale) => "{$slug}-{$locale}",
            array_keys(config('site.locales')),
        );
    }
}
