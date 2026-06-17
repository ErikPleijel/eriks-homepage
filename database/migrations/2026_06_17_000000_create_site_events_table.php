<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('event_type');            // 'pageview' | 'click'
            $table->string('path');
            $table->string('locale');
            $table->string('referrer_host')->nullable();
            $table->string('label')->nullable();     // click target label; null for pageviews
            $table->timestamp('created_at')->nullable();

            $table->index(['event_type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_events');
    }
};
