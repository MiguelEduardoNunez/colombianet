<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'municipios';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_municipio';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationships associated with the model.
     */
    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id_departamento');
    }

    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'lugar_expedicion_id', 'id_municipio');
    }

    use HasFactory;
}
