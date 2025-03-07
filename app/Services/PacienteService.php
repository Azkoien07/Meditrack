<?php

 namespace App\Services;

 use App\Contracs\PacienteServiceInterface;
 use App\Models\Paciente;

 class PacienteService implements PacienteServiceInterface{
    // Metodos Crud
    public function listarPacientes(){
        return Paciente::all();
    }

    public function crearPaciente(array $data){
        return Paciente::create($data);
    }

    public function obtenerPaciente(int $id){
        return Paciente::find($id);
    }

    public function actualizarPaciente(array $data, int $id){
        $paciente = Paciente::find($id);
        $paciente->update($data);
        return $paciente;
    }

    public function eliminarPaciente(Paciente $paciente){
    
        return $paciente->delete();
    }

}