<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Normativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NormativaApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Normativa::query();
        // Filtros básicos
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        if ($request->filled('area')) {
            $query->where('area', $request->area);
        }
        return response()->json($query->paginate(15));
    }

    public function show(Normativa $normativa)
    {
        return response()->json($normativa);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date',
            'estado' => 'required|string',
            'entidad_emisora' => 'required|string|max:255',
            'responsable_id' => 'required|exists:users,id',
            'notas' => 'nullable|string',
        ]);
        $normativa = Normativa::create($validated);
        return response()->json($normativa, 201);
    }

    public function update(Request $request, Normativa $normativa)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|string|max:255',
            'area' => 'sometimes|required|string|max:255',
            'fecha_emision' => 'sometimes|required|date',
            'fecha_vencimiento' => 'sometimes|required|date',
            'estado' => 'sometimes|required|string',
            'entidad_emisora' => 'sometimes|required|string|max:255',
            'responsable_id' => 'sometimes|required|exists:users,id',
            'notas' => 'nullable|string',
        ]);
        $normativa->update($validated);
        return response()->json($normativa);
    }

    public function destroy(Normativa $normativa)
    {
        $normativa->delete();
        return response()->json(null, 204);
    }
}
