<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FondoPension extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fondos_pensiones';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_fondo_pension';

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
        return $this->hasOne(Empleado::class, 'fondo_pension_id', 'id_fondo_pension');
    }


    use HasFactory;
}
