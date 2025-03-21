<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

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

        // Cargar el JSON con los datos del admin
        $ruta = storage_path('app/roles/usuarios.json');

        $usuarios = json_decode(File::get($ruta), true);

        // Buscar el admin en el JSON
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

                    return redirect()->route('admin');
                }
            }
        }

        // Buscar el usuario (Doctor, Paciente) en la base de datos
        $usuario = Usuario::where('correo', $credenciales['correo'])->first();

        if ($usuario && password_verify($credenciales['contraseña'], $usuario->contraseña)) {

            // Guardar información en la sesión
            Session::put('usuario', [
                'id' => $usuario->id,
                'correo' => $usuario->correo,
                'rol' => $usuario->rol_id
            ]);

            // Redirigir según el rol del usuario
            switch ($usuario->rol_id) {
                case 2:
                    return redirect()->route('paciente');
                case 3:
                    return redirect()->route('doctor');
                default:
                    return back()->withErrors(['correo' => 'Rol no autorizado']);
            }
        }

        return back()->withErrors(['correo' => 'Credenciales incorrectas']);
    }

    // Función para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
