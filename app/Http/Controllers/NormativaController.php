<?php

namespace App\Http\Controllers;

use App\Models\Normativa;
use Illuminate\Http\Request;

class NormativaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Normativa::query();
        if ($request->filled('busqueda')) {
            $q = $request->busqueda;
            $query->where(function ($sub) use ($q) {
                $sub->where('nombre', 'like', "%$q%")
                    ->orWhere('tipo', 'like', "%$q%")
                    ->orWhere('area', 'like', "%$q%")
                    ->orWhere('numero_documento', 'like', "%$q%")
                    ->orWhere('estado', 'like', "%$q%")
                ;
            });
        }
        $normativas = $query->orderByDesc('created_at')->paginate(10)->appends($request->all());

        // Predicciones IA para cada normativa en la tabla (solo página actual)
        $predicciones = [];
        foreach ($normativas as $n) {
            try {
                $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$n->nombre}, Tipo: {$n->tipo}, Estado: {$n->estado}, Fecha de emisión: {$n->fecha_emision}, Fecha de vencimiento: {$n->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
                $pred = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
            } catch (\Exception $e) {
                $pred = null;
            }
            $predicciones[$n->id] = $pred;
        }
        return view('normativas.index', compact('normativas', 'predicciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = \App\Models\User::all();
        return view('normativas.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'area' => 'required|string',
            'numero_documento' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_emision',
            'estado' => 'required|string',
            'entidad_emisora' => 'required|string|max:255',
            'responsable_id' => 'required|exists:users,id',
            'notas' => 'nullable|string',
        ]);
        Normativa::create($validated);
        return redirect()->route('normativas.index')->with('success', 'Normativa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Normativa $normativa)
    {
        // Lógica para predicción IA
        $prediction = null;
        try {
            $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$normativa->nombre}, Tipo: {$normativa->tipo}, Estado: {$normativa->estado}, Fecha de emisión: {$normativa->fecha_emision}, Fecha de vencimiento: {$normativa->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
            $prediction = app(\App\Services\OpenRouterService::class)->predictRenewal($prompt);
        } catch (\Exception $e) {
            $prediction = null;
        }
        return view('normativas.show', compact('normativa', 'prediction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Normativa $normativa)
    {
        $usuarios = \App\Models\User::all();
        return view('normativas.edit', compact('normativa', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Normativa $normativa)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'area' => 'required|string',
            'numero_documento' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'fecha_vencimiento' => 'required|date|after_or_equal:fecha_emision',
            'estado' => 'required|string',
            'entidad_emisora' => 'required|string|max:255',
            'responsable_id' => 'required|exists:users,id',
            'notas' => 'nullable|string',
        ]);
        $normativa->update($validated);
        return redirect()->route('normativas.index')->with('success', 'Normativa actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Normativa $normativa)
    {
        //
    }
}
