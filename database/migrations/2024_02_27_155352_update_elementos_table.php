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
        Schema::table('elementos', function (Blueprint $table) {
            $table->foreign('proyecto_id')->references('id_proyecto')->on('proyectos');
            $table->foreign('stand_id')->references('id_stand')->on('stands');
            $table->foreign('item_id')->references('id_item')->on('items');
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
