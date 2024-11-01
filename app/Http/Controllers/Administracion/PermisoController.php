<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use App\Models\ModuloPerfil;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermisoController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modulos = Modulo::with(['moduloHijo' => function (Builder $query) {
            $query->orderBy('orden', 'asc');
        }])
        ->where('modulo_id', '=', null)
        ->orderBy('orden', 'asc')
        ->get();

        $permisos = ModuloPerfil::where('perfil_id', '=', $id)->get();
        
        $modulosAgrupados = array();
        
        foreach ($modulos as $modulo) {
            foreach ($modulo->moduloHijo as $item) {
                $item->moduloHijo;
            }
            
            $modulosAgrupados[] = $modulo;
        }

        return view('perfiles.permiso', ['modulos' => $modulosAgrupados, 'permisos' => $permisos, 'perfil' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permisos = $request->permisos;

        ModuloPerfil::where('perfil_id', '=', $id)->delete();
        
        foreach ($permisos as $permiso) {
            $modulo_perfil = new ModuloPerfil();
            $modulo_perfil->modulo_id = $permiso;
            $modulo_perfil->perfil_id = $id;
            $modulo_perfil->save();
        }

        Alert::success('Actualizados', 'Permisos con éxito');
        return redirect(route('perfiles.index'));
    }
}
