<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProyectoElemento extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proyectos_elementos';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'proyecto_id';


    
    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';



    /**
     * 
    * Relationships associated with the model.
    */
    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id', 'id_proyecto');
    }

    public function elemento(): BelongsTo
    {
        return $this->belongsTo(Elemento::class, 'elemento_id', 'id_elemento');
    }
    
    protected $fillable = ['proyecto_id', 'elemento_id', 'cantidad'];

}
