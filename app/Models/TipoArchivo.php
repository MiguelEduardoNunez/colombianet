<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArchivo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_archivos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tipo_archivo';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';

    /**
     * 
    * Relationships associated with the model.
    */

    public function archivoEmpleado()
    {
        return $this->hasMany(ArchivoEmpleado::class, 'tipo_archivo_id', 'id_tipo_archivo');
    }
}
