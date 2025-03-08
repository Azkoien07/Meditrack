<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
{
    // Obtener la sesión manualmente
    $user = session('user');

    // Verificar si el usuario existe en la sesión
    if (!$user) {
        return redirect()->route('login')->withErrors(['error' => 'Debes iniciar sesión.']);
    }

    // Verificar si el usuario tiene el rol requerido
    if ($user['role'] !== $role) {
        return redirect()->route('home')->withErrors(['error' => 'No tienes permisos para acceder.']);
    }

    return $next($request);
}

}
