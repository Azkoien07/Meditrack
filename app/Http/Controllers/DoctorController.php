<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Usuario;
use App\Models\Paciente;

use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usuario = $request->session()->get('usuario');

        if (!$usuario) {
            return redirect()->route('login')->with('error', 'No tienes una sesión activa.');
        }

        $doctor = Doctor::where('usuario_id', $usuario['id'])->first();

        if (!$doctor) {
            return redirect()->route('login')->with('error', 'No tienes permisos para acceder.');
        }

        $citas = Citas::where('doctor_id', $doctor->id)->get();

        return view('Doctor.indexD', compact('citas'));
    }

    public function verPacientes()
    {
        $pacientes = Paciente::all();


        return view('Doctor.pacientes', compact('pacientes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Doctor.createD');
    }


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
