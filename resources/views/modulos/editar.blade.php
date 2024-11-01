<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Modulo') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('modulos.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('modulos.update', $modulo->id_modulo) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Modulo')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Modulo Padre')" :obligatorio="false" for="modulo_padre" />
                            <x-select :elements="$modulos" identifier="id_modulo" label="modulo" id="modulo_padre" name="modulo_padre">
                                @if ($modulo->moduloPadre != null)
                                    <option value="{{ $modulo->modulo_id }}" selected>{{ $modulo->moduloPadre->modulo }}</option>
                                @else
                                    <option selected disabled>{{ __('Seleccionar') }}</option> 
                                @endif
                            </x-select>
                            <x-input-error :messages="$errors->get('modulo_padre')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Modulo')" for="modulo" />
                            <x-input type="text" id="modulo" name="modulo" :value="$modulo->modulo" />
                            <x-input-error :messages="$errors->get('modulo')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Ruta')" :obligatorio="false" for="ruta" />
                            <x-input type="text" id="ruta" name="ruta" :value="$modulo->ruta" />
                            <x-input-error :messages="$errors->get('ruta')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Icono')" for="icono" />
                            <x-input type="text" id="icono" name="icono" :value="$modulo->icono" />
                            <x-input-error :messages="$errors->get('icono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Orden')" for="orden" />
                            <x-input type="number" id="orden" name="orden" :value="$modulo->orden" />
                            <x-input-error :messages="$errors->get('orden')" />
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
