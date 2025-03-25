<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Services\PdfService;

class AdminController extends Controller
{
    protected $pdfService;

    // Inyecta el servicio PdfService en el constructor
    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function index()
    {
        // Obtener los usuarios según su rol
        $pacientes = Paciente::with('usuario')->get();// Pacientes
        $doctores = Doctor::with('usuario')->get(); // Doctores

        return view('Admin.indexA', compact('pacientes', 'doctores'));
    }

    public function eliminar($id)
    {
        // Buscar el usuario por ID
        $usuario = Usuario::findOrFail($id);

        if ($usuario->rol_id == 2) {
            Paciente::where('id', $id)->delete();
        } elseif ($usuario->rol_id == 3) {
            Doctor::where('id', $id)->delete();
        }

        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }

    public function editar($id)
    {
        $usuario = Usuario::with('rol')->findOrFail($id);

        if (!$usuario->rol) {
            return redirect()->back()->with('error', 'El usuario no tiene un rol asignado.');
        }

        $persona = match ($usuario->rol->nombre) {
            'doctor' => Doctor::where('usuario_id', $id)->first(),
            'paciente' => Paciente::where('usuario_id', $id)->first(),
            default => null
        };

        if (!$persona) {
            return redirect()->back()->with('error', 'No se encontraron datos específicos para este usuario.');
        }

        if ($usuario->rol->nombre === 'doctor') {
            return view('Admin.editar_doctor', compact('usuario', 'persona'));
        } else {
            return view('Admin.editar', compact('usuario', 'persona'));
        }
    }

    public function actualizar(Request $request, $id)
    {
        $usuario = Usuario::with('rol')->find($id);

        if (!$usuario) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        if (!$usuario->rol) {
            return back()->with('error', 'El usuario no tiene un rol asignado.');
        }

        if ($usuario->rol->nombre === 'doctor') {
            // Validación para doctores
            $datosValidados = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'genero' => 'required|string|in:masculino,f emenino',
                'turno' => 'required|string|in:mañana,tarde,noche',
            ]);

        } elseif ($usuario->rol->nombre === 'paciente') {
            // Validación para pacientes
            $datosValidados = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido' => 'required|string|max:255',
                'edad' => 'required|integer|min:0',
                'genero' => 'required|string|in:Masculino,Femenino',
                'telefono' => 'nullable|string|max:20',
                'tipo_identificacion' => 'required|string|max:50',
                'identificacion' => "required|string|max:50|unique:pacientes,identificacion,{$id},id",
                'eps' => 'nullable|string|max:255',
                'f_nacimiento' => 'nullable|date',
            ]);
        } else {
            return back()->with('error', 'Rol no válido.');
        }

        $persona = null;

        if ($usuario->rol->nombre === 'doctor') {
            $persona = Doctor::where('usuario_id', $id)->first();
        } elseif ($usuario->rol->nombre === 'paciente') {
            $persona = Paciente::where('usuario_id', $id)->first();
        }

        $persona->fill($datosValidados);

        if ($persona->isDirty()) {
            $persona->save(); // Guardar solo si hay cambios
            return redirect()->route('admin')->with('success', ucfirst($usuario->rol->nombre) . ' actualizado correctamente.');
        }

        return back()->with('info', 'No se realizaron cambios.');
    }

    public function descargarReporte($id)
    {
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return redirect()->back()->with('error', 'Paciente no encontrado.');
        }

        $pdf = $this->pdfService->generatePatientReport($paciente);
        return $pdf->download("reporte_paciente_{$paciente->id}.pdf");
    }
}
