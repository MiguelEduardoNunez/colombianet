<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Modulo') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('modulos.store') }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Modulo')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Modulo Padre')" :obligatorio="false" for="modulo_padre" />
                            <x-select :elements="$modulos" identifier="id_modulo" label="modulo" id="modulo_padre" name="modulo_padre">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('modulo_padre')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Modulo')" for="modulo" />
                            <x-input type="text" id="modulo" name="modulo" :value="old('modulo')" />
                            <x-input-error :messages="$errors->get('modulo')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Ruta')" :obligatorio="false" for="ruta" />
                            <x-input type="text" id="ruta" name="ruta" :value="old('ruta')" />
                            <x-input-error :messages="$errors->get('ruta')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Icono')" for="icono" />
                            <x-input type="text" id="icono" name="icono" :value="old('icono')" />
                            <x-input-error :messages="$errors->get('icono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Orden')" for="orden" />
                            <x-input type="number" id="orden" name="orden" :value="old('orden')" />
                            <x-input-error :messages="$errors->get('orden')" />
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
