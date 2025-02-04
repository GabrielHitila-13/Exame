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
    Schema::create('veiculos', function (Blueprint $table) {
        $table->id();
        $table->string('marca');
        $table->string('modelo');
        $table->string('cor');
        $table->string('tipo');
        $table->string('estado')->default('Em análise');
        $table->string('tipo_avaria');
        $table->string('codigo_validacao')->unique();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
