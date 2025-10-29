<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Documento::query();
        if ($request->filled('normativa_id')) {
            $query->where('normativa_id', $request->normativa_id);
        }
        return response()->json($query->paginate(15));
    }

    public function show(Documento $documento)
    {
        return response()->json($documento);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'nombre' => 'required|string|max:255',
            'archivo' => 'required|string',
            'version' => 'required|string',
            'uploaded_by' => 'required|exists:users,id',
        ]);
        $documento = Documento::create($validated);
        return response()->json($documento, 201);
    }

    public function update(Request $request, Documento $documento)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'archivo' => 'sometimes|required|string',
            'version' => 'sometimes|required|string',
            'uploaded_by' => 'sometimes|required|exists:users,id',
        ]);
        $documento->update($validated);
        return response()->json($documento);
    }

    public function destroy(Documento $documento)
    {
        $documento->delete();
        return response()->json(null, 204);
    }
}
