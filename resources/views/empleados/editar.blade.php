<x-app-layout>
    <x-slot:page>
        {{ __('Actualizar Empleado') }}
        </x-slot>

        <div class="row justify-content-center">
            <div class="col-1 d-none d-lg-flex">
                <a href="{{ route('empleados.index') }}">
                    <i class="far fa-arrow-alt-circle-left fa-2x" data-toggle="tooltip" title="Regresar"></i>
                </a>
            </div>
            <div class="col-12 col-md-10 col-lg-8 mx-auto">
                <form method="POST" action="{{ route('empleados.update', $empleado->id_empleado) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <x-card>
                        <x-slot:header>
                            <x-text :value="__('Actualizar Empleado')" class="text-center" />
                        </x-slot:header>

                        <x-slot:body>
                            <ul class="nav nav-tabs" id="empleadoTab">
                                <li class="nav-item">
                                    <a class="nav-link active" id="datos-personales-tab" data-toggle="tab" href="#datos-personales" role="tab" aria-controls="datos-personales" aria-selected="true">Información Personal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="informacion-laboral-tab" data-toggle="tab" href="#informacion-laboral" role="tab" aria-controls="informacion-laboral" aria-selected="false">Información Laboral</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="informacion-adicional-tab" data-toggle="tab" href="#informacion-adicional" role="tab" aria-controls="informacion-adicional" aria-selected="false">Información Adicional</a>
                                </li>
                            </ul>

                            {{-- Apartados del formulario --}}
                            <div class="tab-content" id="empleadoTabContent">
                                {{-- Información personal del Empleado --}}
                                <div class="tab-pane fade show active form-section" id="datos-personales" role="tabpanel" aria-labelledby="datos-personales-tab">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nombres Completos')" for="nombres_completos" :obligatorio=false />
                                            <x-input type="text" id="nombres_completos" name="nombres_completos" :value="$empleado->nombres_completos" />
                                            <x-input-error :messages="$errors->get('nombres_completos')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Apellidos Completos')" for="apellidos_completos" :obligatorio=false />
                                            <x-input type="text" id="apellidos_completos" name="apellidos_completos" :value="$empleado->apellidos_completos" />
                                            <x-input-error :messages="$errors->get('apellidos_completos')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Documento')" for="tipo_documento" :obligatorio=false />
                                            <x-select :elements="$tipos_documentos" identifier="id_tipo_documento" label="tipo_documento" id="tipo_documento" name="tipo_documento">
                                                <option value="{{ $empleado->tipo_documento_id }}" selected>{{ $empleado->tipoDocumento->tipo_documento }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo_documento')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Identificación')" for="documento" :obligatorio=false />
                                            <x-input type="text" id="documento" name="documento" :value="$empleado->documento" />
                                            <x-input-error :messages="$errors->get('documento')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Departamento')" for="departamento" :obligatorio=false />
                                            <x-select :elements="$departamentos" identifier="id_departamento" label="departamento" id="departamento" name="departamento">
                                                <option value="{{ $empleado->municipio->departamento->departamento }}" selected> {{ $empleado->municipio->departamento->departamento }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('departamento')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Lugar de Expedición del Documento ')" for="municipio" :obligatorio=false />
                                            <x-select :elements="$municipios" identifier="id_municipio" label="municipio" id="municipio" name="municipio">
                                                <option value="{{ $empleado->municipio->id_municipio }}" selected>{{ $empleado->municipio->municipio }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('municipio')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Expedición')" for="fecha_expedicion" :obligatorio=false />
                                            <x-input type="date" id="fecha_expedicion" name="fecha_expedicion" :value="$empleado->fecha_expedicion" />
                                            <x-input-error :messages="$errors->get('fecha_expedicion')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Sangre')" for="tipo_sangre" :obligatorio=false />
                                            <x-select :elements="$tipos_sangre" identifier="id_tipo_sangre" label="tipo_sangre" id="tipo_sangre" name="tipo_sangre">
                                                <option value="{{ $empleado->tipo_sangre }}" selected> {{ $empleado->tipo_sangre }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo_sangre')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Alergias')" for="alergias" :obligatorio=false />
                                            <x-input type="text" id="alergias" name="alergias" :value="$historia_clinica->alergias" />
                                            <x-input-error :messages="$errors->get('alergias')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Enfermedades')" for="enfermedades" :obligatorio=false />
                                            <x-input type="text" id="enfermedades" name="enfermedades" :value="$historia_clinica->enfermedades" />
                                            <x-input-error :messages="$errors->get('enfermedades')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Nacimiento')" for="fecha_nacimiento" :obligatorio=false />
                                            <x-input type="date" id="fecha_nacimiento" name="fecha_nacimiento" :value="$empleado->fecha_nacimiento" />
                                            <x-input-error :messages="$errors->get('fecha_nacimiento')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Edad')" for="edad" :obligatorio=false />
                                            <x-input type="text" id="edad" name="edad" :value="$empleado->edad" />
                                            <x-input-error :messages="$errors->get('edad')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Celular')" for="telefono" :obligatorio=false />
                                            <x-input type="text" id="telefono" name="telefono" :value="$empleado->telefono" />
                                            <x-input-error :messages="$errors->get('telefono')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Correo Electrónico')" for="email" :obligatorio=false />
                                            <x-input type="text" id="email" name="email" :value="$empleado->email" />
                                            <x-input-error :messages="$errors->get('email')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Dirección de Residencia')" for="direccion" :obligatorio=false />
                                            <x-input type="text" id="direccion" name="direccion" :value="$empleado->direccion" />
                                            <x-input-error :messages="$errors->get('direccion')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Estrato Socioeconómico')" for="estrato" :obligatorio=false />
                                            <x-input type="text" id="estrato" name="estrato" :value="$empleado->estrato" />
                                            <x-input-error :messages="$errors->get('estrato')" />
                                        </div>
                                        <x-button type="button" id="btn-next-1" onclick="nextTab(1)">
                                            {{ __('Siguiente') }}
                                        </x-button>
                                    </div>
                                </div>
                                {{-- Información Larobal --}}
                                <div class="tab-pane fade form-section" id="informacion-laboral" role="tabpanel" aria-labelledby="informacion-laboral-tab">
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Cargo del Empleado')" for="cargo_empleado" :obligatorio=false />
                                            <x-select :elements="$cargos_empleados" identifier="id_cargo_empleado" label="cargo_empleado" id="cargo_empleado" name="cargo_empleado">
                                                <option value="{{ $empleado->cargo_empleado_id }}" selected> {{ $empleado->cargoEmpleado->cargo_empleado }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('cargo_empleado')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Estado del empleado')" for="estado" :obligatorio=false />
                                            <x-select :elements="$estados" identifier="id_estado" label="estado" id="estado" name="estado">
                                                <option value="{{ $empleado->estado }}" selected> {{ $empleado->estado }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('estado')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha inicio del Contrato')" for="fecha_inicio_contrato" :obligatorio=false />
                                            <x-input type="date" id="fecha_inicio_contrato" name="fecha_inicio_contrato" :value="$empleado->fecha_inicio_contrato" />
                                            <x-input-error :messages="$errors->get('fecha_inicio_contrato')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Inicio del Periodo de Prueba')" for="fecha_periodo_prueba" :obligatorio=false />
                                            <x-input type="date" id="fecha_periodo_prueba" name="fecha_periodo_prueba" :value="$empleado->fecha_periodo_prueba ?? ''" />
                                            @if (!$empleado->fecha_periodo_prueba)
                                                <small class="text-muted">No hay fecha registrada</small>
                                            @endif
                                            <x-input-error :messages="$errors->get('fecha_periodo_prueba')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Finalización del Contrato')" for="fecha_fin_contrato" :obligatorio=false />
                                            <x-input type="date" id="fecha_fin_contrato" name="fecha_fin_contrato" :value="$empleado->fecha_fin_contrato ?? ''" />
                                            @if (!$empleado->fecha_fin_contrato)
                                                <small class="text-muted">No hay fecha registrada</small>
                                            @endif
                                            <x-input-error :messages="$errors->get('fecha_fin_contrato')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Contrato')" for="tipo_contrato" :obligatorio=false />
                                            <x-select :elements="$tipos_contratos" identifier="id_tipo_contrato" label="tipo_contrato" id="tipo_contrato" name="tipo_contrato">
                                                <option value="{{ $empleado->tipo_contrato_id }}" selected> {{ $empleado->tipoContrato->tipo_contrato }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo_contrato')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nivel Educativo')" for="nivel_educativo" :obligatorio=false />
                                            <x-select :elements="$niveles_educativos" identifier="id_nivel_educativo" label="nivel_educativo" id="nivel_educativo" name="nivel_educativo">
                                                <option value="{{ $empleado->nivel_educativo_id }}" selected> {{ $empleado->nivelEducativo->nivel_educativo }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('nivel_educativo')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('ARL')" for="arl" :obligatorio=false />
                                            <x-select :elements="$arls" identifier="id_arl" label="nombre_arl" id="arl" name="arl">
                                                <option value="{{ $empleado->arl_id }}" selected> {{ $empleado->arl->nombre_arl }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('arl')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Certificado ARL en PDF')" for="arl_pdf" :obligatorio=false />
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="arl_pdf" name="arl_pdf">
                                                    <label class="custom-file-label" for="arl_pdf">{{ $empleado->arl_pdf ? 'Cambiar archivo' : 'Seleccionar archivo' }}</label>
                                                </div>
                                            </div>
                                            @if($empleado->arl_pdf)
                                                <div class="mt-3">
                                                    <p>Archivo actual:
                                                        <a href="{{ asset('storage/' . $empleado->arl_pdf) }}" target="_blank">
                                                            <i class="fas fa-file-pdf fa-1x text-primary"></i><span>
                                                        </a>
                                                    </p>
                                                </div>
                                            @else
                                            <p>No hay un archivo cargado actualmente</p>
                                            @endif
                                            <x-input-error :messages="$errors->get('arl_pdf')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nivel de Riesgo')" for="nivel_riesgo" :obligatorio=false />
                                            <x-input type="number" id="nivel_riesgo" name="nivel_riesgo" :value="$empleado->nivel_riesgo" />
                                            <x-input-error :messages="$errors->get('nivel_riesgo')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('EPS')" for="eps" :obligatorio=false />
                                            <x-select :elements="$eps" identifier="id_eps" label="nombre_eps" id="eps" name="eps">
                                                <option value="{{ $empleado->eps_id }}" selected> {{ $empleado->eps->nombre_eps }} </option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('eps')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Certificado EPS en PDF')" for="eps_pdf" :obligatorio=false />
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="eps_pdf" name="eps_pdf">
                                                    <label class="custom-file-label" for="eps_pdf">Seleccionar archivo</label>
                                                </div>
                                            </div>
                                            @if($empleado->eps_pdf)
                                                <div class="mt-2">
                                                    <p>Archivo actual:
                                                        <a href="{{ asset('storage/' . $empleado->eps_pdf) }}" target="_blank">
                                                            <i class="fas fa-file-pdf fa-1x text-primary"></i><span>
                                                        </a>
                                                    </p>
                                                </div>
                                            @else
                                            <p>No hay un archivo cargado actualmente</p>
                                            @endif
                                            <x-input-error :messages="$errors->get('eps_pdf')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fondo de Pensión')" for="fondo_pension" :obligatorio=false />
                                            <x-select :elements="$fondos_pensiones" identifier="id_fondo_pension" label="fondo_pension" id="fondo_pension" name="fondo_pension">
                                                <option value="{{ $empleado->fondo_pension_id }}" selected> {{ $empleado->fondoPension->fondo_pension }} </option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('fondo_pension')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fondo de Cesantía')" for="fondo_cesantia" :obligatorio=false />
                                            <x-select :elements="$fondos_cesantias" identifier="id_fondo_cesantia" label="fondo_cesantia" id="fondo_cesantia" name="fondo_cesantia">
                                                <option value="{{ $empleado->fondo_cesantia_id }}" selected> {{ $empleado->fondoCesantia->fondo_cesantia }} </option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('fondo_cesantia')" />
                                        </div>
                                    </div>
                                    <x-button type="button" id="btn-next-2" onclick="nextTab(2)">
                                        {{ __('Siguiente') }}
                                    </x-button>
                                </div>

                                <div class="tab-pane fade form-section" id="informacion-adicional" role="tabpanel" aria-labelledby="informacion-adicional-tab">
                                    <div class="form-row">
                                        {{-- Información del Acudiente --}}
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nombre del Contacto de Emergencia')" for="nombre_acudiente" :obligatorio=false />
                                            <x-input type="text" id="nombre_acudiente" name="nombre_acudiente" :value="$contacto_emergencia->nombre_acudiente" />
                                            <x-input-error :messages="$errors->get('nombre_acudiente')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Parentesco')" for="parentesco_acudiente" :obligatorio=false />
                                            <x-input type="text" id="parentesco_acudiente" name="parentesco_acudiente" :value="$contacto_emergencia->parentesco_acudiente" />
                                            <x-input-error :messages="$errors->get('parentesco_acudiente')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Contacto de Emergencia')" for="telefono_acudiente" :obligatorio=false />
                                            <x-input type="number" id="telefono_acudiente" name="telefono_acudiente" :value="$contacto_emergencia->telefono_acudiente" />
                                            <x-input-error :messages="$errors->get('telefono_acudiente')" />
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- Campos Base para Cursos --}}
                                    <x-input-label :value="__('Cursos Realizados')" for="Cursos Realizados" :obligatorio=false />

                                    <div id="cursos-container" class="row">
                                        @foreach ($cursos as $curso)
                                        <div class="curso-item col-md-6 mb-3">
                                            <!-- Mostrar el ícono de PDF o un mensaje si no hay archivo -->
                                            @isset($curso->certificado_pdf)
                                                <div class="d-flex align-items-center mb-2">
                                                    <p class="mb-0 mr-2">Archivo actual:</p>
                                                    <p class="mb-0 font-weight-bold mr-2">{{ $curso->nombre_curso }}</p>
                                                    <a href="{{ asset('storage/' . $curso->certificado_pdf) }}" target="_blank" class="d-flex align-items-center">
                                                        <i class="fas fa-file-pdf fa-1x text-primary"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <p class="text-muted">{{ __('No hay certificado disponible') }}</p>
                                            @endisset

                                            <!-- Campo para subir un nuevo certificado -->
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="certificado_curso_pdf_{{ $curso->id_curso }}" name="certificado_curso_pdf[{{ $curso->id_curso }}]">
                                                    <label class="custom-file-label" for="certificado_curso_pdf_{{ $curso->id_curso }}">Seleccionar otro archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div id="nuevo-curso-container" class="row mb-4">
                                        <label for="nuevo_curso" class="col-md-12">{{ __('Agregar nuevo curso') }}</label>
                                        <div class="nuevo-curso-item col-md-6 mb-4">
                                            <input type="text" name="nuevo_curso[]" class="form-control mb-2" placeholder="Nombre del curso">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="nuevo_certificado_pdf_0" name="nuevo_certificado_pdf[]">
                                                    <label class="custom-file-label" for="nuevo_certificado_pdf_0">Seleccionar archivo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" id="add-curso" class="btn btn-primary">Agregar otro curso</button>

                                    <x-button type="submit" class="mt-3">
                                        {{ __('Actualizar ') }}
                                    </x-button>
                                </div>
                            </div>
                        </x-slot:body>

                        <x-slot:footer>
                        </x-slot:footer>
                    </x-card>
                </form>
            </div>
        </div>
</x-app-layout>

<script>
    $(function() {
        var municipios = {{ Js::from($municipios) }};
        $("#departamento").on("change", function() {
            $("#municipio").empty();
            $("#municipio").prepend("<option selected disabled>Seleccionar</option>");

            var departamento = $(this).val();
            const resultado = municipios.filter(function(municipio) {
                return municipio.departamento_id == departamento;
            });
            resultado.forEach(function(res) {
                $("#municipio").append("<option value='" + res.id_municipio + "'>" + res
                    .municipio + "</option>");
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('certificado_curso_pdf');
        const fileLabel = document.querySelector('label[for="certificado_curso"]');

        fileInput.addEventListener('change', function() {
            const files = fileInput.files;
            const fileNames = Array.from(files).map(file => file.name).join(', ');
            fileLabel.textContent = files.length > 0 ? fileNames : 'Seleccionar archivos';
        });
    });
    let currentSection = 1;

    function nextTab(currentTab) {
        let nextTabId;

        if (currentTab === 1) {
            nextTabId = '#informacion-laboral-tab';
        } else if (currentTab === 2) {
            nextTabId = '#informacion-adicional-tab';
        }

        $(nextTabId).tab('show');
    }

    function actualizarNombreArchivo(input) {
        input.addEventListener('change', function() {
            let fileName = this.files[0] ? this.files[0].name : 'Seleccionar archivos';
            this.nextElementSibling.innerHTML = fileName;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar el primer input de archivo base existente
        const primerInputArchivo = document.querySelector('#nuevo_certificado_pdf_0');

        // Verificar si existe y asignarle el evento de cambio
        if (primerInputArchivo) {
            actualizarNombreArchivo(primerInputArchivo);
        }

        // Para los inputs dinámicos que se agreguen
        document.getElementById('add-curso').addEventListener('click', function() {
            const nuevoCursoContainer = document.createElement('div');
            nuevoCursoContainer.classList.add('nuevo-curso-item', 'mb-4', 'col-md-6');

            // Obtener el índice para identificar cada nuevo input
            let index = document.querySelectorAll('.nuevo-curso-item').length;

            // Crear los campos de entrada para el nuevo curso
            nuevoCursoContainer.innerHTML = `
            <input type="text" name="nuevo_curso[]" class="form-control mb-2" placeholder="Nombre del curso">

            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="nuevo_certificado_pdf_${index}" name="nuevo_certificado_pdf[]">
                    <label class="custom-file-label" for="nuevo_certificado_pdf_${index}">Seleccionar archivo</label>
                </div>
            </div>
        `;

            document.getElementById('nuevo-curso-container').appendChild(nuevoCursoContainer);

            // Asignar evento de cambio para mostrar el nombre del archivo en los inputs dinámicos
            actualizarNombreArchivo(nuevoCursoContainer.querySelector('.custom-file-input'));
        });
    });

    // Función para actualizar el nombre del archivo seleccionado
    function actualizarNombreArchivo(input) {
        input.addEventListener('change', function() {
            let fileName = input.files[0] ? input.files[0].name : 'Seleccionar archivo';
            input.nextElementSibling.innerHTML = fileName; // Actualiza el label del input con el nombre del archivo
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Para los cursos que ya existen, asignar el evento para actualizar el nombre del archivo
        document.querySelectorAll('.custom-file-input').forEach(function(input) {
            actualizarNombreArchivo(input); // Reutiliza la función que ya tienes
        });
    });

    // Función para actualizar el nombre del archivo seleccionado
    function actualizarNombreArchivo(input) {
        input.addEventListener('change', function() {
            let fileName = input.files[0] ? input.files[0].name : 'Seleccionar archivo';
            input.nextElementSibling.innerHTML = fileName; // Actualiza el label del input con el nombre del archivo
        });
    }

</script>
