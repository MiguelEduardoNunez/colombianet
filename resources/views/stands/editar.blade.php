<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Stand') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('stands.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('stands.update', $stand->id_stand) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Stand')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Stand')" for="stand" />
                            <x-input type="text" id="stand" name="stand" :value="$stand->stand" />
                            <x-input-error :messages="$errors->get('stand')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Ubicación')" for="ubicacion" />
                            <x-input type="text" id="ubicacion" name="ubicacion" :value="$stand->ubicacion" />
                            <x-input-error :messages="$errors->get('ubicacion')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="$stand->descripcion" />
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
