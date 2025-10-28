<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use Illuminate\Http\Request;

class AlertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alertas = Alerta::with('normativa')->orderByDesc('created_at')->paginate(10);
        return view('alertas.index', compact('alertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $normativas = \App\Models\Normativa::all();
        return view('alertas.create', compact('normativas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'tipo_alerta' => 'required|string',
            'fecha_programada' => 'required|date',
            'enviado' => 'required|boolean',
        ]);
        \App\Models\Alerta::create($validated);
        return redirect()->route('alertas.index')->with('success', 'Alerta creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alerta $alerta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alerta $alerta)
    {
        $normativas = \App\Models\Normativa::all();
        return view('alertas.edit', compact('alerta', 'normativas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alerta $alerta)
    {
        $validated = $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'tipo_alerta' => 'required|string',
            'fecha_programada' => 'required|date',
            'enviado' => 'required|boolean',
        ]);
        $alerta->update($validated);
        return redirect()->route('alertas.index')->with('success', 'Alerta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alerta $alerta)
    {
        //
    }
}
