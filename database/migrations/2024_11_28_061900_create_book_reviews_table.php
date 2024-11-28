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
    Schema::create('book_reviews', function (Blueprint $table) {
        $table->id();
        $table->foreignId('book_id')->constrained(); // Relasi ke tabel books
        $table->foreignId('user_id')->constrained(); // Relasi ke tabel users
        $table->text('review');
        $table->string('tags'); // Menyimpan tag dalam format JSON
        $table->timestamps(); // created_at dan updated_at
    });
}

public function down()
{
    Schema::dropIfExists('book_reviews');
}
};