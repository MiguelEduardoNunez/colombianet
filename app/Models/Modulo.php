<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modulo extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'modulos';


    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'id_modulo';

    /**
     * Names of the timestamps.
     */
    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';

    /**
     * 
    * Relationships associated with the model.
    */
    public function moduloHijo(): HasMany
    {
        return $this->hasMany(Modulo::class, 'modulo_id', 'id_modulo');
    }

    public function moduloPadre(): BelongsTo
    {
        return $this->belongsTo(Modulo::class, 'modulo_id', 'id_modulo');
    }

    public function moduloPerfil(): HasMany
    {
        return $this->hasMany(ModuloPerfil::class, 'modulo_id', 'id_modulo');
    }

    public static function permisos($padre = null, $id)
    {
        $modulos = Usuario::join('perfiles', 'usuarios.perfil_id', '=', 'perfiles.id_perfil')
            ->join('modulos_perfiles', 'modulos_perfiles.perfil_id', '=', 'perfiles.id_perfil')
            ->join('modulos', 'modulos_perfiles.modulo_id', '=', 'modulos.id_modulo')
            ->select('modulos.*')
            ->where('modulos.modulo_id', '=', $padre)
            ->where('usuarios.id_usuario', '=', $id)
            ->orderBy('modulos.orden', 'asc')
            ->get();

        $modulosAgrupados = array();

        $i = 0;
        
        foreach ($modulos as $modulo) {
           $modulosAgrupados[$i] = $modulo;

           if ($modulo->modulo_id == null || $modulo->ruta == null) {
                $modulosAgrupados[$i]->hijos = Modulo::permisos($modulo->id_modulo, $id);
           }
           $i++;
        }
              
        return $modulosAgrupados;
    }
}
