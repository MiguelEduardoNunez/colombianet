<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Novedades') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    
                    <div class="row align-items-center ">

                        <div class="col-auto d-none d-lg-flex ">
                            <a href="{{ route('proyectos.elementos.index', $proyecto->id_proyecto) }}">
                                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                            </a>
                        </div>
                        
                        <div class="col-10 col-md-7">
                            <x-text :value="__('Gestionar Novedades')" />
                        </div>

                        <div class="col-10 col-md-4 col-lg-3 ml-auto">
                            <x-input-group>
                                <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                <x-slot:icon>
                                    <i class="fas fa-search text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                        </div>

                        <div class="col-auto">
                            <a href="{{ route('elementos.novedades.create', $elemento->id_elemento) }}">
                                <i class="fas fa-plus-circle fa-2x" data-toggle="tooltip" title="Registrar Novedad"></i>
                            </a>
                        </div>


                    </div>


                </x-slot:header>

                <x-slot:body class="table-responsive p-0" style="height: 400px;">
                    <x-data-table :headers="['#', 'Elemento', 'Novedad', 'Tipo de Novedad', 'Empleado', 'Fecha Reporte', 'Acciones']">
                        @foreach ($novedades as $novedad)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $elemento->item->item }}</td>
                            <td>{{ $novedad->novedad }}</td>
                            <td>{{ $novedad->tipoNovedad->tipo_novedad }}</td>
                            <td>{{ $novedad->empleado->empleado }}</td>
                            <td>{{ $novedad->fecha_reporte }}</td>
                            
             

                            <td class="text-center">

                                <div class="row justify-content-center align-items-center">

                                    <div class="">
                                        <a href="{{route('elementos.novedades.show', [$elemento->id_elemento, $novedad->id_novedad])}}">
                                            <i class="far fa-eye" data-toggle="tooltip" title="Detalles Novedad"></i>
                                        </a>
                                    </div>

                                    <div class="ml-3">
                                        <a href="{{route('elementos.novedades.edit', [$elemento->id_elemento, $novedad->id_novedad]) }}" class="text-success">
                                            <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Novedad"></i>
                                        </a>
                                    </div>
                                    <div class="col-2">
                                        <form method="POST" action="{{route('elementos.novedades.destroy', [$elemento->id_elemento, $novedad->id_novedad])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0">
                                                <i class="far fa-trash-alt text-danger" data-toggle="tooltip" title="Eliminar novedad"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </x-data-table>
                </x-slot:body>

                <x-slot:footer>
                    <div class="float-right">
                        {{ $novedades->links() }}
                    </div>
                </x-slot:footer>

            </x-card>
        </div>
    </div>

</x-app-layout>
<x-message-confirm text="Desea eliminar la novedad" />