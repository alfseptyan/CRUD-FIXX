<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->decimal('discount', 5, 2)->nullable(); // Kolom untuk diskon dalam persentase
            $table->decimal('discounted_price', 10, 2)->nullable(); // Kolom untuk harga setelah diskon
        });
    }
    
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['discount', 'discounted_price']);
        });
    }
};    