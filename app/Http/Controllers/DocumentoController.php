<?php

namespace App\Http\Controllers;


use App\Models\Documento;
use App\Models\Normativa;
use App\Models\User;
use App\Models\DocumentoVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentos = Documento::with(['normativa', 'uploader'])->orderByDesc('uploaded_at')->get();
        return view('documentos.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $normativas = Normativa::all();
        return view('documentos.create', compact('normativas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'archivo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'version' => 'required|string|max:50',
        ]);

        $file = $request->file('archivo');
        $nombreArchivo = $file->getClientOriginalName();
        $ruta = $file->store('documents', 'public');

        $documento = Documento::create([
            'normativa_id' => $request->normativa_id,
            'nombre_archivo' => $nombreArchivo,
            'ruta_archivo' => $ruta,
            'version' => $request->version,
            'uploaded_at' => now(),
            'uploaded_by' => Auth::id(),
        ]);

        // Guardar versión inicial
        DocumentoVersion::create([
            'documento_id' => $documento->id,
            'nombre_archivo' => $nombreArchivo,
            'ruta_archivo' => $ruta,
            'version' => $request->version,
            'uploaded_at' => now(),
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()->route('documentos.index')->with('success', 'Documento subido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Documento $documento)
    {
        $documento->load(['normativa', 'uploader', 'versiones.uploader']);
        $versiones = $documento->versiones()->orderByDesc('uploaded_at')->get();
        return view('documentos.show', compact('documento', 'versiones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documento $documento)
    {
        $normativas = Normativa::all();
        return view('documentos.edit', compact('documento', 'normativas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documento $documento)
    {
        $request->validate([
            'normativa_id' => 'required|exists:normativas,id',
            'version' => 'required|string|max:50',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $data = [
            'normativa_id' => $request->normativa_id,
            'version' => $request->version,
        ];

        if ($request->hasFile('archivo')) {
            // Guardar versión anterior antes de sobrescribir
            DocumentoVersion::create([
                'documento_id' => $documento->id,
                'nombre_archivo' => $documento->nombre_archivo,
                'ruta_archivo' => $documento->ruta_archivo,
                'version' => $documento->version,
                'uploaded_at' => $documento->uploaded_at,
                'uploaded_by' => $documento->uploaded_by,
            ]);

            // Eliminar archivo anterior
            if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
                Storage::disk('public')->delete($documento->ruta_archivo);
            }
            $file = $request->file('archivo');
            $nombreArchivo = $file->getClientOriginalName();
            $ruta = $file->store('documents', 'public');
            $data['nombre_archivo'] = $nombreArchivo;
            $data['ruta_archivo'] = $ruta;
            $data['uploaded_at'] = now();
            $data['uploaded_by'] = Auth::id();
        }

        $documento->update($data);

        return redirect()->route('documentos.index')->with('success', 'Documento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documento $documento)
    {
        if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
            Storage::disk('public')->delete($documento->ruta_archivo);
        }
        $documento->delete();
        return redirect()->route('documentos.index')->with('success', 'Documento eliminado correctamente.');
    }
}
