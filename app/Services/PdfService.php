<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
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
    public function generatePatientReport(array $data, string $view = 'Reports.paciente')
    {
        // Cargar la vista y generar el PDF
        $pdf = Pdf::loadView($view, compact('data'));

        return $pdf;
    }
}