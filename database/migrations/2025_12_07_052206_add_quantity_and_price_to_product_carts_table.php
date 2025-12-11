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
        Schema::table('product_carts', function (Blueprint $table) {
            // Idagdag ang Quantity column (integer)
            $table->integer('quantity')->default(1)->after('product_id');

            // Idagdag ang Price column (decimal, para sa pera)
            // Gamitin ang decimal para sa presyo
            $table->decimal('price', 10, 2)->nullable()->after('quantity'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_carts', function (Blueprint $table) {
            // Ito ang mag-aalis ng columns kung nag-rollback ka
            $table->dropColumn('quantity');
            $table->dropColumn('price');
        });
    }
};