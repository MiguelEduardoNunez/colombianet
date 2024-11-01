<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->perfil_id == 2) {
            $perfiles = Perfil::orderBy('perfil', 'asc')->paginate(10);
        }
        else {
            $perfiles = Perfil::where('id_perfil', '!=', 2)
                ->orderBy('perfil', 'asc')
                ->paginate(10);
        }

        return view('perfiles.listar', ['perfiles' => $perfiles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perfiles.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            'perfil' => ['required', 'string', 'max:50', 'unique:perfiles,perfil'],
            'descripcion' => ['nullable', 'string']
        ]);

        $perfil = new Perfil();
        $perfil->perfil = $request->perfil;
        $perfil->descripcion = $request->descripcion;
        $perfil->save();

        Alert::success('Registrado', 'Perfil con éxito');
        return redirect(route('perfiles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $perfil = Perfil::find($id);

        return view('perfiles.mostrar', ['perfil' => $perfil]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perfil = Perfil::find($id);

        return view('perfiles.editar', ['perfil' => $perfil]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'perfil' => ['required', 'string', 'max:50', Rule::unique('perfiles')->ignore($id, 'id_perfil')],
            'descripcion' => ['nullable', 'string']
        ]);

        $perfil = Perfil::find($id);
        $perfil->perfil = $request->perfil;
        $perfil->descripcion = $request->descripcion;
        $perfil->save();

        Alert::success('Actualizado', 'Perfil con éxito');
        return redirect(route('perfiles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
