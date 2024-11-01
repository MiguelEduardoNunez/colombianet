<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Usuario') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('usuarios.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Usuario')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Perfil')" for="perfil" />
                            <x-select :elements="$perfiles" identifier="id_perfil" label="perfil" id="perfil" name="perfil">
                                <option value="{{ $usuario->perfil_id }}" selected>{{ $usuario->perfil->perfil }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('perfil')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Identificación')" for="identificacion" />
                            <x-input type="number" id="identificacion" name="identificacion" :value="$usuario->identificacion" />
                            <x-input-error :messages="$errors->get('identificacion')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Nombres')" for="nombres" />
                            <x-input type="text" id="nombres" name="nombres" :value="$usuario->nombres" />
                            <x-input-error :messages="$errors->get('nombres')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Telefono')" :obligatorio="false" for="telefono" />
                            <x-input type="number" id="telefono" name="telefono" :value="$usuario->telefono" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Correo Electronico')" for="email" />
                            <x-input type="email" id="email" name="email" :value="$usuario->email" />
                            <x-input-error :messages="$errors->get('email')" />
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
