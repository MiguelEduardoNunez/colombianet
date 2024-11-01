<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FondoCesantia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fondos_cesantias';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_fondo_cesantia';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationship with the model.
     */
    public function empleados():HasOne
    {
        return $this->hasOne(Empleado::class, 'fondo_cesantia_id', 'id_fondo_cesantia');
    }


    use HasFactory;
}
