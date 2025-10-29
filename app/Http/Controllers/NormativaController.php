<?php

namespace App\Http\Controllers;



use App\Models\Normativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class NormativaController extends Controller
{
    public function generarPrediccion(Normativa $normativa)
    {
        $cacheKey = 'prediction:normativa:' . $normativa->id;
        $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$normativa->nombre}, Tipo: {$normativa->tipo}, Estado: {$normativa->estado}, Fecha de emisión: {$normativa->fecha_emision}, Fecha de vencimiento: {$normativa->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
        \App\Jobs\ProcessNormativaPredictionJob::dispatch($normativa->id, $prompt);
        Cache::put($cacheKey, 'Procesando...', now()->addMinutes(5));
        return redirect()->route('normativas.show', $normativa)->with('success', 'Predicción IA en proceso. Recarga en unos segundos.');
    }
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
        return view('normativas.index', compact('normativas'));
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
        $cacheKey = 'prediction:normativa:' . $normativa->id;
        $prediction = Cache::get($cacheKey);
        if ($prediction === null) {
            $prompt = "Dada la siguiente normativa, predice la probabilidad de que requiera renovación pronto y justifica brevemente. Datos: Nombre: {$normativa->nombre}, Tipo: {$normativa->tipo}, Estado: {$normativa->estado}, Fecha de emisión: {$normativa->fecha_emision}, Fecha de vencimiento: {$normativa->fecha_vencimiento}. Responde solo con: 'Alta', 'Media' o 'Baja' y una breve justificación.";
            \App\Jobs\ProcessNormativaPredictionJob::dispatch($normativa->id, $prompt);
            $prediction = 'Procesando...';
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
