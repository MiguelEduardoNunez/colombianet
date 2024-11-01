<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Arl extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'arl';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_arl';

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
        return $this->hasOne(Empleado::class, 'arl_id', 'id_arl');
    }
    use HasFactory;
}
