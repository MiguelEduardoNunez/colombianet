<?php

namespace App\Http\Controllers;

use App\Models\Arl;
use App\Models\CargoEmpleado;
use App\Models\ContactoEmergencia;
use App\Models\Curso;
use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\EntregaElemento;
use App\Models\Eps;
use App\Models\FondoCesantia;
use App\Models\FondoPension;
use App\Models\HistoriaClinica;
use App\Models\Municipio;
use App\Models\NivelEducativo;
use App\Models\Novedad;
use App\Models\TipoContrato;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::orderBy('nombres_completos', 'asc')->paginate(100);

        return view('empleados.listar', ['empleados' => $empleados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_documentos = TipoDocumento::all();
        $niveles_educativos = NivelEducativo::all();
        $tipos_contratos = TipoContrato::all();
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        $tipos_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $cargos_empleados = CargoEmpleado::all();
        $niveles_educativos = NivelEducativo::all();
        $arls = Arl::all();
        $eps = Eps::all();
        $fondos_pensiones = FondoPension::all();
        $fondos_cesantias = FondoCesantia::all();

        return view('empleados.crear', [
            'tipos_documentos' => $tipos_documentos,
            'niveles_educativos' => $niveles_educativos,
            'tipos_contratos' => $tipos_contratos,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'tipos_sangre' => $tipos_sangre,
            'cargos_empleados' => $cargos_empleados,
            'niveles_educativos' => $niveles_educativos,
            'arls' => $arls,
            'fondos_pensiones' => $fondos_pensiones,
            'fondos_cesantias' => $fondos_cesantias,
            'eps' => $eps,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //($request->file('certificados_cursos_pdf'));

        //dd($request->all());
        try {
            // Validar los datos del request
            $validaciones = $request->validate([
                'nombres_completos' => ['required', 'string', 'max:100'],
                'apellidos_completos' => ['required', 'string', 'max:100'],
                'tipo_documento' => ['required', 'numeric', 'exists:tipos_documentos,id_tipo_documento'],
                'documento' => ['required', 'string', 'max:20', 'unique:empleados,documento'],
                'municipio' => ['required', 'numeric', 'exists:municipios,id_municipio'],
                'fecha_expedicion' => ['required', 'date'],
                'tipo_sangre' => ['required', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
                'historia_clinica.alergias' => ['nullable', 'string', 'max:150'],
                'historia_clinica.enfermedades' => ['nullable', 'string', 'max:150'],
                'fecha_nacimiento' => ['required', 'date'],
                'edad' => ['required', 'numeric'],
                'telefono' => ['required', 'string', 'max:10'],
                'email' => ['required', 'email', 'max:100', 'unique:empleados,email'],
                'direccion' => ['required', 'string', 'max:100'],
                'estrato' => ['required', 'numeric'],
                'cargo_empleado' => ['required', 'numeric', 'exists:cargos_empleados,id_cargo_empleado'],
                'fecha_inicio_contrato' => ['nullable', 'date'],
                'tipo_contrato' => ['nullable', 'numeric', 'exists:tipos_contratos,id_tipo_contrato'],
                'nivel_educativo' => ['nullable', 'numeric', 'exists:niveles_educativos,id_nivel_educativo'],
                'arl' => ['nullable', 'numeric', 'exists:arl,id_arl'],
                'arl_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
                'nivel_riesgo' => ['nullable', 'integer', 'min:1', 'max:5'],
                'eps' => ['nullable', 'numeric', 'exists:eps,id_eps'],
                'eps_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
                'estado' => ['required', 'in:Empleado,Retirado,Prospecto,Renuncia,Aprendiz,Despido'],
                'fondo_cesatia_id' => ['nullable', 'numeric', 'exists:fondos_cesantias,id_fondo_cesantia'],
                'fondo_pension_id' => ['nullable', 'numeric', 'exists:fondos_pensiones,id_fondo_pension'],
                'nombre_acudiente' => ['required', 'string', 'max:150'],
                'parentesco_acudiente' => ['required', 'string', 'max:50'],
                'telefono_acudiente' => ['required', 'string', 'max:10'],

                'nombre_curso' => ['nullable', 'array'],
                'nombre_curso.*' => ['string', 'max:100'],
                'certificado_curso_pdf.*' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            ]);

            // Crear el empleado
            $empleado = new Empleado();
            $empleado->nombres_completos = $request->nombres_completos;
            $empleado->apellidos_completos = $request->apellidos_completos;
            $empleado->tipo_documento_id = $request->tipo_documento;
            $empleado->documento = $request->documento;
            $empleado->lugar_expedicion_id = $request->municipio;
            $empleado->fecha_expedicion = $request->fecha_expedicion;
            $empleado->tipo_sangre = $request->tipo_sangre;
            $empleado->fecha_nacimiento = $request->fecha_nacimiento;
            $empleado->edad = $request->edad;
            $empleado->telefono = $request->telefono;
            $empleado->email = $request->email;
            $empleado->direccion = $request->direccion;
            $empleado->estrato = $request->estrato;
            $empleado->cargo_empleado_id = $request->cargo_empleado;
            $empleado->fecha_inicio_contrato = $request->fecha_inicio_contrato;
            $empleado->fecha_periodo_prueba = $request->fecha_periodo_prueba;
            $empleado->fecha_fin_contrato = $request->fecha_fin_contrato;
            $empleado->tipo_contrato_id = $request->tipo_contrato;
            $empleado->nivel_educativo_id = $request->nivel_educativo;
            $empleado->arl_id = $request->arl;
            if ($request->hasFile('arl_pdf')) {
                $empleado->arl_pdf = $request->file('arl_pdf')->store('certificados_arl', 'public');
            }
            $empleado->nivel_riesgo = $request->nivel_riesgo;
            $empleado->eps_id = $request->eps;
            if ($request->hasFile('eps_pdf')) {
                $empleado->eps_pdf = $request->file('eps_pdf')->store('certificados_eps', 'public');
            }
            $empleado->estado = $request->estado;
            $empleado->fondo_pension_id = $request->fondo_pension;
            $empleado->fondo_cesantia_id = $request->fondo_cesantia;
            $empleado->save();

            // Crear historia clínica
            $historia_clinica = new HistoriaClinica();
            $historia_clinica->empleado_id = $empleado->id_empleado;
            $historia_clinica->alergias = $request->alergias;
            $historia_clinica->enfermedades = $request->enfermedades;
            $historia_clinica->save();

            // Crear contacto de emergencia
            $contacto_emergencia = new ContactoEmergencia();
            $contacto_emergencia->empleado_id = $empleado->id_empleado;
            $contacto_emergencia->nombre_acudiente = $request->nombre_acudiente;
            $contacto_emergencia->parentesco_acudiente = $request->parentesco_acudiente;
            $contacto_emergencia->telefono_acudiente = $request->telefono_acudiente;
            $contacto_emergencia->save();

            if ($request->hasFile('certificados_cursos_pdf')) {
                foreach ($request->file('certificados_cursos_pdf') as $index => $file) {
                    // Guardar el archivo del certificado
                    $filePath = $file->store('certificados_cursos', 'public');
                    
                    // Crear el curso solo si no existe con ese nombre
                    $curso = Curso::firstOrCreate([
                        'nombre_curso' => $request->cursos_realizados[$index]
                    ]);

                    DB::table('empleado_curso')->insert([
                        'empleado_id' => $empleado->id_empleado,  // Asumimos que $empleado es el objeto del empleado
                        'curso_id' => $curso->id_curso,
                        'certificado_pdf' => $filePath,  // Guardar el path del archivo del certificado
                    ]);
                }
            }
            
            Alert::success('Registrado', 'Empleado con éxito');
            return redirect(route('empleados.index'));

        } catch (\Exception $e) {
            // Registrar el error en el log
            Log::error('Error al guardar el empleado: ' . $e->getMessage());

            // Mostrar mensaje de error al usuario
            Alert::error('Error', 'Ocurrió un error al registrar el empleado.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_empleado)
    {
        $empleado = Empleado::find($id_empleado);
        $historia_clinica = HistoriaClinica::where('empleado_id', '=', $id_empleado)->first();

        return view('empleados.mostrar', ['empleado' => $empleado, 'historia_clinica' => $historia_clinica]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empleado = Empleado::find($id);

        return view('empleados.editar', ['empleado' => $empleado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validaciones = $request->validate([
            'empleado' => ['required', 'string', 'max:100'],
        ]);

        $empleado = Empleado::find($id);
        $empleado->empleado = $request->empleado;
        $empleado->save();

        Alert::success('Actualizado', 'Empleado con éxito');
        return redirect(route('empleados.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entrega_elemento = EntregaElemento::where('empleado_id', '=', $id)->first();
        $novedad = Novedad::where('empleado_id', '=', $id)->first();

        if ($entrega_elemento != null or $novedad != null) {
            Alert::error('Error', 'el empleado tiene registros asociados');
        } else {
            Empleado::find($id)->delete();
            Alert::success('Eliminado', 'Empleado con exito');
        }
        return redirect(route('empleados.index'));
    }
}
