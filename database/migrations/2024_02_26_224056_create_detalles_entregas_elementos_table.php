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
        Schema::create('detalles_entregas_elementos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->integer('id_detalle_entrega')->autoIncrement();
            $table->integer('entrega_elemento_id');
            $table->integer('elemento_id');
            $table->float('cantidad');
            $table->float('cantidad_devolucionada')->default(0);// Cantidad devuelta por el cliente valor por defecto 0
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_entregas');
    }
};
