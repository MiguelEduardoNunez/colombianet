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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->integer('id_usuario')->autoIncrement();
            $table->smallInteger('perfil_id');
            $table->string('identificacion', '15');    
            $table->string('nombres', '100');
            $table->string('telefono', '10')->nullable();
            $table->string('email', '50');
            $table->string('password');
            $table->boolean('estado')->default(true);
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
