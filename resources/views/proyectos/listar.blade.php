<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Proyectos') }}
        </x-slot>
        <div class="row">
            <div class="col-12">
                <x-card>
                    <x-slot:header>
                        <div class="row align-items-center">
                            <div class="col-12 col-md-8 col-lg-9">
                                <x-text :value="__('Gestionar Proyectos')" />
                            </div>
                            <div class="col-12 col-md-4 col-lg-3">
                                <x-input-group>
                                    <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                    <x-slot:icon>
                                        <i class="fas fa-search text-primary"></i>
                                    </x-slot:icon>
                                </x-input-group>
                            </div>
                        </div>
                    </x-slot:header>

                    <x-slot:body class="table-responsive p-0" style="height: 400px;">
                        <x-data-table :headers="['#', 'Proyecto', 'Fecha Inicio', 'Fecha Fin', 'Responsable', 'Acciones']">
                            @foreach ($proyectos as $proyecto)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proyecto->proyecto }}</td>
                                <td>{{ $proyecto->fecha_inicio }}</td>
                                <td>{{ $proyecto->fecha_fin }}</td>
                                <td>{{ $proyecto->responsable_proyecto }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('proyectos.show', $proyecto->id_proyecto) }}">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Proyecto"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('proyectos.edit', $proyecto->id_proyecto) }}" class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Proyecto"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('proyectos.elementos.index', $proyecto->id_proyecto) }}" class="text-info">
                                                <i class="fas fa-tools" data-toggle="tooltip" title="Gestionar Elementos"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('proyectos.entregas-elementos.index', $proyecto->id_proyecto) }}" class="text-info">
                                                <i class="fas fa-truck-loading" data-toggle="tooltip" title="Gestionar Entregas"></i>
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
                            {{ $proyectos->links() }}
                        </div>
                    </x-slot:footer>
                </x-card>
            </div>
        </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar el proyecto" />
