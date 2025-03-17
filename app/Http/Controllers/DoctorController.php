<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Doctor.createD');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'contraseña' => 'required|min:8',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'turno' => 'required|string|max:50',
        ]);

        // Obtener el rol_id correspondiente al rol "doctor"
        $rolDoctor = Rol::where('nombre', 'doctor')->first();
        if (!$rolDoctor) {
            return redirect()->back()->with('error', 'El rol "doctor" no existe en la base de datos.');
        }

        // Crea un nuevo usuario en la tabla usuarios
        $usuario = Usuario::create([
            'correo' => $request->correo,
            'contraseña' => Hash::make($request->contraseña),
            'rol_id' => $rolDoctor->id,
        ]);

        // Crear un nuevo doctor en la tabla doctores
        $doctor = Doctor::create([
            'usuario_id' => $usuario->id,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'genero' => $request->genero,
            'turno' => $request->turno,
        ]);

        // Redireccionar
        return redirect()->route('admin')->with('success', 'Doctor creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(doctor $doctor)
    {
        //
    }
}
