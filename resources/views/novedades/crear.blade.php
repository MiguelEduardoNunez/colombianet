<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Novedad') }}
    </x-slot>

    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('elementos.novedades.index', $elemento->id_elemento) }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <form method="POST" action="{{ route('elementos.novedades.store', $elemento->id_elemento) }}">
                @csrf
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Registrar Novedad')" class="text-center" />
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
                            <x-input-label :value="__('Tipos Novedades')" for="tipo_novedad" />
                            <x-select :elements="$tipos_novedades" identifier="id_tipo_novedad" label="tipo_novedad" id="tipo_novedad" name="tipo_novedad">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('tipo_novedad')" />
                        </div>


                        <div class="form-group">
                            <x-input-label :value="__('Empleados')" for="empleado" />
                            <x-select :elements="$empleados" identifier="id_empleado" label="nombres_completos" id="empleado" name="empleado">
                                <option selected disabled>{{ __('Seleccionar') }}</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('empleado')" />
                        </div>

                        
                        <div class="form-group">
                            <x-input-label :value="__('Novedad')" for="novedad" />
                            <x-text-area id="novedad" name="novedad" :value="old('novedad')" />
                            <x-input-error :messages="$errors->get('novedad')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Reporte')" for="fecha_reporte" />
                            <x-input-group id="fecha_reporte" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_reporte" :value="old('fecha_reporte')" data-target="#fecha_reporte" />
                                <x-slot:icon data-target="#fecha_reporte" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_reporte')" />
                        </div>

                        <div class="form-group">
                            <x-input-label :value="__('Fecha Cierre')" for="fecha_cierre" />
                            <x-input-group id="fecha_cierre" data-target-input="nearest">
                                <x-input type="text" class="datetimepicker-input" name="fecha_cierre"
                                    :value="old('fecha_cierre')" data-target="#fecha_cierre" />
                                <x-slot:icon data-target="#fecha_cierre" data-toggle="datetimepicker">
                                    <i class="fas fa-calendar text-primary"></i>
                                </x-slot:icon>
                            </x-input-group>
                            <x-input-error :messages="$errors->get('fecha_cierre')" />
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

<script>
    // Date picker
    $("#fecha_reporte, #fecha_cierre").datetimepicker({
        format: 'YYYY/MM/DD',
        locale: 'es'
    });

</script>