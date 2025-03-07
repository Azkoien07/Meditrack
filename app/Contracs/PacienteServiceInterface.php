<?php

namespace App\Contracs;

use App\Models\Paciente;

interface PacienteServiceInterface{
    
    // Listar pacientes
    public function listarPacientes();

    // Crear paciente
    public function crearPaciente(array $data);

    // Obtener paciente
    public function obtenerPaciente(int $id);

    // Actualizar paciente
    public function actualizarPaciente(array $data, int $id);

    // Desactivar paciente
    public function eliminarPaciente(Paciente $paciente);
}