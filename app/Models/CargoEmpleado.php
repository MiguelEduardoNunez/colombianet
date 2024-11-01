<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CargoEmpleado extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cargos_empleados';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_cargo_empleado';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    
    /**
     *
    * Relationships associated with the model.
    */
    public function empleado(): HasMany
    {
        return $this->hasMany(Empleado::class, 'empleado_id', 'id_empleado');
    }

    use HasFactory;
}
