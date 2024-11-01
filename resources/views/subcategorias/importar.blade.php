<x-app-layout>

    <x-slot:page>
        {{ __('Importar Subcategorías') }}
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form action="{{ route('categorias.subcategorias.storeImport', $categoria->id_categoria) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Importar Subcategorías')" class="text-center" />
                    </x-slot>

                    <x-slot:body>
                        <div class="form-group mb-3">
                            <x-input-label :value="__('Archivo Excel')" for="archivo" />
                            <x-input type="file" id="archivo" name="archivo" :value="old('archivo')" />
                            <x-input-error :messages="$errors->get('archivo')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Importar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>