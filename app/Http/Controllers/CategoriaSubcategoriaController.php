<?php

namespace App\Http\Controllers;

use App\Imports\SubcategoriasImport;
use App\Models\Categoria;
use App\Models\Item;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use PhpParser\Node\Expr\Cast\String_;

class CategoriaSubcategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_categoria)
    {
        //
        $categoria = Categoria::find($id_categoria);

        $subcategorias = Subcategoria::with(['categoria'])
            ->where('categoria_id', '=', $id_categoria)
            ->orderBy('subcategoria', 'asc')
            ->paginate(10);

        return view('subcategorias.listar', ['categoria' => $categoria, 'subcategorias' => $subcategorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_categoria)
    {
        //
        $categoria = Categoria::find($id_categoria);

        return view('subcategorias.crear', ['categoria' => $categoria]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_categoria)
    {
        //
        $validaciones = $request->validate([
            'subcategoria' => ['required', 'string', 'max:100', 'unique:subcategorias'],
            'descripcion' => ['nullable', 'string']
        ]);

        $subcategoria = new Subcategoria();
        $subcategoria->categoria_id = $id_categoria;
        $subcategoria->subcategoria = $request->subcategoria;
        $subcategoria->descripcion = $request->descripcion;

        $subcategoria->save();

        Alert::success('Registrado', 'subcategoría con éxito');

        return redirect(route('categorias.subcategorias.index', $id_categoria));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_categoria, string $id_subcategoria)
    {
        //
        $categoria = Categoria::find($id_categoria);
        $subcategoria = Subcategoria::find($id_subcategoria);

        return view('subcategorias.mostrar', ['categoria' => $categoria, 'subcategoria' => $subcategoria]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_categoria, string $id_subcategoria)
    {
        //
        $categoria = Categoria::find($id_categoria);
        $subcategoria = Subcategoria::find($id_subcategoria);

        return view('subcategorias.editar', ['categoria' => $categoria, 'subcategoria' => $subcategoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_categoria, string $id_subcategoria)
    {
        //
        $validaciones = $request->validate([
            'subcategoria' => ['required', 'string', 'max:100', Rule::unique('subcategorias')->ignore($id_subcategoria, 'id_subcategoria')],
            'descripcion' => ['nullable', 'string']
        ]);

        $subcategoria = Subcategoria::find($id_subcategoria);
        $subcategoria->categoria_id = $id_categoria;
        $subcategoria->subcategoria = $request->subcategoria;
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->save();

        Alert::success('Actualizada', ' subcategoría con éxito');

        return redirect(route('categorias.subcategorias.index', $id_categoria));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id_categoria, string $id_subcategoria)
    {
        $item = Item::where('subcategoria_id', '=', $id_subcategoria)->first();

        if ($item != null) {
            Alert::error('Error', 'la subcategoria tiene registros asociados');
        } else {
            Subcategoria::find($id_subcategoria)->delete();
            Alert::success('Eliminada', 'Subcategoria con exito');
        }
        return redirect(route('categorias.subcategorias.index', $id_categoria));
    }

    public function createImport($id_categoria)
    {
        $categoria = Categoria::find($id_categoria);

        return view('subcategorias.importar', ['categoria' => $categoria]);
    }

    public function storeImport(Request $request, $id_categoria)
    {
        $archivo = $request->file('archivo');

        try {

            Excel::import(new SubcategoriasImport, $archivo);

            Alert::success('Importado', 'subcategorías con éxito');
        } catch (ValidationException $e) {
            $failures = $e->failures();

            $fila = $failures[0]->row();
            $columna = $failures[0]->attribute();
            $error = $failures[0]->errors()[0];

            Alert::error('Error', 'Revise la fila' . $fila . 'en la Columna: ' . $columna . ' Error: ' . $error);
        }

        return redirect(route('categorias.subcategorias.index', $id_categoria));
    }
}
