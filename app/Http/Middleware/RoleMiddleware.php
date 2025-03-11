<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Obtener usuario desde la sesión
        $usuario = session('usuario');

        // Verificar si el usuario está autenticado
        if (!$usuario) {
            return redirect()->route('login')->withErrors(['error' => 'Debes iniciar sesión.']);
        }

        // Primero, verificar si el usuario es admin a través del JSON
        $ruta = storage_path('app/roles/usuarios.json');

        if (File::exists($ruta)) {
            $usuarios = json_decode(File::get($ruta), true);
            foreach ($usuarios as $user) {
                if ($user['correo'] === $usuario['correo'] && $user['rol'] === 'admin') {
                    if ($role !== 'admin') {
                        return redirect()->route('admin')->withErrors(['error' => 'No tienes permisos para acceder.']);
                    }
                    return $next($request);
                }
            }
        }

        // Si no es admin, validar los roles de la base de datos
        $roles = [
            2 => 'paciente',
            3 => 'doctor'
        ];

        $usuarioRol = $roles[$usuario['rol']] ?? null;

        if ($usuarioRol !== $role) {
            $rutaDestino = match ($usuarioRol) {
                'doctor' => 'doctor',
                'paciente' => 'paciente',
                default => 'login'
            };

            return redirect()->route($rutaDestino)->withErrors(['error' => 'No tienes permisos para acceder.']);
        }

        return $next($request);
    }
}
