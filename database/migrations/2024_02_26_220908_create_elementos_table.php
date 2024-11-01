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
        Schema::create('elementos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->integer('id_elemento')->autoIncrement();
            $table->integer('proyecto_id');
            $table->integer('stand_id');
            $table->integer('item_id');
            $table->string('marca', '50');
            $table->string('modelo', '50');
            $table->string('serial', '50');
            $table->string('span', '50');
            $table->string('codigo_barras', '100');
            $table->string('grosor', '50');
            $table->string('peso', '30');
            $table->float('cantidad');
            $table->float('cantidad_minima');
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos');
    }
};
