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
        Schema::create('empleados', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->string('nombres_completos', '100');
            $table->string('apellidos_completos', '100');
            $table->integer('id_empleado')->autoIncrement();
            $table->smallInteger('tipo_documento_id');
            $table->smallInteger('lugar_expedicion_id');
            $table->smallInteger('cargo_empleado_id');
            $table->smallInteger('tipo_contrato_id');
            $table->smallInteger('nivel_educativo_id');
            $table->smallInteger('arl_id');
            $table->smallInteger('eps_id');
            $table->smallInteger('fondo_pension_id');
            $table->smallInteger('fondo_cesantias_id');
            $table->string('documento', '20');
            $table->date('fecha_expedicion');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('telefono', '10');
            $table->string('email', '100');
            $table->string('direccion', '100');
            $table->integer('estrato');
            $table->date('fecha_inicio_contrato');
            $table->date('fecha_periodo_prueba');
            $table->date('fecha_fin_contrato');
            $table->enum('tipo_sangre', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('arl_pdf', '100');
            $table->integer('nivel_riesgo');
            $table->string('eps_pdf', '100');
            $table->enum('estado', ['Empleado', 'Retirado', 'Prospecto', 'Renuncia', 'Aprendiz', 'Despido']);

            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
