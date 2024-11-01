<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stand extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stands';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_stand';


    /**
     * Names of the timestamps.
     */
    const CREATED_AT='creado_en';
    const UPDATED_AT='actualizado_en';


    /**
     * 
    * Relationships associated with the model.
    */
    public function elemento(): HasMany
    {
        return $this->hasMany(Elemento::class, 'stand_id', 'id_stand');
    }
}
