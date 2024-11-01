<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Eps extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'eps';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_eps';

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
        return $this->hasOne(Empleado::class, 'eps_id', 'id_eps');
    }

    use HasFactory;
}
