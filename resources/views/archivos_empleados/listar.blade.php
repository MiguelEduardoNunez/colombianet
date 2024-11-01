<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Documentos de los Empleados') }}
    </x-slot>

    <x-card>
        <x-slot:header>
            <div class="row align-items-center">
                <div class="col-1 d-none d-lg-flex">
                    <a href="{{ route('empleados.index') }}">
                        <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                    </a>
                </div>

                <div class="col-11 col-md-8 col-lg-8">
                    <x-text :value="__('Gestionar Documentos de los Empleados')" />
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

        <x-slot:body>
            <x-data-table :headers="['#', 'Nombre del Archivo', 'Estado', 'Última Actualización', 'Acciones']">
                @foreach ($documentos as $documento)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $documento['nombre_documento'] }}</td>
                        <td>
                            <span class="badge {{ $documento['estado'] == 'Subido' ? 'badge-success' : 'badge-danger' }}">
                                {{ $documento['estado'] }}
                            </span>
                        </td>
                        <td>{{ $documento['actualizado_en'] }}</td>

                        <td class="text-center">
                            <div class="row justify-content-center align-items-center">

                                <div class="col-4">
                                    <a href="{{ asset('storage/' . ($documento['ruta'])) }}" target="_blank">
                                        <i class="far fa-eye" data-toggle="tooltip" title="Ver Archivo"></i>
                                    </a>
                                </div>

                                <div class="col-4">
                                    <form action="{{ route('empleados.archivos.subir', ['id_empleado' => $id_empleado, 'tipo_archivo_id' => $documento['id_tipo_archivo']]) }}"
                                          method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="archivo" style="display: none;" onchange="this.form.submit()">
                                        <a href="#" onclick="this.previousElementSibling.click()">
                                            <i class="fas fa-file-upload text-success" data-toggle="tooltip" title="Subir Archivo"></i>
                                        </a>
                                    </form>
                                </div>

                                <div class="col-4">
                                    <a href="{{ route('empleados.archivos.historial', ['id_empleado' => $id_empleado, 'id_documento' => $documento['id_tipo_archivo']]) }}">
                                        <i class="fas fa-clipboard-list" data-toggle="tooltip" title="Historial de Archivo"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </x-slot:body>

        <x-slot:footer>
        </x-slot:footer>
    </x-card>
</x-app-layout>
