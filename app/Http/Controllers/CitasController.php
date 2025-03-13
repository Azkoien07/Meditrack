<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Doctor;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    /**
     * Muestra una lista de todas las citas con los doctores.
     */
    public function index()
    {
        $citas = Citas::all();
        $doctores = Doctor::all();

        return view('paciente.indexP', compact('doctores')); // Pasar ambas variables a la vista
    }

    /**
     * Muestra el formulario para crear una nueva cita.
     */
    public function create()
    {
        $doctores = Doctor::all(); // Obtener todos los doctores
        return view('paciente.indexP', compact('doctores')); // Pasar los doctores a la vista
    }

    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'sede' => 'required|string',
            'especialidad' => 'required|string',
            'motivo' => 'nullable|string',
            'doctor_id' => 'required|exists:doctores,id', // Verifica que el doctor existe en la BD
        ]);

        // Crear la cita
        $cita = Citas::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'sede' => $request->sede,
            'especialidad' => $request->especialidad,
            'motivo' => $request->motivo,
            'doctor_id' => $request->doctor_id,
        ]);

        return redirect()->route('paciente')->with('success', 'Cita creada correctamente.');
    }

    /**
     * Muestra una cita específica.
     */
    public function show(Citas $citas)
    {
        //
    }

    /**
     * Muestra el formulario para editar una cita.
     */
    public function edit(Citas $citas)
    {
        //
    }

    /**
     * Actualiza la cita en la base de datos.
     */
    public function update(Request $request, Citas $citas)
    {
        //
    }

    /**
     * Elimina una cita de la base de datos.
     */
    public function destroy(Citas $citas)
    {
        //
    }
}
