<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'secretario', 'tecnico', 'cliente'])->default('cliente');
            $table->rememberToken();
            $table->timestamps();

            Schema::table('users', function (Blueprint $table) {
                $table->string('documento_identificacao')->nullable()->after('password');
            });
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('documento_identificacao');
        });
    }
};
