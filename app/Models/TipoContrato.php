<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoContrato extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_contratos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tipo_contrato';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationship with the model.
     */

    public function empleados():HasMany
    {
        return $this->hasMany(Empleado::class, 'tipo_contrato_id', 'id_tipo_contrato');
    }
    use HasFactory;
}
