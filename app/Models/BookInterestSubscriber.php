<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A visitor who asked to be told when the printed book is available.
 *
 * consent_ip / consent_user_agent are stored deliberately as a record that
 * consent was given (and from where) — GDPR consent documentation, distinct
 * from the anonymous, no-IP policy on SiteEvent. See DECISIONS.md.
 */
class BookInterestSubscriber extends Model
{
    /** Write-once; there is no updated_at column. */
    const UPDATED_AT = null;

    protected $table = 'book_interest_subscribers';

    protected $fillable = [
        'name',
        'email',
        'book_code',
        'consent_ip',
        'consent_user_agent',
    ];
}
