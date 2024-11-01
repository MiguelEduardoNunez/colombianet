<?php

namespace App\Http\Controllers;

use App\Imports\ItemImport;
use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\Item;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('item', 'asc')->paginate(10);

        return view('items.listar', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('items.crear', ['categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            'subcategoria' => ['required', 'numeric',],
            'item' => ['required', 'string', 'max:100', 'unique:items,item'],
            'descripcion' => ['nullable', 'string']
        ]);

        $item = new Item();
        $item->subcategoria_id = $request->subcategoria;
        $item->item = $request->item;
        $item->descripcion = $request->descripcion;
        $item->save();

        Alert::success('Registrado', 'Item con éxito');
        return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);

        return view('items.mostrar', ['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::with('subcategoria')->find($id);

        $categorias = Categoria::where('id_categoria', '!=', $item->subcategoria->categoria->id_categoria)
            ->orderBy('categoria', 'asc')
            ->get();
    
        $subcategorias = Subcategoria::where('id_subcategoria', '!=', $item->subcategoria->id_subcategoria)
        ->orderBy('subcategoria', 'asc')
        ->get();
    
        return view('items.editar', ['item' => $item, 'subcategorias' => $subcategorias, 'categorias' => $categorias]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'subcategoria' => ['required', 'numeric'],
            'item' => ['required', 'string', 'max:100', Rule::unique('items')->ignore($id, 'id_item')],
            'descripcion' => ['nullable', 'string']
        ]);

        $item = Item::find($id);
        $item->subcategoria_id = $request->subcategoria;
        $item->item = $request->item;
        $item->descripcion = $request->descripcion;
        $item->save();

        Alert::success('Actualizado', 'Item con éxito');
        return redirect(route('items.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $elemento = Elemento::where('item_id', '=', $id)->first();

        if ($elemento != null) {
            Alert::error('Error', 'el item tiene registros asociados');
        } else {

            Item::find($id)->delete();
            Alert::success('Eliminado', 'Item con exito');
        }

        return redirect(route('items.index'));
    }

    /**
     * Muestra el formulario para importar nuevos recursos
     */
    public function createImport()
    {
        return view('items.importar');
    }

    /**
     * Almacena nuevos recursos creados en el almacenamiento
     */
    public function storeImport(Request $request) 
    {
        $archivo = $request->file('archivo_excel');

        try {
            Excel::import(new ItemImport, $archivo);
            Alert::success('Importado', 'Archivo con éxito');
        } catch (ValidationException $exception) {
            $failures = $exception->failures();

            $fila = $failures[0]->row();
            $columna = $failures[0]->attribute();
            $error = implode("", $failures[0]->errors());
             
            Alert::error('Error', 'Revise la Fila '.$fila.' en la Columna '.$columna.' '.$error);
        }

        return redirect()->route('items.index');
    }
}
