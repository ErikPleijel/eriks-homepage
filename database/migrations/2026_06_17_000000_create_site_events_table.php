<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cookie-free analytics. Deliberately stores no IP, no user-agent, and no
     * cross-session identifier — see DECISIONS.md ("Cookie-free visit logging").
     * Only created_at is tracked (no updated_at); the model sets UPDATED_AT=null.
     */
    public function up(): void
    {
        Schema::create('site_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');                     // 'pageview' | 'click' (plain string — more values may be added later without a schema change)
            $table->string('path', 2048);                     // matches EventController validation max:2048
            $table->string('locale', 5)->nullable();          // 'en' | 'sv'; nullable for forward compat
            $table->string('referrer_host')->nullable();
            $table->string('label')->nullable();              // click target label; null for pageviews
            $table->timestamp('created_at')->nullable();

            // date-range queries (e.g. "traffic over the last 30 days")
            $table->index('created_at');
            // breakdown queries (e.g. "all clicks in the last 30 days")
            $table->index(['event_type', 'created_at']);
            // path index is added below, outside this closure, due to MySQL key-length limits
        });

        // varchar(2048) utf8mb4 = up to 8,192 bytes per entry — well above InnoDB's
        // 3,072-byte key prefix limit. MariaDB 10.4 silently truncates a plain index
        // to 768 chars (Sub_part=768 in SHOW INDEX); MySQL 5.7 throws an error outright.
        // We declare the prefix explicitly at 191 chars (191×4=764 bytes), which is
        // safe on MySQL 5.6+ through 8.0 and all MariaDB versions with utf8mb4.
        // SQLite has no key-length concept — a plain index on TEXT is fine there.
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE site_events ADD INDEX site_events_path_index (path(191))');
        } else {
            Schema::table('site_events', function (Blueprint $table) {
                $table->index('path', 'site_events_path_index');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_events');
    }
};
