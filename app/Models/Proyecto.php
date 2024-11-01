<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{  
      use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proyectos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_proyecto';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * 
     * Relationships associated with the model.
     */
    public function elemento(): HasMany
    {
        return $this->hasMany(Elemento::class, 'proyecto_id', 'id_proyecto');
    }

    public function entregaElemento(): HasMany
    {
        return $this->hasMany(EntregaElemento::class, 'proyecto_id', 'id_proyecto');
    }   

    public function proyectosElementos(): HasMany
    {
        return $this->hasMany(ProyectoElemento::class, 'proyecto_id', 'id_proyecto');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(EntradaElemento::class, 'proyecto_id', 'id_proyecto');
    }
    
}
