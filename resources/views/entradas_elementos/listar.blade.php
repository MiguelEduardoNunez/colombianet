<x-app-layout>
    <x-slot name="page">
        {{ __('Entrada de Elementos') }}
    </x-slot>

    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot name="header">
                    <div class="row align-items-center">
                        <div class="col-auto d-none d-lg-flex">
                            <a href="{{ route('proyectos.elementos.index', $proyecto->id_proyecto) }}">
                                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                            </a>
                        </div>

                        <div class="col-10 col-md-7 col-lg-7">
                            <x-text :value="__('Entrada de Elementos')" />
                        </div>

                        <div class="col-12 col-md-4 col-lg-3">
                            <x-input-group>
                                <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                <x-slot:icon>
                                    <i class="fas fa-search text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('entrada_elementos.create', ['id_proyecto' => $proyecto->id_proyecto]) }}">
                                <i class="fas fa-plus-circle fa-2x" data-toggle="tooltip" title="Registrar Entrega"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="#">
                                <i class="fas fa-file-excel fa-2x" data-toggle="tooltip" title="Importar Entregas"></i>
                            </a>
                        </div>
                    </div>
                </x-slot>

                <x-slot name="body" class="table-responsive p-0" style="height: 400px;">
                    <x-data-table :headers="['#', 'Proyecto', 'Elemento', 'Cantidad', 'Fecha Registro', 'Acciones']">
                        @foreach ($entradas as $entrada)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $entrada->proyecto->proyecto }}</td>
                            <td>{{ $entrada->elemento->item->item }}</td>
                            <td>{{ $entrada->cantidad }}</td>
                            <td>{{ $entrada->creado_en }}</td>
                            <td class="text-center">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-2">
                                        <a href="{{ route('entrada_elementos.show', ['id_proyecto' => $proyecto->id_proyecto, 'id_entrada_elementos' => $entrada->id_entrada_elementos]) }}">
                                            <i class="far fa-eye" data-toggle="tooltip" title="Detalles entrega"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </x-data-table>
                </x-slot>

                <x-slot name="footer">
                </x-slot>
            </x-card>
        </div>
    </div>
</x-app-layout>
