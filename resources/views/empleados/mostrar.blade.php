<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Empleado') }}
    </x-slot>
    <div class="row">
        <div class="col-1 d-none d-lg-flex">
            <a href="{{ route('empleados.index') }}">
                <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
            </a>
        </div>
        <div class="col-12 col-md-10 col-lg-6 offset-md-1 offset-lg-2">
            <x-card>
                <x-slot:header>
                    <x-text :value="__('Detalles Empleado')" class="text-center" />
                </x-slot:header>

                <x-slot:body>
                    <x-text size="h6" color="black" :value="__('Nombres Completos')" />
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->nombres_completos" />

                    <x-text size="h6" color="black" :value="__('Apellidos Completos')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->apellidos_completos" />

                    <x-text size="h6" color="black" :value="__('Tipo de Documentos')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->tipoDocumento->tipo_documento" />

                    <x-text size="h6" color="black" :value="__('Lugar de expedicion')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->municipio->municipio" />

                    <x-text size="h6" color="black" :value="__('Fecha de Expedición')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->fecha_expedicion" />

                    <x-text size="h6" color="black" :value="__('Tipo de Sangre')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->tipo_sangre" />

                    <x-text size="h6" color="black" :value="__('Alergias')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$historia_clinica->alergias" />

                    <x-text size="h6" color="black" :value="__('Enfermedades')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$historia_clinica->enfermedades" />

                    <x-text size="h6" color="black" :value="__('Fecha de Nacimiento')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->fecha_nacimiento" />

                    <x-text size="h6" color="black" :value="__('Edad')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->edad" />

                    <x-text size="h6" color="black" :value="__('Número de Celular')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->telefono" />

                    <x-text size="h6" color="black" :value="__('Correo Electronico')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->email" />

                    <x-text size="h6" color="black" :value="__('Direccion')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->direccion" />

                    <x-text size="h6" color="black" :value="__('Estrato')" class="mt-4"/>
                    <x-text size="h6" style="font-weight-normal" color="black" :value="$empleado->estrato" />

                    <x-text size="h6" color="black" :value="__('Eps')" class="mt-4"/>
                    <a href="{{ asset('storage/' . $empleado->eps_pdf) }}" target="_blank">Ver Certificado EPS</a>

                    <x-text size="h6" color="black" :value="__('ARL')" class="mt-4"/>
                    <a href="{{ asset('storage/' . $empleado->arl_pdf) }}" target="_blank">Ver Certificado ARL</a>

              

                        

                </x-slot:body>

                <x-slot:footer>
                </x-slot:footer>
            </x-card>
        </div>
    </div>
</x-app-layout>
