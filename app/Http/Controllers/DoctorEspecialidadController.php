<?php

namespace App\Http\Controllers;

use App\Models\doctor;
use App\Models\Especialidad;
use App\Models\DoctorEspecialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorEspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.especialidad', [
            'doctores' => Doctor::with('especialidades')->get(),
            'especialidades' => Especialidad::all(),
        ]);
    }

    public function asignarEspecialidad(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'especialidad_id' => 'required|exists:especialidades,id',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);
        $doctor->especialidades()->syncWithoutDetaching([$request->especialidad_id]);

        return redirect()->back()->with('success', 'Especialidad asignada correctamente.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorEspecialidad $DoctorEspecialidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DoctorEspecialidad $DoctorEspecialidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DoctorEspecialidad $DoctorEspecialidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DoctorEspecialidad $DoctorEspecialidad)
    {
        //
    }
}
