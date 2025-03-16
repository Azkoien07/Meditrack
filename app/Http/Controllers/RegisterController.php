<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
  public function register(Request $request)
    {
        // Forzar el rol "Paciente"
        $request->merge(['role' => 'paciente']);

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'role' => ['required', Rule::in(['paciente'])],
            'correo' => ['required', 'email', 'unique:usuarios,correo'],
            'contraseña' => ['required', 'confirmed', 'min:6'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'edad' => ['required', 'string', 'max:3'],
            'genero' => ['required', 'string', 'in:Masculino,Femenino,Otro'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'tipo_identificacion' => ['required', 'string', 'in:CC,CE,TI,RC,PA,MS,NIT'],
            'identificacion' => ['required', 'string', 'unique:pacientes,identificacion'],
            'eps' => ['required', 'string', 'max:255'],
            'f_nacimiento' => ['required', 'date'],
        ]);

        // Buscar el rol "Paciente"
        $rol = Rol::where('nombre', 'paciente')->first();

        if (!$rol) {
            return back()->withErrors(['error' => 'El rol "Paciente" no existe en la base de datos.']);
        }

        // Crear el usuario
        $usuario = Usuario::create([
            'correo' => $validatedData['correo'],
            'contraseña' => Hash::make($validatedData['contraseña']),
            'rol_id' => $rol->id,
        ]);

        // registro en la tabla pacientes
        Paciente::create([
            'usuario_id' => $usuario->id, // Asignar el ID del usuario recién creado
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'] ?? null,
            'edad' => $validatedData['edad'],
            'genero' => $validatedData['genero'],
            'telefono' => $validatedData['telefono'] ?? null,
            'tipo_identificacion' => $validatedData['tipo_identificacion'],
            'identificacion' => $validatedData['identificacion'],
            'eps' => $validatedData['eps'],
            'f_nacimiento' => $validatedData['f_nacimiento'],
        ]);

        // Redirigir a la vista de "Login" con un mensaje de éxito
        return redirect()->route('login')->with(['success' => 'Registro exitoso']);
    }
}
