<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Tipo de Novedades') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-8 col-lg-9">
                            <x-text :value="__('Gestionar Tipo de Novedades')" />
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
                    <x-data-table :headers="['#', 'Tipo de Novedad', 'Acciones']">
                        @foreach ($tipoNovedades as $tipo_novedad)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tipo_novedad->tipo_novedad }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('tipo_novedades.show', $tipo_novedad->id_tipo_novedad) }}">
                                                <i class="far fa-eye "  data-toggle="tooltip" title="Detalles Tipo Novedad"></i>
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('tipo_novedades.edit', $tipo_novedad->id_tipo_novedad) }}" class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Tipo Novedad"></i>
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <form method="POST" action="{{route('tipo_novedades.destroy', $tipo_novedad->id_tipo_novedad)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0">
                                                    <i class="far fa-trash-alt text-danger" data-toggle="tooltip" title="Eliminar Tipo Novedad"></i>
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
                            {{ $tipoNovedades->links() }}
                        </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar el tipo de novedad" />
