<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Proyecto') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('proyectos.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('proyectos.update', $proyecto->id_proyecto) }}">
                @csrf
                @method('PUT')
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Proyecto')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Proyecto')" for="proyecto" />
                            <x-input type="text" id="proyecto" name="proyecto" :value="$proyecto->proyecto" />
                            <x-input-error :messages="$errors->get('proyecto')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Descripción')" :obligatorio="false" for="descripcion" />
                            <x-text-area id="descripcion" name="descripcion" :value="$proyecto->descripcion" />
                            <x-input-error :messages="$errors->get('descripcion')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Inicio')" for="fecha_inicio" />
                            <x-input-group id="fecha_inicio" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_inicio" :value="$proyecto->fecha_inicio" data-target="#fecha_inicio" />
                                <x-slot:icon data-target="#fecha_inicio" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_inicio')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Fin')" for="fecha_fin" />
                            <x-input-group id="fecha_fin" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_fin" :value="$proyecto->fecha_fin" data-target="#fecha_fin" />
                                <x-slot:icon data-target="#fecha_fin" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_fin')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Responsable del Proyecto')" for="responsable_proyecto" />
                            <x-input type="text" id="responsable_proyecto" name="responsable_proyecto" :value="$proyecto->responsable_proyecto" />
                            <x-input-error :messages="$errors->get('responsable_proyecto')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Correo Electronico')" for="correo" />
                            <x-input type="email" id="correo" name="correo" :value="$proyecto->correo_responsable" />
                            <x-input-error :messages="$errors->get('correo')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Telefono')" :obligatorio="false" for="telefono" />
                            <x-input type="number" id="telefono" name="telefono" :value="$proyecto->telefono_responsable" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Dirección')" :obligatorio="false" for="direccion" />
                            <x-input type="text" id="direccion" name="direccion" :value="$proyecto->direccion_cliente" />
                            <x-input-error :messages="$errors->get('direccion')" />
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
