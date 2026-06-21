<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A single cookie-free analytics event — a pageview or a click.
 *
 * Stores only what's needed to count traffic in aggregate: never an IP, a
 * user-agent, or any cross-session identifier. See DECISIONS.md.
 */
class SiteEvent extends Model
{
    /** Events are write-once; there is no updated_at column. */
    const UPDATED_AT = null;

    protected $fillable = [
        'event_type',
        'path',
        'locale',
        'country_code',
        'referrer_host',
        'label',
    ];
}
