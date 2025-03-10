<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
  public function store(Request $request)
  {
    // Forzar el rol "Paciente"
    $request->merge(['role' => 'Paciente']);

    // Validar los datos del formulario
    $validatedData = $request->validate([
      'role' => ['required', Rule::in(['Paciente'])],
      'correo' => ['required', 'email', 'unique:usuarios,correo'],
      'contrasena' => ['required', 'confirmed', 'min:6'],
    ]);

    // Buscar el rol "Paciente"
    $rol = Rol::where('nombre', 'Paciente')->first();

    if (!$rol) {
      return back()->withErrors(['error' => 'El rol "Paciente" no existe en la base de datos.']);
    }

    // Crear el usuario
    $usuario = Usuario::create([
      'correo' => $validatedData['correo'],
      'contrasena' => Hash::make($validatedData['contrasena']),
      'rol_id' => $rol->id,
    ]);

    // Redirigir a la vista de "Paciente" con un mensaje de éxito
    return redirect()->route('paciente')->with('success', '¡Registro exitoso! Ahora puedes iniciar sesión.');
  }
}
