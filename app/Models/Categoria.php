<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorias';

    
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_categoria';
    
    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';

    /**
     *
    * Relationships associated with the model.
    */
    public function subcategoria(): HasMany
    {
        return $this->hasMany(Subcategoria::class, 'categoria_id', 'id_categoria');
    }

}
