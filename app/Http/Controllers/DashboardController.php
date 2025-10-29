<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $normativas = \App\Models\Normativa::whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(60))
            ->orderBy('fecha_vencimiento')
            ->limit(5)
            ->get();

        $documentos = \App\Models\Documento::with('normativa')
            ->whereHas('normativa', function ($q) {
                $q->whereDate('fecha_vencimiento', '>=', now())
                    ->whereDate('fecha_vencimiento', '<=', now()->addDays(60));
            })
            ->orderByDesc('uploaded_at')
            ->limit(5)
            ->get();

        $prediccionesNormativas = [];
        foreach ($normativas as $n) {
            $cacheKey = 'prediction:normativa:' . $n->id;
            $pred = Cache::get($cacheKey);
            if ($pred === null) {
                $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$n->nombre}, Tipo: {$n->tipo}, Estado: {$n->estado}, Fecha de emisión: {$n->fecha_emision}, Fecha de vencimiento: {$n->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
                \App\Jobs\ProcessNormativaPredictionJob::dispatch($n->id, $prompt);
                $pred = 'Procesando...';
            }
            $prediccionesNormativas[] = [
                'id' => $n->id,
                'nombre' => $n->nombre,
                'fecha_vencimiento' => $n->fecha_vencimiento,
                'prediccion' => $pred,
            ];
        }

        $prediccionesDocumentos = [];
        foreach ($documentos as $d) {
            $cacheKey = 'prediction:documento:' . $d->id;
            $pred = Cache::get($cacheKey);
            $fechaVenc = $d->normativa->fecha_vencimiento ?? null;
            if ($pred === null) {
                $prompt = "Dado el siguiente documento, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$d->nombre_archivo}, Versión: {$d->version}, Fecha de emisión: {$d->fecha_emision}, Fecha de vencimiento: {$fechaVenc}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
                \App\Jobs\ProcessDocumentoPredictionJob::dispatch($d->id, $prompt);
                $pred = 'Procesando...';
            }
            $prediccionesDocumentos[] = [
                'id' => $d->id,
                'nombre' => $d->nombre_archivo,
                'fecha_vencimiento' => $fechaVenc,
                'prediccion' => $pred,
            ];
        }

        return view('dashboard', compact('prediccionesNormativas', 'prediccionesDocumentos'));
    }
}
