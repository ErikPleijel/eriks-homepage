<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adds a two-letter ISO country code (e.g. 'SE', 'US') resolved at
     * write-time from the visitor's IP via the MaxMind GeoLite2-Country
     * offline database.
     *
     * GDPR note: only the resolved country code is stored — the IP address
     * itself is never persisted. A country code alone cannot identify an
     * individual, so this column does not change the site_events table's
     * GDPR-safe posture (no consent banner required). See DECISIONS.md
     * §"Cookie-free visit & click logging".
     */
    public function up(): void
    {
        Schema::table('site_events', function (Blueprint $table) {
            $table->string('country_code', 2)->nullable()->after('locale');
            $table->index('country_code');
        });
    }

    public function down(): void
    {
        Schema::table('site_events', function (Blueprint $table) {
            $table->dropIndex(['country_code']);
            $table->dropColumn('country_code');
        });
    }
};
