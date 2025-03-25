<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Paciente;
use Illuminate\Support\Facades\View;

class PdfService
{
    /**
     * Genera un PDF con los datos de los pacientes.
     *
     * @param array $data Datos de los pacientes.
     * @param string $view Nombre de la vista.
     * @return \Barryvdh\DomPDF\PDF
     */
    public function generatePatientReport(Paciente $paciente, string $view = 'Reports.paciente')
    {
        // Convertir a array para la vista
        $data = $paciente->toArray();

        // Generar el PDF
        $pdf = Pdf::loadView($view, compact('data'));

        return $pdf;
    }
}
