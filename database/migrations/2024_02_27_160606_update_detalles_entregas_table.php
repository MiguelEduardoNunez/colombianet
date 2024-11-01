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
        Schema::table('detalles_entregas', function (Blueprint $table) {
            $table->foreign('entrega_elemento_id')->references('id_entrega_elemento')->on('entregas_elementos');
            $table->foreign('elemento_id')->references('id_elemento')->on('elementos');
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
