<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EntradaElemento;
use App\Models\Item;
use App\Models\Proyecto;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ElementoEntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);
        $entradas = EntradaElemento::with('elemento')
            ->where('proyecto_id', '=', $id_proyecto)
            ->orderBy('descripcion', 'desc')
            ->paginate(10);

        return view('entradas_elementos.listar', ['entradas' => $entradas, 'proyecto' => $proyecto]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_proyecto)
    {
        $categorias = Categoria::orderBy('categoria', 'asc')->get();

        $subcategorias = Subcategoria::orderBy('subcategoria', 'asc')->get();

        $items = Item::orderBy('item', 'asc')->get();

        $proyecto = Proyecto::findOrFail($id_proyecto);
        // filtra los elementos que estén en el proyecto
        $elementos = Elemento::with(['item', 'tipoCantidad'])
        ->where('proyecto_id', '=', $id_proyecto)
        ->orderBy('marca', 'asc')
        ->get()
        ->map(function ($elemento) {
            // Asegúrate de que el elemento y el item existen antes de concatenar
            $elemento->concatenated = $elemento->item->item . ' - ' . $elemento->serial;
            return $elemento;
        });
        return view('entradas_elementos.crear', ['proyecto' => $proyecto, 'elementos' => $elementos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_proyecto)
    {
        $elementoId = $request->elemento; 
    
        // Asegúrate de que existe el elemento con el ID proporcionado
        $elemento = Elemento::findOrFail($elementoId);
    
        // Validación de la solicitud
        $request->validate([
            'cantidad' => 'required|numeric',
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'descripcion' => 'nullable|string',
            'elemento' => 'required|exists:elementos,id_elemento',
        ]);
    
        // Crear una nueva entrada de elemento
        $entrada = new EntradaElemento();
        $entrada->proyecto_id = $id_proyecto;
        $entrada->elemento_id = $elemento->id_elemento;
        $entrada->cantidad = $request->cantidad;
        $entrada->fecha_entrada = $request->fecha_entrada;
        $entrada->descripcion = $request->descripcion;
        $entrada->save();
    
        // Actualizar la cantidad del elemento
        $elemento->cantidad += $request->cantidad;
        $elemento->save();
    
        // Mostrar un mensaje de éxito y redirigir
        Alert::success('Registrada', 'Entrada con éxito');
        return redirect(route('entrada_elementos.index', $id_proyecto));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_proyecto, string $id_entrada_elemento)
    {
        $proyecto = Proyecto::findOrFail($id_proyecto);
        $entrada = EntradaElemento::with('elemento')->findOrFail($id_entrada_elemento);
    
        return view('entradas_elementos.mostrar', ['proyecto' => $proyecto,'entrada' => $entrada]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
