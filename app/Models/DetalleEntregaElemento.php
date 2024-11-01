<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    protected $primaryKey = 'entrega_elemento_id';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';
    
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

    public function devolucionElemento(): BelongsTo
    {
        return $this->belongsTo(DevolucionElemento::class, 'devolucion_elemento_id', 'id_devolucion_elemento');
    }
    
}
