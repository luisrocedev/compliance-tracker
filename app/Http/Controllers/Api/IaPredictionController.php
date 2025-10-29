<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Normativa;
use App\Models\Documento;
use Illuminate\Http\Request;

class IaPredictionController extends Controller
{
    public function normativa($id)
    {
        $normativa = Normativa::findOrFail($id);
        $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$normativa->nombre}, Tipo: {$normativa->tipo}, Estado: {$normativa->estado}, Fecha de emisión: {$normativa->fecha_emision}, Fecha de vencimiento: {$normativa->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
        $prediction = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
        return response()->json(['prediccion' => $prediction]);
    }

    public function documento($id)
    {
        $documento = Documento::with('normativa')->findOrFail($id);
        $fechaVenc = $documento->normativa->fecha_vencimiento ?? null;
        $prompt = "Dado el siguiente documento, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$documento->nombre_archivo}, Versión: {$documento->version}, Fecha de emisión: {$documento->fecha_emision}, Fecha de vencimiento: {$fechaVenc}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
        $prediction = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
        return response()->json(['prediccion' => $prediction]);
    }
}
