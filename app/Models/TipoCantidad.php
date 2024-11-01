<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoCantidad extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipos_cantidades';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_tipo_cantidad';


    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';


    /**
     * Relationships associated with the model.
     */
    public function elemento(): HasMany
    {
        return $this->hasMany(Elemento::class, 'tipo_cantidad_id', 'id_tipo_cantidad');
    }
}
