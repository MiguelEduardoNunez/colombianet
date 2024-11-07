<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Novedad;
use Illuminate\Http\Request;
use App\Models\TipoNovedad;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class TipoNovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tipoNovedades = TipoNovedad::orderBy('tipo_novedad', 'asc')->paginate(10);
        return view('tipo_novedades.listar', ['tipoNovedades' => $tipoNovedades]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tipo_novedades.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            //regex para que solo acepte letras y espacios
            'tipo_novedad' => ['required', 'string', 'max:100', 'unique:tipos_novedades'],
            'descripcion' => ['nullable', 'string', 'max:100']
        ]);
        $tipoNovedad = new TipoNovedad();
        $tipoNovedad->tipo_novedad = $request->tipo_novedad;
        $tipoNovedad->descripcion = $request->descripcion;

        $tipoNovedad->save();

        Alert::success('Registrado', 'Tipo de novedad con éxito');
        return redirect(route('tipo_novedades.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $tipoNovedad = TipoNovedad::find($id);
        return view('tipo_novedades.mostrar', ['tipoNovedad' => $tipoNovedad]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $tipoNovedad = TipoNovedad::find($id);
        return view('tipo_novedades.editar', ['tipoNovedad' => $tipoNovedad]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'tipo_novedad' => ['required', 'string', 'max:100', Rule::unique('tipos_novedades')->ignore($id, 'id_tipo_novedad')],
            'descripcion' => ['nullable', 'string', 'max:100']
        ]);
        $tipoNovedad = TipoNovedad::find($id);
        $tipoNovedad->tipo_novedad = $request->tipo_novedad;
        $tipoNovedad->descripcion = $request->descripcion;
        $tipoNovedad->save();

        Alert::success('Actualizada', 'Tipo de novedad con éxito');

        return redirect(route('tipo_novedades.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $novedad = Novedad::where('tipo_novedad_id', '=', $id)->first();

        if ($novedad != null) {
            Alert::error('Error', 'El tipo novedad tiene registros asociados');
        }
        else {
        TipoNovedad::find($id)->delete();
        Alert::success('Eliminada', 'Tipo de Novedad con exito');
        }
        return redirect(route('tipo_novedades.index'));
    }
}
