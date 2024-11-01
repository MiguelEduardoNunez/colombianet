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
        Schema::table('entregas_elementos', function (Blueprint $table) {
            $table->foreign('proyecto_id')->references('id_proyecto')->on('proyectos');
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
