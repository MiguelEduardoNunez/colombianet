<?php

namespace App\Http\Controllers;

use App\Models\ProyectoElemento;
use Illuminate\Http\Request;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $proyecto_elementos = ProyectoElemento::join('proyectos as p1', 'p1.id_proyecto', '=', 'proyectos_elementos.proyecto_id')
            ->join('elementos', 'elementos.id_elemento', '=', 'proyectos_elementos.elemento_id')
            ->join('proyectos as p2', 'p2.id_proyecto', '=', 'proyectos_elementos.proyecto_origen')
            ->join('items', 'items.id_item', '=', 'elementos.item_id')
            ->select(
                'p1.proyecto as proyecto_destino',
                'p2.proyecto as proyecto_origen',
                'proyectos_elementos.cantidad',
                'items.item',
            )
            ->get();

        return view('informes.listar', ['proyecto_elementos' => $proyecto_elementos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
