<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Services\PdfService;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function descargarReporte($id)
    {
        $paciente = Paciente::findOrFail($id);
        $pdf = Pdf::loadView('reportes.historial', compact('paciente'));

        return $pdf->download("Historial_Paciente_{$paciente->id}.pdf");
    }
}
