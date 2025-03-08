<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'role' => 'required|in:admin,doctor,paciente',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Ruta del archivo JSON
        $filePath = storage_path('app/roles/usuarios.json');

        if (!file_exists($filePath)) {
            return back()->withErrors(['error' => 'Error interno: No se encontró la base de datos de usuarios.']);
        }

        // Leer y decodificar el archivo JSON
        $json = file_get_contents($filePath);
        $users = json_decode($json, true);

        if (!$users) {
            return back()->withErrors(['error' => 'Error interno: No se pudo leer la base de datos de usuarios.']);
        }

        // Buscar el usuario por email
        $user = collect($users)->firstWhere('email', $request->email);

        // Validar credenciales y rol
        if (!$user || !Hash::check($request->password, $user['password']) || $user['role'] !== $request->role) {
            return back()->withErrors(['error' => 'Credenciales o rol incorrectos.'])->withInput();
        }

        // Iniciar sesión correctamente
        $request->session()->put('user', $user);
        $request->session()->regenerate();

        // rutas según el rol
        $routes = [
            'admin' => '/admin',
            'doctor' => '/doctor',
            'paciente' => '/paciente'
        ];

        // Redirigir según el rol del usuario
        return redirect($routes[$user['role']]);
    }
}
