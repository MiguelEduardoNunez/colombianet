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
        Schema::create('empleados_cursos', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_spanish_ci';

            $table->integer('empleado_id')->autoIncrement();
            $table->integer('curso_id');
            $table->string('certificado_pdf', '100');
            $table->timestamp('creado_en');
            $table->timestamp('actualizado_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados_cursos');
    }
};
