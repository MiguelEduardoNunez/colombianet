<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Elemento extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'elementos';

  
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_elemento';

    protected $fillable = [
        'proyecto_id',
        'stand_id',
        'item_id',
        'marca',
        'modelo',
        'serial',
        'span',
        'codigo_barras',
        'grosor',
        'peso',
        'cantidad',
        'cantidad_minima',
        'tipo_cantidad_id',
    ];
    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';


    /**
     * Relationships associated with the model.
     */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id_proyecto');
    }

    public function stand(): BelongsTo
    {
        return $this->belongsTo(Stand::class, 'stand_id', 'id_stand');
    }

    public function tipoCantidad(): BelongsTo
    {
        return $this->belongsTo(TipoCantidad::class, 'tipo_cantidad_id', 'id_tipo_cantidad');
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id_item');
    }

    public function novedad(): HasMany
    {
        return $this->hasMany(Novedad::class, 'elemento_id', 'id_elemento');
    }
    
    public function detalleEntregaElemento(): HasMany
    {
        return $this->hasMany(DetalleEntregaElemento::class, 'elemento_id', 'id_elemento');
    }

    public function proyectosElementos(): HasMany
    {
        return $this->hasMany(ProyectoElemento::class, 'elemento_id', 'id_elemento');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(EntradaElemento::class, 'elemento_id', 'id_elemento');
    }
}
