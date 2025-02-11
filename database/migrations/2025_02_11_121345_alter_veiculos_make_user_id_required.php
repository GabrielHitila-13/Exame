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
    Schema::table('veiculos', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(false)->change(); // ❌ NÃO PERMITE NULL
    });
}

public function down()
{
    Schema::table('veiculos', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->change(); // Volta a permitir NULL se precisar reverter
    });
}

};
