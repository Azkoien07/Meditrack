<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Services\PdfService;

class ReportController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Descarga el reporte de pacientes en PDF.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function downloadPatientReport(Request $request)
    {
        $pacientes = Paciente::all();

        // Convertir los datos a un array para pasarlos a la vista
        $data = $pacientes->map(function ($paciente) {
            return [
                'id' => $paciente->id,
                'nombre' => $paciente->nombre,
                'apellido' => $paciente->apellido,
                'edad' => $paciente->edad,
                'genero' => $paciente->genero,
                'telefono' => $paciente->telefono,
                'tipo_identificacion' => $paciente->tipo_identificacion,
                'identificacion' => $paciente->identificacion,
                'eps' => $paciente->eps,
                'f_nacimiento' => $paciente->f_nacimiento,
            ];
        })->toArray();
        dd($data);

        // Generar el PDF
        $pdf = $this->pdfService->generatePatientReport($data);

        return $pdf->download('reporte_pacientes.pdf');
    }
}
