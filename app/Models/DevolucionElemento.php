<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DevolucionElemento extends Model
{
    use HasFactory;


    protected $table = 'devolucion_elementos';



    protected $primaryKey = 'id_devolucion_elemento';


    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';

    /**
     * 
     * Relationships associated with the model.
     */
    //detalle entrega elemento
    public function detalleEntregaElemento()
    {
        return $this->hasMany(DevolucionElemento::class, 'detalles_entregas_elementos_id',"entrega_elemento_id");
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id','id_proyecto');
    }

}
