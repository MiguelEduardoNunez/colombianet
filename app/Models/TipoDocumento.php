<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoDocumento extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_documentos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tipo_documento';


    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * Relationships associated with the model.
     */

    public function empleado(): HasMany
    {
        return $this->hasMany(Empleado::class, 'tipo_documento_id', 'id_tipo_documento');
    }


    use HasFactory;
}
