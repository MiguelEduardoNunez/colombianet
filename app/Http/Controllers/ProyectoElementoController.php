<?php

namespace App\Http\Controllers;

use App\Imports\ElementoImport;
use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\Item;
use App\Models\Proyecto;
use App\Models\ProyectoElemento;
use App\Models\Stand;
use App\Models\Subcategoria;
use App\Models\TipoCantidad;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;


class ProyectoElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $elementos = Elemento::with(['item', 'tipoCantidad'])
            ->where('proyecto_id', '=', $id_proyecto)
            ->orderBy('modelo', 'asc')
            ->paginate(00);

        return view('elementos.listar', ['proyecto' => $proyecto, 'elementos' => $elementos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id_proyecto)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $stands = Stand::all()->map(function($stand) {
            $stand->concatenated = $stand->stand . ' - ' . $stand->ubicacion;
            return $stand;
        });

        $categorias = Categoria::orderBy('categoria', 'asc')->get();

        $subcategorias = Subcategoria::orderBy('subcategoria', 'asc')->get();

        $items = Item::orderBy('item', 'asc')->get();

        $tipos_cantidad = TipoCantidad::orderBy('tipo_cantidad', 'asc')->get();

        return view('elementos.crear', [
            'proyecto' => $proyecto, 'stands' => $stands, 'categorias' => $categorias, 'subcategorias' => $subcategorias,
            'items' => $items, 'tipos_cantidad' => $tipos_cantidad
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_proyecto)
    {
        $validaciones = $request->validate([
            'stand' => ['required', 'numeric'],
            'elemento' => ['required', 'numeric'],
            'marca' => ['required', 'string', 'max:50'],
            'modelo' => ['required', 'string', 'max:50'],
            'serial' => ['required', 'string', 'max:50'],
            'span' => ['required', 'string', 'max:50'],
            'codigo_barras' => ['required', 'string', 'max:100'],
            'grosor' => ['required', 'string', 'max:50'],
            'peso' => ['required', 'string', 'max:30'],
            'tipo_cantidad' => ['required', 'numeric'],
            'cantidad' => ['required', 'numeric'],
            'cantidad_minima' => ['required', 'numeric']
        ]);

        $elemento_registrado = Elemento::where('item_id', '=', $request->elemento)
            ->where('marca', '=', $request->marca)
            ->where('modelo', '=', $request->modelo)
            ->first();

        if ($elemento_registrado == null) {
            $elemento = new Elemento();
            $elemento->proyecto_id = $id_proyecto;
            $elemento->stand_id = $request->stand;
            $elemento->item_id = $request->elemento;
            $elemento->marca = $request->marca;
            $elemento->modelo = $request->modelo;
            $elemento->serial = $request->serial;
            $elemento->span = $request->span;
            $elemento->codigo_barras = $request->codigo_barras;
            $elemento->grosor = $request->grosor;
            $elemento->peso = $request->peso;
            $elemento->tipo_cantidad_id = $request->tipo_cantidad;
            $elemento->cantidad = $request->cantidad;
            $elemento->cantidad_minima = $request->cantidad_minima;
            $elemento->save();

            Alert::success('Registrado', 'Elemento con éxito');
            return redirect()->route('proyectos.elementos.index', $id_proyecto);
        } else {
            Alert::error('Error', 'El elemento ya esta registrado, actualice su cantidad');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_proyecto, string $id_elemento)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $elemento = Elemento::find($id_elemento);

        return view('elementos.mostrar', ['proyecto' => $proyecto, 'elemento' => $elemento]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_proyecto, string $id_elemento)
    {
        $proyecto = Proyecto::find($id_proyecto);

        $elemento = Elemento::find($id_elemento);

        $stands = Stand::where('id_stand', '!=', $elemento->stand_id)
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

        $tipos_cantidad = TipoCantidad::where('id_tipo_cantidad', '!=', $elemento->tipo_cantidad_id)
            ->orderBy('tipo_cantidad', 'asc')
            ->get();

        return view('elementos.editar', [
            'proyecto' => $proyecto, 'elemento' => $elemento, 'stands' => $stands, 'categorias' => $categorias,
            'subcategorias' => $subcategorias, 'items' => $items, 'tipos_cantidad' => $tipos_cantidad
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_proyecto, string $id_elemento)
    {
        $validaciones = $request->validate([
            'stand' => ['required', 'numeric'],
            'elemento' => ['required', 'numeric'],
            'marca' => ['required', 'string', 'max:50'],
            'modelo' => ['required', 'string', 'max:50'],
            'serial' => ['required', 'string', 'max:50'],
            'span' => ['required', 'string', 'max:50'],
            'codigo_barras' => ['required', 'string', 'max:100'],
            'grosor' => ['required', 'string', 'max:50'],
            'peso' => ['required', 'string', 'max:30'],
            'tipo_cantidad' => ['required', 'numeric'],
            'cantidad' => ['required', 'numeric'],
            'cantidad_minima' => ['required', 'numeric']
        ]);

        $elemento_registrado = Elemento::where('id_elemento', '!=', $id_elemento)
            ->where('item_id', '=', $request->elemento)
            ->where('marca', '=', $request->marca)
            ->where('modelo', '=', $request->modelo)
            ->first();

        if ($elemento_registrado == null) {
            $elemento = Elemento::find($id_elemento);
            $elemento->proyecto_id = $id_proyecto;
            $elemento->stand_id = $request->stand;
            $elemento->item_id = $request->elemento;
            $elemento->marca = $request->marca;
            $elemento->modelo = $request->modelo;
            $elemento->serial = $request->serial;
            $elemento->span = $request->span;
            $elemento->codigo_barras = $request->codigo_barras;
            $elemento->grosor = $request->grosor;
            $elemento->peso = $request->peso;
            $elemento->tipo_cantidad_id = $request->tipo_cantidad;
            $elemento->cantidad = $request->cantidad;
            $elemento->cantidad_minima = $request->cantidad_minima;
            $elemento->save();

            Alert::success('Actualizado', 'Elemento con éxito');
            return redirect()->route('proyectos.elementos.index', $id_proyecto);
        } else {
            Alert::error('Error', 'El elemento ya esta registrado, actualice su cantidad');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_proyecto, string $id_elemento)
    {
        //
    }


    public function pdfElementos(string $id)
    {
        $proyecto = Proyecto::find($id);
        $elementos = Elemento::where('proyecto_id', $id)->get();

        $pdf = PDF::loadView('elementos.pdf', ['proyecto' => $proyecto, 'elementos' => $elementos]);
        return $pdf->stream('elementos-' . $proyecto->proyecto . '.pdf');
    }


    public function migrarElementosCreate(string $id_proyecto)
    {
        $proyecto = Proyecto::findOrFail($id_proyecto);

        $proyectos = Proyecto::where('id_proyecto', '!=', $id_proyecto)
            ->orderBy('proyecto', 'asc')
            ->get();

        $elementos = Elemento::with(['item', 'tipoCantidad'])
            ->where('proyecto_id', $id_proyecto)
            ->orderBy('modelo', 'asc')
            ->get();



        return view('elementos.migrar', ['proyecto' => $proyecto, 'elementos' => $elementos, 'proyectos' => $proyectos]);
    }

    public function migrarElementosStore(Request $request, string $id_proyecto)
    {
        $elementosSeleccionados = $request->elementos_seleccionados;
        $idProyectoDestino = $request->proyecto_destino;
        $cantidades = $request->cantidades;

        $request->validate([
            'elementos_seleccionados' => 'required|array|min:1',
            'proyecto_destino' => 'required'
        ]);

        $elementos_migracion = array_map(function (int $elemento, int $cantidad): array {
            return ["elemento" => $elemento, "cantidad" => $cantidad];
        }, $elementosSeleccionados, $cantidades);

        foreach ($elementos_migracion as $elementos) {
            $elemento = Elemento::find($elementos['elemento']);
            $cantidad_migrada = $elementos['cantidad'];
            $cantidad_total = $elemento->cantidad;

            $elemento_existente = Elemento::where('proyecto_id', '=', $idProyectoDestino)
                ->where('item_id', $elemento->item_id)
                ->first();

            if ($elemento_existente) {
                $elemento_existente->cantidad += $cantidad_migrada;
                $elemento_existente->save();
            
                if ($cantidad_migrada == $cantidad_total) {
                    $elemento->delete();
                } else {
                    $elemento->cantidad -= $cantidad_migrada;
                    $elemento->save();
                }
            } else {
                if ($cantidad_migrada > $cantidad_total) {
                    Alert::error('Error', 'La cantidad a migrar es mayor a la cantidad total');
                    return back()->withInput();
                } else {
                    if ($cantidad_migrada == $cantidad_total) {
                        $elemento->proyecto_id = $idProyectoDestino;
                        $elemento->save();
                    } else {
                        $elemento->cantidad -= $cantidad_migrada;
                        $elemento->save();
            
                        $elemento_clonado = $elemento->replicate();
                        $elemento_clonado->proyecto_id = $idProyectoDestino;
                        $elemento_clonado->cantidad = $cantidad_migrada;
                        $elemento_clonado->save();
                    }
                }
            }

            $proyecto_elemento = ProyectoElemento::where('proyecto_id', '=', $idProyectoDestino)
                ->where('elemento_id', $elementos['elemento'])
                ->first();

            if ($proyecto_elemento) {
                $proyecto_elemento->cantidad = $elementos['cantidad'];
                $proyecto_elemento->save();
            } else {
                $proyecto_elemento = new ProyectoElemento();
                $proyecto_elemento->proyecto_id = $idProyectoDestino;
                $proyecto_elemento->proyecto_origen = $id_proyecto;
                $proyecto_elemento->elemento_id = $elementos['elemento'];
                $proyecto_elemento->cantidad = $elementos['cantidad'];
                $proyecto_elemento->save();
            }
        }

        Alert::success('Migrados', 'Los Elementos se migraron con éxito');
        return redirect()->route('proyectos.elementos.index', $id_proyecto);
    }

    public function createImport($id_proyecto)

    {
        $proyecto = Proyecto::find($id_proyecto);
        return view('elementos.importar', ['proyecto' => $proyecto]);
    }

    public function storeImport(Request $request, String $id_proyecto)
    {
        $archivo = $request->file('archivo_excel');

        try {
            Excel::import(new ElementoImport, $archivo);
            Alert::success('Importado', 'Archivo con éxito');
        } catch (ValidationException $exception) {
            $failures = $exception->failures();

            $fila = $failures[0]->row();
            $columna = $failures[0]->attribute();
            $error = implode("", $failures[0]->errors());

            Alert::error('Error', 'Revise la Fila ' . $fila . ' en la Columna ' . $columna . ' ' . $error);
        }

        return redirect()->route('proyectos.elementos.index', $id_proyecto);
    }
}
