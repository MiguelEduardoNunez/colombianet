<x-app-layout>

    <x-slot:page>
        {{ __('Actualizar Subcategoria') }}
    </x-slot>

    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('categorias.subcategorias.index', $categoria->id_categoria) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form action="{{ route('categorias.subcategorias.update', [$categoria->id_categoria, $subcategoria->id_subcategoria]) }}" method="POST">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Subcategoria')" class="text-center" />
                    </x-slot>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Categoria')" for="categoria" />
                            <x-input type="text" id="categoria" name="categoria" :value="$categoria->categoria" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Subcategoria')" for="subcategoria" />
                            <x-input type="text" id="subcategoria" name="subcategoria" :value="$subcategoria->subcategoria" />
                            <x-input-error :messages="$errors->get('subcategoria')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripcion')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="$subcategoria->descripcion" />
                            <x-input-error :messages="$errors->get('descripcion')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Actualizar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>
