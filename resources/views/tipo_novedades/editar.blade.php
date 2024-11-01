<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Tipo de Novedad') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('tipo_novedades.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('tipo_novedades.update', $tipoNovedad->id_tipo_novedad) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Tipo de Novedad')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Tipo de Novedad')" for="tipo_novedad" />
                            <x-input type="text" id="tipo_novedad" name="tipo_novedad" :value="$tipoNovedad->tipo_novedad" />
                            <x-input-error :messages="$errors->get('tipo_novedad')" />
                        </div>
                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="$tipoNovedad->descripcion"/>
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