<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * "Register interest in the printed book" sign-ups. Ported from the old
     * one.com PHP form (tsv/register_interest.php). See DECISIONS.md.
     *
     * Unlike site_events, this table DOES keep consent_ip / consent_user_agent:
     * that is consent documentation (a record of who agreed to the GDPR terms,
     * and from where), not anonymous traffic analytics. Only created_at is
     * tracked; the model sets UPDATED_AT=null.
     */
    public function up(): void
    {
        Schema::create('book_interest_subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('book_code'); // e.g. 'faustian-bargain-en' / '-sv'
            $table->string('consent_ip')->nullable();
            $table->string('consent_user_agent')->nullable();
            $table->timestamp('created_at')->nullable();

            // One sign-up per email per book edition. A repeat submission is
            // treated as "already on the list", not an error.
            $table->unique(['email', 'book_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_interest_subscribers');
    }
};
