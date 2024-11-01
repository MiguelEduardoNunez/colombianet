<x-app-layout>
    <x-slot:page>
        {{ __('Historial del Archivo') }}
    </x-slot>

    <x-card>
        <x-slot:header>
            <div class="row align-items-center">
                <div class="col-1 d-none d-lg-flex">
                    <a href="{{ route('empleados.archivos', ['id_empleado' => $id_empleado]) }}">
                        <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                    </a>
                </div>

                <div class="col-11">
                    <x-text :value="__('Historial de Actualizaciones del Archivo')" />
                </div>
            </div>
        </x-slot:header>

        <x-slot:body>
            <x-data-table :headers="['Archivo', 'Nombre del Archivo', 'Fecha', 'Acción']">
                @foreach ($historial as $registro)
                    <tr>
                        <td>{{ $tipo_archivo->nombre_documento }}</td>
                        <td>{{ basename($registro->archivo_empleado_pdf) }}</td>
                        <td>{{ $registro->actualizado_en }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $registro->archivo_empleado_pdf) }}" target="_blank">
                                <i class="far fa-eye" data-toggle="tooltip" title="Ver Archivo"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </x-data-table>
        </x-slot:body>

        <x-slot:footer>
        </x-slot:footer>
    </x-card>
</x-app-layout>