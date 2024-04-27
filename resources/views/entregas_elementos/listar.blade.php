<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Entregas de Elementos') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-auto d-none d-lg-flex">
                            <a href="{{ route('proyectos.index') }}">
                                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                            </a>
                        </div>
                        
                        <div class="col-10 col-md-7 col-lg-8">
                            <x-text :value="__('Gestionar Entregas de Elementos')" />
                        </div>

                        <div class="col-10 col-md-4 col-lg-3">
                            <x-input-group>
                                <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                <x-slot:icon>
                                    <i class="fas fa-search text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                        </div>

                        <div class="col-auto">
                            <a href="{{ route('proyectos.entregas-elementos.create', $proyecto->id_proyecto) }}">
                                <i class="fas fa-plus-circle fa-2x" data-toggle="tooltip" title="Registrar Entrega"></i>
                            </a>
                        </div>
                    </div>
                </x-slot:header>

                <x-slot:body class="table-responsive p-0" style="height: 400px;">
                    <x-data-table :headers="['#', 'Proyecto', 'Empleado', 'Fecha de Entrega', 'Acciones']">
                        @foreach ($entregas_elementos as $entrega_elemento)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proyecto->proyecto }}</td>
                                <td>{{ $entrega_elemento->empleado->empleado }}</td>
                                <td>{{ $entrega_elemento->fecha_entrega }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('proyectos.entregas-elementos.show', [$proyecto->id_proyecto, $entrega_elemento->id_entrega_elemento]) }}">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Entrega"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="#" class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Entrega"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="#" class="text-info">
                                                <i class="fas fa-tools" data-toggle="tooltip" title="Otros"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </x-slot:body>

                <x-slot:footer>
                    <div class="float-right">
                        {{ $entregas_elementos->links() }}
                    </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
