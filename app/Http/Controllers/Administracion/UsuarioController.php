<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::where('perfil_id', '!=', 2)
            ->orderBy('nombres', 'asc')
            ->paginate(100);

        return view('usuarios.listar', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perfiles = Perfil::where('id_perfil', '!=', 2)
            ->orderBy('perfil', 'asc')
            ->get();

        return view('usuarios.crear', ['perfiles' => $perfiles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mensajes = [
            'email.required' => 'El campo correo es obligatorio.',
            'email.unique' => 'El valor del campo correo ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.'
        ];

        $validaciones = $request->validate([
            'perfil' => ['required', 'numeric'],
            'identificacion' => ['required', 'numeric', 'unique:usuarios,identificacion'],
            'nombres' => ['required', 'string', 'max:100'],
            'telefono' => ['nullable', 'numeric'],
            'email' => ['required', 'email', 'max:50', 'unique:usuarios,email'],
            'password' => ['required', 'string', 'max:50']
        ], $mensajes);

        $usuario = new Usuario();
        $usuario->perfil_id = $request->perfil;
        $usuario->identificacion = $request->identificacion;
        $usuario->nombres = $request->nombres;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->save();

        Alert::success('Registrado', 'Usuario con éxito');
        return redirect(route('usuarios.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::find($id);

        return view('usuarios.mostrar', ['usuario' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = Usuario::find($id);

        $perfiles = Perfil::where('id_perfil', '!=', 2)
            ->where('id_perfil', '!=', $usuario->perfil_id)
            ->orderBy('perfil', 'asc')
            ->get();

        return view('usuarios.editar', ['usuario' => $usuario, 'perfiles' => $perfiles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mensajes = [
            'email.required' => 'El campo correo es obligatorio.',
            'email.unique' => 'El valor del campo correo ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.'
        ];

        $validaciones = $request->validate([
            'perfil' => ['required', 'numeric'],
            'identificacion' => ['required', 'numeric', Rule::unique('usuarios')->ignore($id, 'id_usuario')],
            'nombres' => ['required', 'string', 'max:100'],
            'telefono' => ['nullable', 'numeric'],
            'email' => ['required', 'email', 'max:50', Rule::unique('usuarios')->ignore($id, 'id_usuario')],
            'password' => ['nullable', 'string', 'max:50']
        ], $mensajes);

        $usuario = Usuario::find($id);
        $usuario->perfil_id = $request->perfil;
        $usuario->identificacion = $request->identificacion;
        $usuario->nombres = $request->nombres;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->save();

        Alert::success('Actualizado', 'Usuario con éxito');
        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Usuario::find($id)->delete();
        
        // return redirect(route('usuarios.index'));
    }
}
