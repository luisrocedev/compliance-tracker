<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Alerta::query();
        if ($request->filled('normativa_id')) {
            $query->where('normativa_id', $request->normativa_id);
        }
        return response()->json($query->paginate(15));
    }

    public function show(Alerta $alerta)
    {
        return response()->json($alerta);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'tipo_alerta' => 'required|string',
            'fecha_programada' => 'required|date',
            'enviado' => 'required|boolean',
        ]);
        $alerta = Alerta::create($validated);
        return response()->json($alerta, 201);
    }

    public function update(Request $request, Alerta $alerta)
    {
        $validated = $request->validate([
            'tipo_alerta' => 'sometimes|required|string',
            'fecha_programada' => 'sometimes|required|date',
            'enviado' => 'sometimes|required|boolean',
        ]);
        $alerta->update($validated);
        return response()->json($alerta);
    }

    public function destroy(Alerta $alerta)
    {
        $alerta->delete();
        return response()->json(null, 204);
    }
}
