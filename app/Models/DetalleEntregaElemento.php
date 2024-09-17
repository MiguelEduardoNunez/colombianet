<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetalleEntregaElemento extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detalles_entregas_elementos';
        
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_detalle_entrega_elemento';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';

    protected $fillable = [
        'entrega_elemento_id ',
        'elemento_id ',
        'cantidad',
        'cantidad_devolucionada',
    ];
    
    /**
     * Relationships associated with the model.
     */
    public function entregaElemento(): BelongsTo
    {
        return $this->belongsTo(EntregaElemento::class, 'entrega_elemento_id', 'id_entrega_elemento');
    }
    
    public function elemento(): BelongsTo
    {
        return $this->belongsTo(Elemento::class, 'elemento_id', 'id_elemento');
    }

    public function devolucionElementos(): HasMany
    {
        return $this->hasMany(DevolucionElemento::class, 'detalle_entrega_id', 'entrega_elemento_id');
    }
    
}
