@extends('layouts.app')
@section('content')
<div class="mb-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Documentos</h1>
    <a href="{{ route('documentos.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-full font-semibold shadow hover:bg-red-700 transition">Nuevo Documento</a>
</div>
@include('partials.flash')
<table class="min-w-full bg-white border rounded shadow">
    <thead>
        <tr>
            <th class="px-4 py-2">Normativa</th>
            <th class="px-4 py-2">Archivo</th>
            <th class="px-4 py-2">Versión</th>
            <th class="px-4 py-2">Subido por</th>
            <th class="px-4 py-2">Fecha</th>
            <th class="px-4 py-2">Predicción IA</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentos as $documento)
        <tr class="hover:bg-gray-50 transition">
            <td class="border px-4 py-2">{{ $documento->normativa->nombre ?? '-' }}</td>
            <td class="border px-4 py-2"><a href="{{ route('documentos.show', $documento) }}" class="text-red-600 font-semibold hover:underline">{{ $documento->nombre_archivo }}</a></td>
            <td class="border px-4 py-2">{{ $documento->version }}</td>
            <td class="border px-4 py-2">{{ $documento->uploader->name ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $documento->uploaded_at->format('d/m/Y') }}</td>
            <td class="border px-4 py-2">
                @php $pred = $predicciones[$documento->id] ?? null; @endphp
                @if($pred === 'Procesando...')
                <span class="animate-spin inline-block w-4 h-4 border-2 border-red-600 border-t-transparent rounded-full align-middle"></span>
                <span class="text-xs text-gray-500">Procesando...</span>
                @elseif($pred)
                <span class='inline-block px-3 py-1 rounded-full text-xs font-bold'>{{ $pred }}</span>
                @else
                <span class="text-xs text-gray-500">Sin datos</span>
                @endif
            </td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('documentos.edit', $documento) }}" class="text-gray-700 font-semibold hover:text-yellow-600 hover:underline">Editar</a>
                <form action="{{ route('documentos.destroy', $documento) }}" method="POST" onsubmit="return confirm('¿Eliminar documento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 rounded-full px-3 py-1 font-semibold shadow hover:bg-red-700 transition">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection