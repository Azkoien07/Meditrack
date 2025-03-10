<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required',
            'rol' => 'required'
        ]);

        // Cargar el JSON con los datos de usuarios
        $ruta = storage_path('app/roles/usuarios.json');

        $usuarios = json_decode(File::get($ruta), true);

        // Buscar el usuario en el JSON
        foreach ($usuarios as $usuario) {
            if ($usuario['correo'] === $credenciales['correo']) {
                // Validar la contraseña
                if (password_verify($credenciales['contraseña'], $usuario['contraseña'])) {
                    // Validar que el rol seleccionado coincida con el del usuario
                    if ($usuario['rol'] !== $credenciales['rol']) {
                        return back()->withErrors(['rol' => 'El rol seleccionado no coincide con el del usuario.']);
                    }

                    // Guardar en sesión
                    Session::put('usuario', [
                        'correo' => $usuario['correo'],
                        'rol' => $usuario['rol']
                    ]);

                    // Redirigir a la vista
                    return redirect()->route('admin');
                }
            }
        }

        return back()->withErrors(['correo' => 'Credenciales incorrectas']);
    }
}
