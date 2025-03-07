<?php

namespace App\Contracs;

use App\Models\Rol;


interface RolServiceInterface{
    // Obtener el nombre del rol
    public function getNombre(): String;

    // Asignar permisos al rol
    public function asignarPermiso(String $permiso):void;

    // Verificar si el rol tiene permisos
    public function tienePermiso(string $permiso): bool;

    // Obtener todos los permisos de un rol
    public function obtenerPermisos(): array;

}