<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener normativas y documentos próximos a vencer (ejemplo: próximos 60 días)
        $normativas = \App\Models\Normativa::whereDate('fecha_vencimiento', '>=', now())
            ->whereDate('fecha_vencimiento', '<=', now()->addDays(60))
            ->orderBy('fecha_vencimiento')
            ->limit(5)
            ->get();


        // Documentos cuya normativa asociada vence pronto
        $documentos = \App\Models\Documento::with('normativa')
            ->whereHas('normativa', function ($q) {
                $q->whereDate('fecha_vencimiento', '>=', now())
                    ->whereDate('fecha_vencimiento', '<=', now()->addDays(60));
            })
            ->orderByDesc('uploaded_at')
            ->limit(5)
            ->get();

        // Predicciones IA (solo nombre y predicción, para no saturar la API)
        $prediccionesNormativas = [];
        foreach ($normativas as $n) {
            try {
                $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$n->nombre}, Tipo: {$n->tipo}, Estado: {$n->estado}, Fecha de emisión: {$n->fecha_emision}, Fecha de vencimiento: {$n->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
                $pred = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
            } catch (\Exception $e) {
                $pred = null;
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
            $fechaVenc = $d->normativa->fecha_vencimiento ?? null;
            try {
                $prompt = "Dado el siguiente documento, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$d->nombre_archivo}, Versión: {$d->version}, Fecha de emisión: {$d->fecha_emision}, Fecha de vencimiento: {$fechaVenc}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
                $pred = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
            } catch (\Exception $e) {
                $pred = null;
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
