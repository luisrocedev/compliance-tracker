<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Normativa;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IaPredictionController extends Controller
{
    public function normativa($id)
    {
        // TODO: Reactivar cuando se configure API de pago o solución estable
        return response()->json(['prediccion' => '[IA PAUSADA TEMPORALMENTE: funcionalidad desactivada por límites de uso. Contacta al administrador.]']);
    }

    public function documento($id)
    {
        // TODO: Reactivar cuando se configure API de pago o solución estable
        return response()->json(['prediccion' => '[IA PAUSADA TEMPORALMENTE: funcionalidad desactivada por límites de uso. Contacta al administrador.]']);
    }
}
