<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::orderBy('proyecto', 'asc')->paginate(10);

        return view('proyectos.listar', ['proyectos' => $proyectos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validaciones = $request->validate([
            'proyecto' => ['required', 'string', 'max:200', 'unique:proyectos,proyecto'],
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
            'responsable_proyecto' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:50'],
            'telefono' => ['nullable', 'numeric'],
            'direccion' => ['nullable', 'string', 'max:100']
        ]);

        $proyecto = new Proyecto();
        $proyecto->proyecto = $request->proyecto;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->responsable_proyecto = $request->responsable_proyecto;
        $proyecto->correo_responsable = $request->correo;
        $proyecto->telefono_responsable = $request->telefono;
        $proyecto->direccion_cliente = $request->direccion;
        $proyecto->save();

        Alert::success('Registrado', 'Proyecto con éxito');
        return redirect(route('proyectos.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::find($id);

        return view('proyectos.mostrar', ['proyecto' => $proyecto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::find($id);

        return view('proyectos.editar', ['proyecto' => $proyecto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'proyecto' => ['required', 'string', 'max:200', Rule::unique('proyectos')->ignore($id, 'id_proyecto')],
            'descripcion' => ['nullable', 'string'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
            'responsable_proyecto' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:50'],
            'telefono' => ['nullable', 'numeric'],
            'direccion' => ['nullable', 'string', 'max:100']
        ]);

        $proyecto = Proyecto::find($id);
        $proyecto->proyecto = $request->proyecto;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->responsable_proyecto = $request->responsable_proyecto;
        $proyecto->correo_responsable = $request->correo;
        $proyecto->telefono_responsable = $request->telefono;
        $proyecto->direccion_cliente = $request->direccion;
        $proyecto->save();

        Alert::success('Actualizado', 'Proyecto con éxito');
        return redirect(route('proyectos.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $elemento = Elemento::where('proyecto_id', '=', $id)->first();

        if ($elemento != null) {
            Alert::error('Error', 'el proyecto tiene registros asociados');
        } else {
            Proyecto::find($id)->delete();
            Alert::success('Eliminado', 'Proyecto con exito');
        }
        return redirect(route('proyectos.index'));
    }
}
