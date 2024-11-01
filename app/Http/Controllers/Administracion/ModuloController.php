<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modulos = Modulo::orderBy('modulo', 'asc')->paginate(50);

        return view('modulos.listar', ['modulos' => $modulos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulos = Modulo::orderBy('modulo', 'asc')->get();

        return view('modulos.crear', ['modulos' => $modulos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            'modulo_padre' => ['nullable', 'numeric'],
            'modulo' => ['required', 'string', 'max:100', 'unique:modulos,modulo'],
            'ruta' => ['nullable', 'string', 'max:200', 'unique:modulos,ruta'],
            'icono' => ['required', 'string', 'max:50'],
            'orden' => ['required', 'numeric']
        ]);

        $modulo = new Modulo();
        $modulo->modulo_id = $request->modulo_padre;
        $modulo->modulo = $request->modulo;
        $modulo->ruta = $request->ruta;
        $modulo->icono = $request->icono;
        $modulo->orden = $request->orden;
        $modulo->save();

        Alert::success('Registrado', 'Modulo con éxito');
        return redirect(route('modulos.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $modulo = Modulo::find($id);

        return view('modulos.mostrar', ['modulo' => $modulo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modulo = Modulo::find($id);

        $modulos = Modulo::where('id_modulo', '!=', $modulo->modulo_id)
            ->orderBy('modulo', 'asc')
            ->get();

        return view('modulos.editar', ['modulo' => $modulo, 'modulos' => $modulos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'modulo_padre' => ['nullable', 'numeric'],
            'modulo' => ['required', 'string', 'max:100', Rule::unique('modulos')->ignore($id, 'id_modulo')],
            'ruta' => ['nullable', 'string', 'max:200', Rule::unique('modulos')->ignore($id, 'id_modulo')],
            'icono' => ['required', 'string', 'max:50'],
            'orden' => ['required', 'numeric']
        ]);

        $modulo = Modulo::find($id);
        $modulo->modulo_id = $request->modulo_padre;
        $modulo->modulo = $request->modulo;
        $modulo->ruta = $request->ruta;
        $modulo->icono = $request->icono;
        $modulo->orden = $request->orden;
        $modulo->save();

        Alert::success('Actualizado', 'Modulo con éxito');
        return redirect(route('modulos.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
