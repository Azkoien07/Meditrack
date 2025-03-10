<?php

namespace App\Http\Controllers;

use App\Models\Usuario; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    // Obtener los usuarios según su rol
    $pacientes = Usuario::where('rol_id', 2)->get(); // Pacientes
    $doctores = Usuario::where('rol_id', 3)->get(); // Doctores

    // Retornar la vista 'admin.indexA' con los datos
    return view('admin.indexA', compact('pacientes', 'doctores'));
}
}
