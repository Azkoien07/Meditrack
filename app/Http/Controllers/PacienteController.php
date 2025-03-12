<?php

namespace App\Http\Controllers;

use App\Models\paciente;
use Illuminate\Http\Request;
use App\Services\PacienteService;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function index()
    {
        $pacientes = $this->pacienteService->listarPacientes();
        return view('indexP', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paciente.create');
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
    public function show(paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paciente $paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, paciente $paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paciente $paciente)
    {
        //
    }
}
