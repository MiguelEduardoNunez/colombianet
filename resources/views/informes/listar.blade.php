<x-app-layout>

    <x-slot:page>
        {{ __('Informe Migraciones Proyecto Elementos') }}
    </x-slot>

    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-auto d-none d-lg-flex">
                            <a href="{{ route('dashboard') }}">
                                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                            </a>
                        </div>

                        <div class="col-10 col-md-7 col-lg-7">
                            <x-text :value="__('Informe Migraciones Proyecto Elementos')" />
                        </div>

                    </div>
                </x-slot:header>

                <x-slot:body class="table-responsive p-0" style="height: 400px;">
                    <x-data-table :headers="['#', 'Proyecto Origen', 'Proyecto Destino', 'Elemento', 'Cantidad']">
                        @foreach ($proyecto_elementos as $elemento)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $elemento->proyecto_origen }}</td>
                                <td>{{ $elemento->proyecto_destino }}</td>
                                <td>{{ $elemento->item}}</td>
                                <td>{{ $elemento->cantidad }}</td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </x-slot:body>
                <x-slot:footer>
                    <div class="float-right">
                    </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
