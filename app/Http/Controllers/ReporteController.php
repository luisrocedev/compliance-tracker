<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

class ReporteController extends Controller
{
    /**
     * Exporta el reporte filtrado a PDF.
     */
    public function exportarPdf(Request $request)
    {
        // TODO: aplicar filtros y pasar datos reales
        $data = [
            ['nombre' => 'Normativa X', 'area' => 'Laboral', 'estado' => 'Vigente', 'responsable' => 'Juan Pérez', 'fecha_emision' => '01/01/2024', 'fecha_vencimiento' => '01/01/2025'],
        ];
        $pdf = Pdf::loadView('reportes.pdf', ['registros' => $data]);
        return $pdf->download('reporte.pdf');
    }

    /**
     * Exporta el reporte filtrado a Excel.
     */
    public function exportarExcel(Request $request)
    {
        // TODO: aplicar filtros y pasar datos reales
        $data = [
            ['Nombre' => 'Normativa X', 'Área' => 'Laboral', 'Estado' => 'Vigente', 'Responsable' => 'Juan Pérez', 'Fecha Emisión' => '01/01/2024', 'Fecha Vencimiento' => '01/01/2025'],
        ];
        return Excel::download(new ReporteExport($data), 'reporte.xlsx');
    }
    /**
     * Muestra la vista principal de reportes con filtros.
     */
    public function index(Request $request)
    {
        // TODO: aplicar filtros y pasar datos reales
        return view('reportes.index');
    }
}
