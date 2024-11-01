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
        Schema::create('modulos_perfiles', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->smallInteger('modulo_id');
            $table->smallInteger('perfil_id');
            $table->char('permiso', '1')->nullable();
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();

            $table->primary(['modulo_id', 'perfil_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos_perfiles');
    }
};
