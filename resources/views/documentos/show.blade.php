@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded">
    <h1 class="text-2xl font-bold mb-4">Detalle de Documento</h1>
    {{-- Predicción IA eliminada por optimización de rendimiento --}}
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <dt class="font-semibold">Normativa:</dt>
        <dd>{{ $documento->normativa->nombre ?? '-' }}</dd>
        <dt class="font-semibold">Nombre Archivo:</dt>
        <dd>{{ $documento->nombre_archivo }}</dd>
        <dt class="font-semibold">Versión:</dt>
        <dd>{{ $documento->version }}</dd>
        <dt class="font-semibold">Subido por:</dt>
        <dd>{{ $documento->uploader->name ?? '-' }}</dd>
        <dt class="font-semibold">Fecha de Subida:</dt>
        <dd>{{ $documento->uploaded_at->format('d/m/Y') }}</dd>
        <dt class="font-semibold">Archivo:</dt>
        <dd><a href="{{ asset('storage/' . $documento->ruta_archivo) }}" target="_blank" class="text-blue-600 hover:underline">Descargar / Ver</a></dd>
    </dl>

    <h2 class="text-xl font-semibold mt-8 mb-2">Historial de Versiones</h2>
    <table class="min-w-full bg-white border rounded text-sm">
        <thead>
            <tr>
                <th class="px-2 py-1">Versión</th>
                <th class="px-2 py-1">Archivo</th>
                <th class="px-2 py-1">Subido por</th>
                <th class="px-2 py-1">Fecha</th>
                <th class="px-2 py-1">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($versiones as $v)
            <tr>
                <td class="border px-2 py-1">{{ $v->version }}</td>
                <td class="border px-2 py-1">{{ $v->nombre_archivo }}</td>
                <td class="border px-2 py-1">{{ $v->uploader->name ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $v->uploaded_at->format('d/m/Y H:i') }}</td>
                <td class="border px-2 py-1"><a href="{{ asset('storage/' . $v->ruta_archivo) }}" target="_blank" class="text-blue-600 hover:underline">Descargar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6 flex justify-between">
        <a href="{{ route('documentos.edit', $documento) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
        <a href="{{ route('documentos.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Volver</a>
    </div>
</div>
@endsection