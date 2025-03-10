<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

        // Verificar si tiene el rol correcto
        if ($usuario['rol'] !== $role) {
            return redirect()->route('home')->withErrors(['error' => 'No tienes permisos para acceder.']);
        }

        return $next($request);
    }
}
