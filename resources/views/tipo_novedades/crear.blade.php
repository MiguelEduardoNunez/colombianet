<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Tipo de Novedad') }}
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('tipo_novedades.store') }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Tipo de Novedad')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Tipo de Novedad')" for="tipo_novedad" />
                            <x-input type="text" id="tipo_novedad" name="tipo_novedad" :value="old('tipo_novedad')" />
                            <x-input-error :messages="$errors->get('tipo_novedad')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="old('descripcion')" />
                            <x-input-error :messages="$errors->get('descripcion')" />
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
