<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Usuario') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Usuario')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Perfil')" for="perfil" />
                            <x-select :elements="$perfiles" identifier="id_perfil" label="perfil" id="perfil" name="perfil">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('perfil')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Identificación')" for="identificacion" />
                            <x-input type="number" id="identificacion" name="identificacion" :value="old('identificacion')" />
                            <x-input-error :messages="$errors->get('identificacion')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Nombres')" for="nombres" />
                            <x-input type="text" id="nombres" name="nombres" :value="old('nombres')" />
                            <x-input-error :messages="$errors->get('nombres')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Telefono')" :obligatorio="false" for="telefono" />
                            <x-input type="number" id="telefono" name="telefono" :value="old('telefono')" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Correo Electronico')" for="email" />
                            <x-input type="email" id="email" name="email" :value="old('email')" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Contraseña')" for="password" />
                            <x-input type="password" id="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" />
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
