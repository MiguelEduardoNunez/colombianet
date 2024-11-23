<x-app-layout>
    <x-slot:page>
        {{ __('Detalles Empleado') }}
        </x-slot>
        <div class="row justify-content-center">
            <div class="col-1 d-none d-lg-flex">
                <a href="{{ route('empleados.index') }}">
                    <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                </a>
            </div>
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <x-card>
                    <x-slot:header>
                        <x-text :value="__('Detalles Empleado')" class="text-center" />
                    </x-slot:header>

                    <x-slot:body>
                        <!-- Información Personal -->
                        <div class="mb-5">
                            <h3 class="text-info">{{ __('Información Personal') }}</h3>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>{{ __('Nombres Completos') }}:</strong>{{ $empleado->nombres_completos }}</p>
                                    <p><strong>{{ __('Apellidos Completos') }}:</strong>{{ $empleado->apellidos_completos }}</p>
                                    <p><strong>{{ __('Tipo de Documento') }}:</strong>{{ $empleado->tipoDocumento->tipo_documento }}</p>
                                    <p><strong>{{ __('Lugar de expedición') }}:</strong>{{ $empleado->municipio->municipio }}</p>
                                    <p><strong>{{ __('Fecha de Expedición') }}:</strong> {{ $empleado->fecha_expedicion }}</p>
                                </div>

                                <div class="col-6">
                                    <p><strong>{{ __('Fecha de Nacimiento') }}:</strong> {{ $empleado->fecha_nacimiento }}</p>
                                    <p><strong>{{ __('Edad') }}:</strong> {{ $empleado->edad }}</p>
                                    <p><strong>{{ __('Tipo de Sangre') }}:</strong> {{ $empleado->tipo_sangre }}</p>
                                    <p><strong>{{ __('Alergias') }}:</strong> {{ $historia_clinica->alergias }}</p>
                                    <p><strong>{{ __('Enfermedades') }}:</strong> {{ $historia_clinica->enfermedades }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Información Laboral -->
                        <div class="mb-5">
                            <h3 class="text-info">{{ __('Información Laboral') }}</h3>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>{{ __('Cargo del Empleado') }}:</strong> {{ $empleado->cargoEmpleado->cargo_empleado }}</p>
                                    <p><strong>{{ __('Estado del Empleado') }}:</strong> {{ $empleado->estado }}</p>
                                    <p><strong>{{ __('Fecha de Inicio del Contrato') }}:</strong>{{ $empleado->fecha_inicio_contrato }}</p>
                                    <p><strong>{{ __('Nivel de Riesgo') }}:</strong> {{ $empleado->nivel_riesgo }}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>{{ __('Tipo de Contrato') }}:</strong>{{ $empleado->tipoContrato->tipo_contrato }}</p>
                                    <p><strong>{{ __('Nivel Educativo') }}:</strong>{{ $empleado->nivelEducativo->nivel_educativo }}</p>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0"><strong>{{ __('EPS') }}:</strong>{{ $empleado->eps->nombre_eps }}</p>
                                        <span class="ml-3">-</span>
                                        <a href="{{ asset('storage/' . $empleado->eps_pdf) }}" target="_blank" class="d-flex align-items-center btn btn-link"> {{ __('Ver Certificado') }}
                                            <i class="fas fa-file-pdf fa-1x text-primary ml-2"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0"><strong>{{ __('ARL') }}:</strong>{{ $empleado->arl->nombre_arl }}</p>
                                        <span class="ml-3">-</span>
                                        <a href="{{ asset('storage/' . $empleado->arl_pdf) }}" target="_blank" class="d-flex align-items-center btn btn-link"> {{ __('Ver Certificado') }}
                                            <i class="fas fa-file-pdf fa-1x text-primary ml-2"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Información Adicional -->
                        <div class="mb-5">
                            <h3 class="text-info">{{ __('Información Adicional') }}</h3>
                            <div class="row">
                                <div class="col-6">
                                    <p><strong>{{ __('Nombre del Contacto de Emergencia') }}:</strong>{{ $contacto_emergencia->nombre_acudiente }}</p>
                                    <p><strong>{{ __('Parentesco') }}:</strong>{{ $contacto_emergencia->parentesco_acudiente }}</p>
                                </div>
                                <div class="col-6">
                                    <p><strong>{{ __('Número de Contacto de Emergencia') }}:</strong>{{ $contacto_emergencia->telefono_acudiente }}</p>
                                </div>
                            </div>

                            <h3 class="mt-4 text-info">{{ __('Cursos Realizados') }}</h3>
                            @foreach ($cursos as $curso)
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $curso->nombre_curso }}</p>
                                <span class="ml-3">-</span>
                                @if ($curso->certificado_pdf)
                                <a href="{{ asset('storage/' . $curso->certificado_pdf) }}" target="_blank" class="btn btn-link">
                                    {{ __('Ver Certificado') }} <i class="fas fa-file-pdf fa-1x text-primary ml-2"></i>
                                </a>
                                @else
                                <span class="ml-3">{{ __('No hay certificado disponible') }}</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </x-slot:body>

                    <x-slot:footer></x-slot:footer>
                </x-card>
            </div>
        </div>
</x-app-layout>
