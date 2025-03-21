<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener los usuarios según su rol
        $pacientes = Usuario::where('rol_id', 2)->get(); // Pacientes
        $doctores = Usuario::where('rol_id', 3)->get(); // Doctores

        // Retornar la vista 'Admin.indexA' con los datos
        return view('Admin.indexA', compact('pacientes', 'doctores'));
    }
    public function eliminar($id)
    {
        // Buscar el usuario por ID
        $usuario = Usuario::findOrFail($id);

        if ($usuario->rol_id == 2) { // Paciente
            Paciente::where('id', $id)->delete();
        } elseif ($usuario->rol_id == 3) { // Doctor
            Doctor::where('id', $id)->delete();
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    public function editar($id)
    {
        $usuario = Usuario::with('rol')->findOrFail($id);

        // Verificar si el usuario tiene un rol válido
        if (!$usuario->rol) {
            return redirect()->back()->with('error', 'El usuario no tiene un rol asignado.');
        }

        // Buscar el modelo correspondiente según el rol
        $persona = match ($usuario->rol->nombre) {
            'doctor' => Doctor::where('usuario_id', $id)->first(),
            'paciente' => Paciente::where('usuario_id', $id)->first(),
            default => null
        };

        if (!$persona) {
            return redirect()->back()->with('error', 'No se encontraron datos específicos para este usuario.');
        }

        return view('Admin.editar', compact('usuario', 'persona'));
    }

    public function actualizar(Request $request, $id)
    {
        // Validar datos
        $datosValidados = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'genero' => 'required|string|in:Masculino,Femenino',
            'telefono' => 'nullable|string|max:20',
            'tipo_identificacion' => 'required|string|max:50',
            'identificacion' => "required|string|max:50|unique:pacientes,identificacion,{$id},id", // Corregido
            'eps' => 'nullable|string|max:255',
            'f_nacimiento' => 'nullable|date',
        ]);

        // Verificar si el usuario existe y tiene un rol válido
        $usuario = Usuario::with('rol')->find($id);

        if (!$usuario) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        if (!$usuario->rol) {
            return back()->with('error', 'El usuario no tiene un rol asignado.');
        }

        $persona = null;

        if ($usuario->rol->nombre === 'doctor') {
            $persona = Doctor::where('usuario_id', $id)->first();
        } elseif ($usuario->rol->nombre === 'paciente') {
            $persona = Paciente::where('usuario_id', $id)->first();
        }

        if (!$persona) {
            return back()->with('error', 'No se encontraron datos para actualizar.');
        }

        // Verificar si los datos han cambiado
        if ($persona->fill($datosValidados)->isDirty()) {
            $persona->save();
            return redirect()->route('admin')->with('success', ucfirst($usuario->rol->nombre) . ' actualizado correctamente.');
        }

        return back()->with('info', 'No se realizaron cambios.');
    }
}
