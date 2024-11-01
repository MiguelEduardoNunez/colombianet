<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactoEmergencia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contactos_emergencias';



    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_contacto_emergencia';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationships associated with the model.
     */
    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id_empleado');
    }

    use HasFactory;
}
