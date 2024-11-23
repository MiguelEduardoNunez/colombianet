<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::orderby('categoria', 'asc')->paginate(100);

        return view('categorias.listar', ['categorias' => $categorias]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.crear');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            'categoria' => ['required', 'string', 'max:100', 'unique:categorias,categoria'],
            'descripcion' => ['nullable', 'string']
        ]);

        $categoria = new Categoria();
        $categoria->categoria  = $request->categoria;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        Alert::success('Registrado', 'Categoria con exito');
        return redirect(route('categorias.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.mostrar', ['categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.editar', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'categoria' => ['required', 'string', 'max:100', Rule::unique('categorias')->ignore($id, 'id_categoria')],
            'descripcion' => ['nullable', 'string']
        ]);

        $categoria = Categoria::find($id);
        $categoria->categoria  = $request->categoria;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        Alert::success('Actualizada', 'Categoria con exito');
        return redirect(route('categorias.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategoria = Subcategoria::where('categoria_id', '=', $id)->first();

        if ($subcategoria != null) {
            Alert::error('Error', 'la categoría tiene registros asociados');
        } else {
        Categoria::find($id)->delete();
        Alert::success('Eliminada', 'Categoría con exito');
        }
        return redirect(route('categorias.index'));
    }
}
