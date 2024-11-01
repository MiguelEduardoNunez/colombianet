<x-app-layout>

    <x-slot:page>
        {{ __('Gestionar Subcategorías') }}
    </x-slot>

    <div class="row">
        <div class="col-12">

            <x-card>

                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-auto d-none d-lg-flex">
                            <a href="{{ route('categorias.index') }}">
                                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                            </a>
                        </div>

                        <div class="col-10 col-md-7 col-lg-7">
                            <x-text :value="__('Gestionar Subcategorías')" />
                        </div>

                        <div class="col-10 col-md-4 col-lg-3 ml-auto">
                            <x-input-group>
                                <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                <x-slot:icon>
                                    <i class="fas fa-search text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('categorias.subcategorias.create', $categoria->id_categoria) }}">
                                <i class="fas fa-plus-circle fa-2x" data-toggle="tooltip" title="Crear Subcategoría"></i>
                            </a>

                        </div>

                        <div class="col-auto">
                            <a href="{{ route('categorias.subcategorias.createImport', $categoria->id_categoria) }}">
                                <i class="fas fa-file-excel fa-2x" data-toggle="tooltip" title="Importar Subcategorías"></i>
                            </a>
                        </div>

                    </div>
                </x-slot:header>

                <x-slot:body class="table-responsive p-0" style="height: 400px;">
                    <x-data-table :headers="['#', 'Subcategoría', 'Categoría', 'Acciones']">
                        @foreach ($subcategorias as $subcategoria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subcategoria->subcategoria }}</td>
                                <td>{{ $subcategoria->categoria->categoria }}</td>
                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href="{{ route('categorias.subcategorias.show', [$categoria->id_categoria, $subcategoria->id_subcategoria]) }}">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Subcategoría"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href="{{ route('categorias.subcategorias.edit',[$categoria->id_categoria, $subcategoria->id_subcategoria]) }}" class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Subcategoría"></i>
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <form method="POST" action="{{route('categorias.subcategorias.destroy', [$categoria->id_categoria, $subcategoria->id_subcategoria])}}">
                                              @csrf @method('DELETE')
                                              <button type="submit" class="btn p-0">
                                                <i
                                                  class="far fa-trash-alt text-danger"
                                                  data-toggle="tooltip"
                                                  title="Eliminar Subcategoría"
                                                ></i>
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
                            {{ $subcategorias->links() }}
                        </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar la subcategoría" />