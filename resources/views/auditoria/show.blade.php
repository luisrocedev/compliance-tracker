@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded">
    <h1 class="text-2xl font-bold mb-4">Detalle de Auditoría</h1>
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <dt class="font-semibold">Usuario:</dt>
        <dd>{{ $auditoria->user->name ?? '-' }}</dd>
        <dt class="font-semibold">Acción:</dt>
        <dd>{{ $auditoria->accion }}</dd>
        <dt class="font-semibold">Tabla Afectada:</dt>
        <dd>{{ $auditoria->tabla_afectada }}</dd>
        <dt class="font-semibold">Registro ID:</dt>
        <dd>{{ $auditoria->registro_id }}</dd>
        <dt class="font-semibold">Detalles:</dt>
        <dd>
            <pre class="whitespace-pre-wrap text-xs">{{ json_encode($auditoria->detalles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </dd>
        <dt class="font-semibold">IP:</dt>
        <dd>{{ $auditoria->ip }}</dd>
        <dt class="font-semibold">Fecha:</dt>
        <dd>{{ $auditoria->created_at->format('d/m/Y H:i') }}</dd>
    </dl>
    <div class="mt-6 flex justify-between">
        <a href="{{ route('auditoria.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Volver</a>
    </div>
</div>
@endsection