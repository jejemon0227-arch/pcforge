<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // Idagdag ang 'name' field bilang string, non-nullable.
            // Ilagay natin ito pagkatapos ng 'user_id' para maging maayos ang order.
            $table->string('name')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            // Ito ang code para burahin ang field kung mag-roll back ka ng migration.
            $table->dropColumn('name');
        });
    }
};