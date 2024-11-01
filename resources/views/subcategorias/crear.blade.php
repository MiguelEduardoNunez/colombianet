<x-app-layout>

    <x-slot:page>
        {{ __('Registrar Subcategoria') }}
    </x-slot>

    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('categorias.subcategorias.index', $categoria->id_categoria) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('categorias.subcategorias.store',$categoria->id_categoria)}}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Subcategoria')" class="text-center" />
                    </x-slot>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Categoria')" for="categoria" />
                            <x-input type="text" id="categoria" name="categoria" :value="$categoria->categoria" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Subcategoria')" for="subcategoria" />
                            <x-input type="text" id="subcategoria" name="subcategoria" :value="old('subcategoria')" />
                            <x-input-error :messages="$errors->get('subcategoria')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripcion')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="old('descripcion')" />
                        </div>
                    </x-slot:body>

                    <x-slot:footer>
                        <x-button type="submit">
                            {{ __('Registrar') }}
                        </x-button>
                    </x-slot:footer>
                </x-card>
            </form>
        </div>
    </div>
</x-app-layout>
