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
        Schema::table('novedades', function (Blueprint $table) {
            $table->foreign('tipo_novedad_id')->references('id_tipo_novedad')->on('tipos_novedades');
            $table->foreign('elemento_id')->references('id_elemento')->on('elementos');
            $table->foreign('empleado_id')->references('id_empleado')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
