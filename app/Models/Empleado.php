<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empleados';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_empleado';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationships associated with the model.
     */
    public function novedad(): HasMany
    {
        return $this->hasMany(Novedad::class, 'empleado_id', 'id_empleado');
    }
    
    public function entregaElemento(): HasMany
    {
        return $this->hasMany(EntregaElemento::class, 'empleado_id', 'id_empleado');
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id', 'id_tipo_documento');
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class, 'lugar_expedicion_id', 'id_municipio');
    }

    public function cargoEmpleado(): BelongsTo
    {
        return $this->belongsTo(CargoEmpleado::class, 'cargo_empleado_id', 'id_cargo_empleado');
    }

    public function nivelEducativo(): BelongsTo
    {
        return $this->belongsTo(NivelEducativo::class, 'nivel_educativo_id', 'id_nivel_educativo');
    }

    public function fondoCesantia(): BelongsTo
    {
        return $this->belongsTo(FondoCesantia::class, 'fondo_cesantia_id', 'id_fondo_cesantia');
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(Eps::class, 'eps_id', 'id_eps');
    }

    public function arl(): BelongsTo
    {
        return $this->belongsTo(Arl::class, 'arl_id', 'id_arl');
    }

    public function fondoPension(): BelongsTo
    {
        return $this->belongsTo(FondoPension::class, 'fondo_pension_id', 'id_fondo_pension');
    }

    public function tipoContrato(): BelongsTo
    {
        return $this->belongsTo(TipoContrato::class, 'tipo_contrato_id', 'id_tipo_contrato');
    }

    public function historiaClinica(): HasMany
    {
        return $this->hasMany(HistoriaClinica::class, 'empleado_id', 'id_empleado');
    }

    public function cursos(): BelongsToMany
    {
        return $this->belongsToMany(Curso::class, 'empleados_cursos', 'empleado_id', 'curso_id');
    }


    public function contactoEmergencia(): HasMany
    {
        return $this->hasMany(ContactoEmergencia::class, 'empleado_id', 'id_empleado');
    }
}
