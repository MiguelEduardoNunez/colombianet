<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Elementos') }}
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

                            <div class="col-10 col-md-7 col-lg-7">
                                <x-text :value="__('Gestionar Elementos')" />
                            </div>

                            <div class="col-10 col-md-4 col-lg-3 ml-auto">
                                <x-input-group>
                                    <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                    <x-slot:icon>
                                        <i class="fas fa-search text-primary"></i>
                                    </x-slot:icon>
                                </x-input-group>
                            </div>

                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown">
                                    <i class="fas fa-plus-circle fa-2x text-primary"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('proyectos.elementos.create', $proyecto->id_proyecto) }}">
                                        <i class="fas fa-plus-circle text-primary mr-2"></i>Registrar Elemento
                                    </a>
                                    <a class="dropdown-item" href="{{ route('proyectos.elementos.pdf', $proyecto->id_proyecto) }}" target="_blank">
                                        <i class="fas fa-file-pdf text-primary mr-2"></i>Generar PDF
                                    </a>
                                    <a class="dropdown-item" href="{{ route('proyectos.migrar.elementos', $proyecto->id_proyecto)}}">
                                        <i class="fas fa-share text-primary mr-2"></i>Migrar Elementos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('elementos.createImport', $proyecto->id_proyecto) }}">
                                        <i class="fas fa-file-excel text-primary mr-2"></i>Importar Excel
                                    </a>

                                    {{-- @if($proyecto->proyecto == 'Colombianet') --}}
                                    <a class="dropdown-item" href="{{ route('entrada_elementos.index', $proyecto->id_proyecto) }}">
                                        <i class="fas fa-arrow-circle-down text-primary mr-2"></i>Registrar Entrada de Elementos
                                    </a>
                                    {{-- @endif --}}


                                    </a>

                                </div>
                            </div>
                        </div>
                    </x-slot:header>

                    <x-slot:body class="table-responsive p-0" style="height: 400px;">
                        <x-data-table :headers="['#', 'Proyecto', 'Elemento', 'Serial',  'Tipo Cantidad', 'Cantidad', 'Acciones']">
                            @foreach ($elementos as $elemento)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proyecto->proyecto }}</td>
                                <td>{{ $elemento->item->item }}</td>
                                <td>{{ $elemento->serial }}</td>
                                <td>{{ $elemento->tipoCantidad->tipo_cantidad }}</td>
                                @if ($elemento->cantidad > 5 && $elemento->cantidad <= 10) <td><span class="badge badge-pill badge-warning">{{ $elemento->cantidad }}</span></td>
                                    @elseif ($elemento->cantidad <= 5) <td><span class="badge badge-pill badge-danger">{{ $elemento->cantidad }}</span></td>
                                        @else
                                        <td><span class="badge badge-pill badge-success">{{ $elemento->cantidad
                                                }}</span></td>
                                        @endif
                                        <td class="text-center d-flex justify-content-center ">
                                            <div class="row d-flex justify-content-center ">
                                                <div class="col-4">
                                                    <a href="{{ route('proyectos.elementos.show', [$proyecto->id_proyecto, $elemento->id_elemento]) }}">
                                                        <i class="far fa-eye" data-toggle="tooltip" title="Detalles Elemento"></i>
                                                    </a>
                                                </div>

                                                <div class="col-4 ">
                                                    <a href="{{ route('proyectos.elementos.edit', [$proyecto->id_proyecto, $elemento->id_elemento]) }}" class="text-success">
                                                        <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Elemento"></i>
                                                    </a>
                                                </div>

                                                <div class="col-4 ">
                                                    <a href="{{ route('elementos.novedades.index', $elemento->id_elemento) }}" class="text-info">
                                                        <i class="fas fa-tools" data-toggle="tooltip" title="Gestionar Novedades"></i>
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
                            {{ $elementos->links() }}
                        </div>
                    </x-slot:footer>
                </x-card>
            </div>
        </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar el elemento" />
