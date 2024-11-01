<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Stands') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8 col-lg-9">
                            <x-text :value="__('Gestionar Stands')" />
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
                    <x-data-table :headers="['#', 'Stand', 'Ubicación', 'Acciones']">
                        @foreach ($stands as $stand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $stand->stand }}</td>
                                <td>{{ $stand->ubicacion }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('stands.show', $stand->id_stand) }}">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Stand"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('stands.edit', $stand->id_stand) }}" class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Stand"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <form method="POST" action="{{ route('stands.destroy', $stand->id_stand) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-danger p-0">
                                                    <i class="far fa-trash-alt" data-toggle="tooltip" title="Eliminar Stand"></i>
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
                        {{ $stands->links() }}
                    </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar el stand" />
