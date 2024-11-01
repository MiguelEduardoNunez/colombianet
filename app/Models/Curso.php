<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cursos';
  


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_curso';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    protected $fillable = [
        'id_curso',
        'nombre_curso',
    ];

    /**
     * Relationships associated with the model.
     */
    public function empleado(): BelongsToMany
    {
        return $this->belongsToMany(Empleado::class, 'empleado_id', 'id_empleado');
    }
   
    use HasFactory;
}
