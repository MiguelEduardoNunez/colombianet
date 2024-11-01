<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Perfiles') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8 col-lg-9">
                            <x-text :value="__('Gestionar Perfiles')" />
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
                    <x-data-table :headers="['#', 'Perfil', 'Acciones']">
                        @foreach ($perfiles as $perfil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $perfil->perfil }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('perfiles.show', $perfil->id_perfil) }}">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Perfil"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('perfiles.edit', $perfil->id_perfil) }}">
                                                <i class="far fa-edit text-success" data-toggle="tooltip" title="Actualizar Perfil"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('permisos.edit', $perfil->id_perfil) }}">
                                                <i class="fas fa-user-cog text-info" data-toggle="tooltip" title="Gestionar Permisos"></i>
                                            </a>
                                        </div>
                                        
                                        {{-- <div class="col-2">
                                            <form method="POST" action="#">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0">
                                                    <i class="far fa-trash-alt text-danger" data-toggle="tooltip" title="Eliminar Perfil"></i>
                                                </button>
                                            </form>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                </x-slot:body>

                <x-slot:footer>
                    <div class="float-right">
                        {{ $perfiles->links() }}
                    </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
