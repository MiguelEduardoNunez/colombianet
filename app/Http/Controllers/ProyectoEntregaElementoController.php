<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetalleEntregaElemento;
use App\Models\DevolucionElemento;
use App\Models\Elemento;
use App\Models\Empleado;
use App\Models\EntregaElemento;
use App\Models\Proyecto;
use App\Models\Subcategoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProyectoEntregaElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $entregas_elementos = EntregaElemento::with('empleado')
            ->where('proyecto_id', '=', $id_proyecto)
            ->orderBy('fecha_entrega', 'desc')
            ->paginate(10);

        return view('entregas_elementos.listar', ['proyecto' => $proyecto, 'entregas_elementos' => $entregas_elementos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $empleados = Empleado::orderBy('nombres_completos', 'asc')->get();

        $categorias = Categoria::orderBy('categoria', 'asc')->get();

        $subcategorias = Subcategoria::orderBy('subcategoria', 'asc')->get();

        $elementos = Elemento::with(['item', 'tipoCantidad'])
        ->where('proyecto_id', '=', $id_proyecto)
        ->orderBy('marca', 'asc')
        ->get()
        ->map(function ($elemento) {
        // Asegúrate de que el elemento y el item existen antes de concatenar
        $elemento->concatenated = $elemento->item->item . ' - ' . $elemento->serial;
        return $elemento;
    });

        
        return view('entregas_elementos.crear', ['proyecto' => $proyecto, 'empleados' => $empleados, 'categorias' => $categorias,
            'subcategorias' => $subcategorias, 'elementos' => $elementos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_proyecto)
    {
        $validaciones = $request->validate([
            'empleado' => ['required', 'numeric'],
            'fecha_entrega' => ['required', 'date', 'after_or_equal:today'],
        ], [
            'fecha_entrega.after_or_equal' => 'La fecha de entrega debe ser una fecha posterior o igual a la fecha actual.',
        ]);

        $entrega_elemento = new EntregaElemento();
        $entrega_elemento->proyecto_id = $id_proyecto;
        $entrega_elemento->empleado_id = $request->empleado;
        $entrega_elemento->fecha_entrega = $request->fecha_entrega;
        $entrega_elemento->save();

        $entrega_elemento_registrada = EntregaElemento::get()->last();

        $elementos = $request->elementos;
        $cantidades = $request->cantidades;

        $elementos_entrega = array_map(function(int $elemento, int $cantidad): array {
            return ["elemento" => $elemento, "cantidad" => $cantidad];
        }, $elementos, $cantidades);

        foreach ($elementos_entrega as $elemento_entrega) {
            $detalle_entrega_elemento = new DetalleEntregaElemento();
            $detalle_entrega_elemento->entrega_elemento_id = $entrega_elemento_registrada->id_entrega_elemento;
            $detalle_entrega_elemento->elemento_id = $elemento_entrega['elemento'];
            $detalle_entrega_elemento->cantidad = $elemento_entrega['cantidad'];
            $detalle_entrega_elemento->save();

            $elemento = Elemento::find($elemento_entrega['elemento']);
            $elemento->cantidad = $elemento->cantidad-$elemento_entrega['cantidad'];
            $elemento->save();
        }

        Alert::success('Registrada', 'Entrega de elementos con éxito');
        return redirect()->route('proyectos.entregas-elementos.index', $id_proyecto);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_proyecto, string $id_entrega_elemento)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $entrega_elemento = EntregaElemento::find($id_entrega_elemento);

        $detalle_entrega_elementos = DetalleEntregaElemento::with(['elemento' => ['stand', 'item', 'tipoCantidad']])
            ->where('entrega_elemento_id', '=', $id_entrega_elemento)
            ->get();

        return view('entregas_elementos.mostrar', ['proyecto' => $proyecto, 'entrega_elemento' => $entrega_elemento, 'detalle_entrega_elementos' => $detalle_entrega_elementos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_proyecto,string $id_entrega_elemento)
    {
        //

        $entrega_elemento = EntregaElemento::find($id_entrega_elemento);

        $proyecto = Proyecto::find($id_proyecto);

        $detalle_entrega_elementos = DetalleEntregaElemento::with(['elemento' => ['item', 'tipoCantidad']])
            ->where('entrega_elemento_id', '=', $id_entrega_elemento)
            ->get();

        return view('entregas_elementos.editar', ['proyecto' => $proyecto, 'entrega_elemento' => $entrega_elemento, 'detalle_entrega_elementos' => $detalle_entrega_elementos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_proyecto, string $id_entrega_elemento)
    {
        $proyecto = $request->input('proyecto');
        $empleado= $request->input('empleado');
        $fechaEntrega = $request->input('fecha_entrega');

        $elementosSeleccionados = $request->input('elementos_seleccionados');
        $cantidades = $request->input('cantidades');


        $entrega_elemento = EntregaElemento::find($id_entrega_elemento);

        $detalle_entrega_elementos = DetalleEntregaElemento::where('entrega_elemento_id', '=', $id_entrega_elemento)->get();


        foreach ($elementosSeleccionados as $key => $elementoSeleccionado) {
           
            if($cantidades[$key] > $detalle_entrega_elementos[$key]->cantidad){
                
                Alert::error('Error', 'La cantidad a devolver es mayor a la cantidad entregada');
                return back()->withInput();
            }

            $devolucion = new DevolucionElemento();
            $devolucion->detalles_entregas_id = $id_entrega_elemento;
            $devolucion->proyecto_id = $id_proyecto;
            $devolucion->devolucion_cantidad = $cantidades[$key] ;


            $elemento = Elemento::find($elementoSeleccionado);
            $elemento->cantidad = $elemento->cantidad+$cantidades[$key];

            $devolucion->save();
            $elemento->save();
            
        }

        Alert::success('Actualizada', 'Entrega de elementos con éxito');
        return redirect()->route('proyectos.entregas-elementos.index', $id_proyecto);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_proyecto, string $id_entrega_elemento)
    {
        $detalle_entrega_elementos = DetalleEntregaElemento::where('entrega_elemento_id', '=', $id_entrega_elemento)->get();

        foreach ($detalle_entrega_elementos as $detalle_entrega_elemento) {
            $elemento = Elemento::find($detalle_entrega_elemento->elemento_id);
            $elemento->cantidad = $elemento->cantidad+$detalle_entrega_elemento->cantidad;
            $elemento->save();
        }

        $detalle_entrega_elemento->delete();
        EntregaElemento::find($id_entrega_elemento)->delete();

        Alert::success('Eliminada', 'Entrega de elementos con éxito');
        return redirect()->route('proyectos.entregas-elementos.index', $id_proyecto);
    }

    /**
     * Download the specified resource from storage.
     */
    public function reporte(string $id_proyecto, string $id_entrega_elemento)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $entrega_elemento = EntregaElemento::find($id_entrega_elemento);

        $detalle_entrega_elementos = DetalleEntregaElemento::with(['elemento' => ['item', 'tipoCantidad']])
            ->where('entrega_elemento_id', '=', $id_entrega_elemento)
            ->get();

        $reporte = Pdf::loadView('entregas_elementos.reporte', [
            'proyecto' => $proyecto, 'entrega_elemento' => $entrega_elemento, 'detalle_entrega_elementos' => $detalle_entrega_elementos
        ]);

        return $reporte->download('Entrega-Elementos-'.$proyecto->proyecto.'.pdf');
    }
}
