<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Proyecto') }}
    </x-slot>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6">
            <form method="POST" action="{{ route('proyectos.store') }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Proyecto')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Proyecto')" for="proyecto" />
                            <x-input type="text" id="proyecto" name="proyecto" :value="old('proyecto')" />
                            <x-input-error :messages="$errors->get('proyecto')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="old('descripcion')" />
                            <x-input-error :messages="$errors->get('descripcion')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Inicio')" for="fecha_inicio" />
                            <x-input-group id="fecha_inicio" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_inicio" :value="old('fecha_inicio')" data-target="#fecha_inicio" />
                                <x-slot:icon data-target="#fecha_inicio" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_inicio')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Fin')" for="fecha_fin" />
                            <x-input-group id="fecha_fin" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_fin" :value="old('fecha_fin')" data-target="#fecha_fin" />
                                <x-slot:icon data-target="#fecha_fin" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_fin')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Responsable del Proyecto')" for="responsable_proyecto" />
                            <x-input type="text" id="responsable_proyecto" name="responsable_proyecto" :value="old('responsable_proyecto')" />
                            <x-input-error :messages="$errors->get('responsable_proyecto')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Correo Electronico')" for="correo" />
                            <x-input type="email" id="correo" name="correo" :value="old('correo')" />
                            <x-input-error :messages="$errors->get('correo')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Telefono')" :obligatorio="false" for="telefono" />
                            <x-input type="number" id="telefono" name="telefono" :value="old('telefono')" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Dirección')" :obligatorio="false" for="direccion" />
                            <x-input type="text" id="direccion" name="direccion" :value="old('direccion')" />
                            <x-input-error :messages="$errors->get('direccion')" />
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
