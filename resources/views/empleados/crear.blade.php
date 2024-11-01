<x-app-layout>
    <x-slot:page>
        {{ __('Registrar Empleado') }}
        </x-slot>
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <form method="POST" action="{{ route('empleados.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-card>
                        <x-slot:header>
                            <x-text :value="__('Registrar Empleado')" class="text-center" />
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
                                            <x-input type="text" id="nombres_completos" name="nombres_completos" :value="old('nombres_completos')" />
                                            <x-input-error :messages="$errors->get('nombres_completos')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Apellidos Completos')" for="apellidos_completos" :obligatorio=false />
                                            <x-input type="text" id="apellidos_completos" name="apellidos_completos" :value="old('apellidos_completos')" />
                                            <x-input-error :messages="$errors->get('apellidos_completos')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Documento')" for="tipo_documento" :obligatorio=false />
                                            <x-select :elements="$tipos_documentos" identifier="id_tipo_documento" label="tipo_documento" id="tipo_documento" name="tipo_documento">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo_documento')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Identificación')" for="documento" :obligatorio=false />
                                            <x-input type="text" id="documento" name="documento" :value="old('documento')" />
                                            <x-input-error :messages="$errors->get('documento')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Departamento')" for="departamento" :obligatorio=false />
                                            <x-select :elements="$departamentos" identifier="id_departamento" label="departamento" id="departamento" name="departamento">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('departamento')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Lugar de Expedición del Documento')" for="municipio" :obligatorio=false />
                                            <x-select :elements="$municipios" identifier="id_municipio" label="municipio" id="municipio" name="municipio">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('municipio')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Expedición')" for="fecha_expedicion" :obligatorio=false />
                                            <x-input type="date" id="fecha_expedicion" name="fecha_expedicion" :value="old('fecha_expedicion')" />
                                            <x-input-error :messages="$errors->get('fecha_expedicion')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Sangre')" for="tipo_sangre" :obligatorio=false />
                                            <select id="tipo_sangre" name="tipo_sangre" class="form-control select2">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                                @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $tipo)
                                                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('tipo_sangre')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Alergias')" for="alergias" :obligatorio=false />
                                            <x-input type="text" id="alergia" name="alergias" :value="old('alergias')" />
                                            <x-input-error :messages="$errors->get('alergias')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Enfermedades')" for="enfermedades" :obligatorio=false />
                                            <x-input type="text" id="enfermedad" name="enfermedades" :value="old('enfermedades')" />
                                            <x-input-error :messages="$errors->get('enfermedades')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Nacimiento')" for="fecha_nacimiento" :obligatorio=false />
                                            <x-input type="date" id="fecha_nacimiento" name="fecha_nacimiento" :value="old('fecha_nacimiento')" />
                                            <x-input-error :messages="$errors->get('fecha_nacimiento')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Edad')" for="edad" :obligatorio=false />
                                            <x-input type="number" id="edad" name="edad" :value="old('edad')" />
                                            <x-input-error :messages="$errors->get('edad')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Celular')" for="telefono" :obligatorio=false />
                                            <x-input type="number" id="telefono" name="telefono" :value="old('telefono')" />
                                            <x-input-error :messages="$errors->get('telefono')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Correo Electrónico')" for="email" :obligatorio=false />
                                            <x-input type="email" id="email" name="email" :value="old('email')" />
                                            <x-input-error :messages="$errors->get('email')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Dirección de Residencia')" for="direccion" :obligatorio=false />
                                            <x-input type="text" id="direccion" name="direccion" :value="old('direccion')" />
                                            <x-input-error :messages="$errors->get('direccion')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Estrato Socioeconómico')" for="estrato" :obligatorio=false />
                                            <x-input type="number" id="estrato" name="estrato" :value="old('estrato')" />
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
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('cargo_empleado')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Estado del empleado')" for="estado" :obligatorio=false />
                                            <select id="estado" name="estado" class="form-control select2" style="width: 100%">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                                @foreach (['Empleado', 'Retirado', 'Prospecto', 'Renuncia', 'Aprendiz', 'Despido'] as $tipo)
                                                <option value="{{ $tipo }}">{{ $tipo }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('estado')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha inicio del Contrato')" for="fecha_inicio_contrato" :obligatorio=false />
                                            <x-input type="date" id="fecha_inicio_contrato" name="fecha_inicio_contrato" :value="old('fecha_inicio_contrato')" />
                                            <x-input-error :messages="$errors->get('fecha_inicio_contrato')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Inicio del Periodo de Prueba')" for="fecha_periodo_prueba" :obligatorio=false />
                                            <x-input type="date" id="fecha_periodo_prueba" name="fecha_periodo_prueba" :value="old('fecha_periodo_prueba')" />
                                            <x-input-error :messages="$errors->get('fecha_periodo_prueba')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fecha de Finalización del Contrato')" for="fecha_fin_contrato" :obligatorio=false />
                                            <x-input type="date" id="fecha_fin_contrato" name="fecha_fin_contrato" :value="old('fecha_fin_contrato')" />
                                            <x-input-error :messages="$errors->get('fecha_fin_contrato')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Tipo de Contrato')" for="tipo_contrato" :obligatorio=false />
                                            <x-select :elements="$tipos_contratos" identifier="id_tipo_contrato" label="tipo_contrato" id="tipo_contrato" name="tipo_contrato">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('tipo_contrato')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nivel Educativo')" for="nivel_educativo" :obligatorio=false />
                                            <x-select :elements="$niveles_educativos" identifier="id_nivel_educativo" label="nivel_educativo" id="nivel_educativo" name="nivel_educativo">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('nivel_educativo')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('ARL')" for="arl" :obligatorio=false />
                                            <x-select :elements="$arls" identifier="id_arl" label="nombre_arl" id="arl" name="arl">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('arl')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Certificado ARL en PDF')" for="arl_pdf" :obligatorio=false />
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="arl_pdf" name="arl_pdf">
                                                    <label class="custom-file-label" for="arl_pdf">Seleccionar archivo</label>
                                                </div>
                                            </div>
                                            <x-input-error :messages="$errors->get('arl_pdf')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Nivel de Riesgo')" for="nivel_riesgo" :obligatorio=false />
                                            <x-input type="number" id="nivel_riesgo" name="nivel_riesgo" :value="old('nivel_riesgo')" />
                                            <x-input-error :messages="$errors->get('nivel_riesgo')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('EPS')" for="eps" :obligatorio=false />
                                            <x-select :elements="$eps" identifier="id_eps" label="nombre_eps" id="eps" name="eps">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
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
                                            <x-input-error :messages="$errors->get('eps_pdf')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fondo de Pensión')" for="fondo_pension" :obligatorio=false />
                                            <x-select :elements="$fondos_pensiones" identifier="id_fondo_pension" label="fondo_pension" id="fondo_pension" name="fondo_pension">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
                                            </x-select>
                                            <x-input-error :messages="$errors->get('fondo_pension')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Fondo de Cesantía')" for="fondo_cesantia" :obligatorio=false />
                                            <x-select :elements="$fondos_cesantias" identifier="id_fondo_cesantia" label="fondo_cesantia" id="fondo_cesantia" name="fondo_cesantia">
                                                <option selected disabled>{{ __('Seleccionar') }}</option>
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
                                            <x-input type="text" id="nombre_acudiente" name="nombre_acudiente" :value="old('nombre_acudiente')" />
                                            <x-input-error :messages="$errors->get('nombre_acudiente')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Parentesco')" for="parentesco_acudiente" :obligatorio=false />
                                            <x-input type="text" id="parentesco_acudiente" name="parentesco_acudiente" :value="old('parentesco_acudiente')" />
                                            <x-input-error :messages="$errors->get('parentesco_acudiente')" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label :value="__('Número de Contacto de Emergencia')" for="telefono_acudiente" :obligatorio=false />
                                            <x-input type="text" id="telefono_acudiente" name="telefono_acudiente" :value="old('telefono_acudiente')" />
                                            <x-input-error :messages="$errors->get('telefono_acudiente')" />
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Campos Base para Cursos --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label for="nombre_curso">Curso Realizado</label>
                                            <input type="text" id="nombre_curso" name="cursos_realizados[]" class="form-control">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="certificado_curso_pdf">Certificado del Curso Realizado</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="certificado_curso_pdf" name="certificados_cursos_pdf[]">
                                                    <label class="custom-file-label" for="certificado_curso_pdf">Seleccionar archivos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2 d-flex align-items-end">
                                            <button type="button" id="add-curso-btn" class="btn btn-primary">Agregar</button>
                                        </div>
                                    </div>

                                    {{-- Contenedor para los Cursos Agregados --}}
                                    <div id="cursos-list" class="mt-3">

                                    </div>

                                    <x-button type="submit" class="mt-3">
                                        {{ __('Registrar') }}
                                    </x-button>
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
        // Select dinamicp
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
        // Para el input base ARL PDF
        actualizarNombreArchivo(document.getElementById('arl_pdf'));
        // Para el input base EPS PDF
        actualizarNombreArchivo(document.getElementById('eps_pdf'));

        actualizarNombreArchivo(document.getElementById('certificado_curso_pdf'));
    });

    // Aplicar la función cuando se agregan nuevos inputs de cursos dinámicamente
    document.getElementById('add-curso-btn').addEventListener('click', function() {
        let cursosList = document.getElementById('cursos-list');
        let nuevoCurso = `
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="nombre_curso">Curso Realizado</label>
                <input type="text" name="cursos_realizados[]" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label for="certificado_curso_pdf">Certificado del Curso Realizado</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="certificados_cursos_pdf[]" class="custom-file-input">
                        <label class="custom-file-label" for="certificado_curso_pdf">Seleccionar archivos</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-curso-btn">Eliminar</button>
            </div>
        </div>`;

        cursosList.insertAdjacentHTML('beforeend', nuevoCurso);

        // Agregar funcionalidad para eliminar cursos
        document.querySelectorAll('.remove-curso-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.form-row').remove();
            });
        });
        // Actualizar el nombre del archivo seleccionado para los nuevos campos de archivo
        document.querySelectorAll('.custom-file-input').forEach(input => {
            actualizarNombreArchivo(input); // Llamamos a la función para los nuevos inputs de archivo
        });
    });
</script>