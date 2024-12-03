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
        $table->boolean('is_editorial_pick')->default(false)->after('image');
    });
}

public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropColumn('is_editorial_pick');
    });
}
};
