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
        Schema::table('orders', function (Blueprint $table) {
            // Idagdag ang Quantity
            $table->integer('quantity')->default(1)->after('product_id'); 
            // Idagdag ang Price (total price ng item na ito)
            $table->decimal('price', 10, 2)->nullable()->after('quantity'); 
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('quantity');
            $table->dropColumn('price');
        });
    }
};
