<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Categoria') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('categorias.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('categorias.update', $categoria->id_categoria) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Categoria')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Categoria')" for="categoria" />
                            <x-input type="text" id="categoria" name="categoria" :value="$categoria->categoria" />
                            <x-input-error :messages="$errors->get('categoria')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="$categoria->descripcion" />
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