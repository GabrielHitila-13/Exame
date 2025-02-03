<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('preco', 10, 2);
            $table->timestamps();
        });

        // Inserir serviços básicos automaticamente
        DB::table('servicos')->insert([
            ['nome' => 'Troca de Óleo', 'preco' => 5000],
            ['nome' => 'Alinhamento e Balanceamento', 'preco' => 8000],
            ['nome' => 'Revisão Completa', 'preco' => 25000],
            ['nome' => 'Diagnóstico de Motor', 'preco' => 12000],
            ['nome' => 'Troca de Pastilhas de Freio', 'preco' => 7000],
            ['nome' => 'Carga de Ar-Condicionado', 'preco' => 9000],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('servicos');
    }
};
