<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\Empleado;
use App\Models\Item;
use App\Models\Novedad;
use App\Models\Proyecto;
use App\Models\Stand;
use App\Models\Subcategoria;
use App\Models\TipoNovedad;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ElementoNovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_elemento)
    {
        $elemento = Elemento::find($id_elemento);
        $proyecto = Proyecto::find($elemento->proyecto_id);

        $novedades = Novedad::with(['elemento'])
        ->where('elemento_id', '=', $id_elemento)
        ->orderBy('novedad', 'asc')
        ->paginate(10);

        return view('novedades.listar', ['elemento' => $elemento, 'novedades' => $novedades, 'proyecto' => $proyecto]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_elemento)
    {
        $elemento = Elemento::find($id_elemento);

        $proyectos = Proyecto::orderBy('proyecto', 'asc')->get();


        $stans = Stand::orderBy('stand', 'asc')->get();

        $categorias = Categoria::orderBy('categoria', 'asc')->get();

        $subcategorias = Subcategoria::orderBy('subcategoria', 'asc')->get();

        $items = Item::orderBy('item', 'asc')->get();

        $tipos_novedades = TipoNovedad::orderBy('tipo_novedad', 'asc')->get();

        $empleados = Empleado::orderBy('empleado', 'asc')->get();


        return view('novedades.crear', ['elemento' => $elemento, 'proyectos' => $proyectos, 
        'stands' => $stans, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'items' => $items, 'tipos_novedades' => $tipos_novedades, 'empleados' => $empleados]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_elemento)
    {
        //Error en las validaciones 
        $validaciones = $request->validate([
            'tipo_novedad' => ['required', 'numeric'], 
            'empleado' => ['required', 'numeric'],
            'novedad' => ['required', 'string'],
            'fecha_reporte' => ['required', 'date'],
            'fecha_cierre' => ['required', 'date', 'after_or_equal:fecha_reporte']
            
        ]);

        $novedad = new Novedad();
        $novedad->tipo_novedad_id = $request->tipo_novedad;
        $novedad->elemento_id = $id_elemento;
        $novedad->empleado_id = $request->empleado;
        $novedad->novedad = $request->novedad;
        $novedad->fecha_reporte = $request->fecha_reporte;
        $novedad->fecha_cierre = $request->fecha_cierre;
        $novedad->save();

        Alert::success('Registrada', 'Novedad con éxito');
        return redirect(route('elementos.novedades.index', $id_elemento));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_elemento, string $id_novedad)
    {
        $elemento = Elemento::find($id_elemento);

        $novedad = Novedad::find($id_novedad);

        return view('novedades.mostrar', ['elemento' => $elemento, 'novedad' => $novedad]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_elemento, string $id_novedad)
    {
        $elemento = Elemento::find($id_elemento);

        $novedad = Novedad::find($id_novedad);

        $proyectos = Proyecto::where('id_proyecto', '!=', $elemento->proyecto_id)
            ->orderBy('proyecto', 'asc')
            ->get();

        $stans = Stand::where('id_stand', '!=', $elemento->stand_id)
            ->orderBy('stand', 'asc')
            ->get();

        $categorias = Categoria::where('id_categoria', '!=', $elemento->item->subcategoria->categoria->id_categoria)
            ->orderBy('categoria', 'asc')
            ->get();

        $subcategorias = Subcategoria::where('id_subcategoria', '!=', $elemento->item->subcategoria->id_subcategoria)
            ->orderBy('subcategoria', 'asc')
            ->get();

        $items = Item::where('id_item', '!=', $elemento->item_id)
            ->orderBy('item', 'asc')
            ->get();

        $tipopsNovedades = TipoNovedad::where('id_tipo_novedad', '!=', $novedad->tipo_novedad_id)
            ->orderBy('tipo_novedad', 'asc')
            ->get();

        $empleados = Empleado::where('id_empleado', '!=', $novedad->empleado_id)
            ->orderBy('empleado', 'asc')
            ->get();

        return view('novedades.editar',[
            'elemento' => $elemento, 'novedad' => $novedad, 'proyectos' => $proyectos, 'stands' => $stans, 'categorias' => $categorias,
            'subcategorias' => $subcategorias, 'items' => $items, 'tiposNovedades' => $tipopsNovedades, 'empleados' => $empleados
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_elemento, string $id_novedad)
    {
        $validaciones = $request->validate([
            'tipo_novedad' => ['required', 'numeric'], 
            'empleado' => ['required', 'numeric'],
            'novedad' => ['required', 'string'],
            'fecha_reporte' => ['required', 'date'],
            'fecha_cierre' => ['required', 'date', 'after:fecha_reporte']
            
        ]);

        $novedad = Novedad::find($id_novedad);
        $novedad->tipo_novedad_id = $request->tipo_novedad;
        $novedad->elemento_id = $id_elemento;
        $novedad->empleado_id = $request->empleado;
        $novedad->novedad = $request->novedad;
        $novedad->fecha_reporte = $request->fecha_reporte;
        $novedad->fecha_cierre = $request->fecha_cierre;
        $novedad->save();

        Alert::success('Actualizada', 'Novedad con éxito');
        return redirect(route('elementos.novedades.index', $id_elemento));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_elemento, string $id_novedad)
    {
        Novedad::find($id_novedad)->delete();
        Alert::success('Eliminado', 'Novedad con exito');

        return redirect(route('elementos.novedades.index', $id_elemento));
    }
}
