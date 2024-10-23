<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArchivoEmpleado extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'archivos_empleados';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_archivo_empleado';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'empleado_id',
        'tipo_archivo_id',
        'archivo_empleado_pdf',
        'estado',
    ];

    /**
     * Relationship with the model.
     */

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id_empleado');
    }

    public function tipoArchivo(): BelongsTo
    {
        return $this->belongsTo(tipoArchivo::class, 'tipo_archivo_id', 'id_tipo_archivo');
    }
}
