<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{   public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'correo' => 'required|email',
            'contraseña' => 'required'
        ]);

        // Cargar el JSON con los datos de admins
        $ruta = storage_path('app/roles/usuarios.json');
        
        if (!File::exists($ruta)) {
            return response()->json(['error' => 'Archivo de usuarios no encontrado'], 404);
        }

        $usuarios = json_decode(File::get($ruta), true);
        
        // Buscar el admin en el JSON
        foreach ($usuarios as $usuario) {
            if ($usuario['correo'] === $credenciales['correo']) {
                // Validar la contraseña
                if (password_verify($credenciales['contraseña'], $usuario['contraseña'])) {
                    // Guardar en sesión
                    Session::put('usuario', [
                        'correo' => $usuario['correo'],
                        'rol' => $usuario['rol']
                    ]);

                    // Redirigir según el rol
                    return redirect()->route('admin');
                }
            }
        }

        return back()->withErrors(['correo' => 'Credenciales incorrectas']);
    }
}