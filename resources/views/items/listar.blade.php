<x-app-layout>
    <x-slot:page>
        {{ __('Gestionar Items') }}
    </x-slot>
    <div class="row">
        <div class="col-12">
            <x-card>
                <x-slot:header>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-7 col-lg-8">
                            <x-text :value="__('Gestionar Items')" />
                        </div>
                        <div class="col-12 col-md-4 col-lg-3">
                            <x-input-group>
                                <x-input type="text" id="searchertable" name="searcher" placeholder="Buscar" />
                                <x-slot:icon>
                                    <i class="fas fa-search text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('items.createImport') }}">
                                <i class="fas fa-file-excel fa-2x" data-toggle="tooltip" title="Importar Items"></i>
                            </a>
                        </div>
                    </div>
                </x-slot:header>

                <x-slot:body class="table-responsive p-0 w-100 " style="height: 400px;">
                    <x-data-table :headers="['#', 'Item', 'Subcategoria', 'Acciones']">
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->item }}</td>
                                <td>{{ $item->subcategoria->subcategoria }}</td>

                                <td class="text-center">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-2">
                                            <a href=" {{ route('items.show', $item->id_item) }} ">
                                                <i class="far fa-eye" data-toggle="tooltip" title="Detalles Item"></i>
                                            </a>
                                        </div>

                                        <div class="col-2">
                                            <a href=" {{ route('items.edit', $item->id_item) }} " class="text-success">
                                                <i class="far fa-edit" data-toggle="tooltip" title="Actualizar Item"></i>
                                            </a>
                                        </div>
                                        <div class="col-2">
                                            <form method="POST" action="{{route('items.destroy', $item->id_item)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0">
                                                    <i class="far fa-trash-alt text-danger" data-toggle="tooltip" title="Eliminar Item"></i>
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
                        {{ $items->links() }} 
                    </div>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
<x-message-confirm text="Desea eliminar el item" />
