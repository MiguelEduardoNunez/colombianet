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
        $elementos = Elemento::all();
        return view('entradas_elementos.crear', ['proyecto' => $proyecto, 'elementos' => $elementos, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_proyecto)
    {
        // Muestra todos los datos de la solicitud para depuración
        // dd($request->all());
        $elementoId = $request->elemento; // Obtener el ID del elemento directamente del formulario
    
        // Asegúrate de que existe el elemento con el ID proporcionado
        $elemento = Elemento::findOrFail($elementoId); // Usa findOrFail para buscar el elemento por su ID
    
        // Validación de la solicitud
        $request->validate([
            'cantidad' => 'required|numeric',
            'fecha_entrada' => 'required|date|after_or_equal:today', // La fecha no puede ser en el pasado
            'descripcion' => 'nullable|string',
            'elemento' => 'required|exists:elementos,id_elemento', // Asegúrate de que el ID del elemento exista
        ]);
    
        // Crear una nueva entrada de elemento
        $entrada = new EntradaElemento();
        $entrada->proyecto_id = $id_proyecto;
        $entrada->elemento_id = $elemento->id_elemento; // Usa el ID del elemento
        $entrada->cantidad = $request->cantidad;
        $entrada->fecha_entrada = $request->fecha_entrada;
        $entrada->descripcion = $request->descripcion;
        $entrada->save();
    
        // Actualizar la cantidad del elemento
        $elemento->cantidad += $request->cantidad; // Aumentar la cantidad del elemento
        $elemento->save(); // Guardar los cambios en el elemento
    
        // Mostrar un mensaje de éxito y redirigir
        Alert::success('Registrada', 'Entrada con éxito');
        return redirect(route('entrada_elementos.index', $id_proyecto));
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id_proyecto, string $id_entrada_elementos)
    {
        $proyecto = Proyecto::findOrFail($id_proyecto);
        $entrada = EntradaElemento::with('elemento')->findOrFail($id_entrada_elementos);
    
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
