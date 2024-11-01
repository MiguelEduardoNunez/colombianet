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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->integer('id_proyecto')->autoIncrement();
            $table->string('proyecto', '200');  
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin'); 
            $table->string('responsable_proyecto', '100');  
            $table->string('correo_responsable', '50'); 
            $table->string('telefono_responsable', '20')->nullable(); 
            $table->string('direccion_cliente', '100')->nullable();  
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
