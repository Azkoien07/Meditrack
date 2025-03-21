<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CitasController extends Controller
{
    /**
     * Muestra una lista de todas las citas con los doctores.
     */
    public function index()
    {
        $citas = Citas::all();
        $doctores = Doctor::all();

        return view('Paciente.indexP', compact('doctores'));
    }

    /**
     * Muestra el formulario para crear una nueva cita.
     */
    public function create()
    {
        $doctores = Doctor::all();
        return view('Paciente.indexP', compact('doctores'));
    }

    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado (usando la sesión)
        if (!session()->has('usuario')) {
            return redirect()->route('login')->withErrors(['error' => 'Debes iniciar sesión para crear una cita.']);
        }


        // Obtener el ID del paciente desde la sesión
        $pacienteId = session('usuario.id');
        Log::info('ID del paciente autenticado:', ['id' => $pacienteId]);

        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'sede' => 'required|string',
            'doctor_id' => 'required|exists:doctores,id',
        ]);

        // Crea la cita en la base de datos
        $cita = new Citas();
        $cita->fecha = $validatedData['fecha'];
        $cita->hora = $validatedData['hora'];
        $cita->sede = $validatedData['sede'];
        $cita->doctor_id = $validatedData['doctor_id'];
        $cita->paciente_id = $pacienteId;
        $cita->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
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
