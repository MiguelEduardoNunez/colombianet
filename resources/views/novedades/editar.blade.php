<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Novedad') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('elementos.novedades.index', $elemento->id_elemento) }}" type="button">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>

        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{route('elementos.novedades.update', [$elemento->id_elemento, $novedad->id_novedad])}}">
                @csrf
                @method('PUT')

                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Actualizar Novedad')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <div class="form-group">
                            <x-input-label :value="__('Proyecto')" for="proyecto" :obligatorio="false"/>
                            <x-input type="text" id="proyecto" name="proyecto" :value="$elemento->proyecto->proyecto" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Item')" for="elemento" :obligatorio="false"/>
                            <x-input type="text" id="elemento" name="elemento" :value="$elemento->item->item" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Marca')" for="elemento" :obligatorio="false"/>
                            <x-input type="text" id="elemento" name="elemento" :value="$elemento->marca" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Modelo')" for="elemento" :obligatorio="false"/>
                            <x-input type="text" id="elemento" name="elemento" :value="$elemento->modelo" disabled />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Tipo Novedad')" for="tipo_novedad" />
                            <x-select :elements="$tiposNovedades" identifier="id_tipo_novedad" label="tipo_novedad" id="tipo_novedad" name="tipo_novedad">
                                <option value="{{ $novedad->tipo_novedad_id }}" selected>{{ $novedad->tipoNovedad->tipo_novedad }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('tipo_novedad')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Empleado')" for="empleado" />
                            <x-select :elements="$empleados" identifier="id_empleado" label="empleado" id="empleado" name="empleado">
                                <option value="{{ $novedad->empleado_id }}" selected>{{ $novedad->empleado->empleado }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('empleado')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Novedad')" for="novedad" />
                            <x-text-area id="novedad" name="novedad" :value="$novedad->novedad" />
                            <x-input-error :messages="$errors->get('novedad')" />
                        </div>

                        {{-- <div class="form-group">
                            <x-input-label :value="__('Fecha Reporte')" for="fecha_reporte" />
                            <x-input type="text" id="fecha_reporte" name="fecha_reporte" :value="$novedad->fecha_reporte" />
                            <x-input-error :messages="$errors->get('fecha_reporte')" />
                        </div> --}}

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Reporte')" for="fecha_reporte" />
                            <x-input-group id="fecha_reporte" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_reporte" :value="$novedad->fecha_reporte" data-target="#fecha_reporte" />
                                <x-slot:icon data-target="#fecha_reporte" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_reporte')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Cierre')" for="fecha_cierre" />
                            <x-input-group id="fecha_cierre" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_cierre" :value="$novedad->fecha_cierre" data-target="#fecha_cierre" />
                                <x-slot:icon data-target="#fecha_cierre" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_cierre')" />
                        </div>


                        {{-- <div class="form-group">
                            <x-input-label :value="__('Fecha Cierre')" for="fecha_cierre" />
                            <x-input type="text" id="fecha_cierre" name="fecha_cierre" :value="$novedad->fecha_cierre" />
                            <x-input-error :messages="$errors->get('fecha_cierre')" />
                        </div> --}}

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