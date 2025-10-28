@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded">
    <h1 class="text-2xl font-bold mb-4">Detalle de Alerta</h1>
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <dt class="font-semibold">Normativa:</dt>
        <dd>{{ $alerta->normativa->nombre ?? '-' }}</dd>
        <dt class="font-semibold">Tipo de Alerta:</dt>
        <dd>{{ $alerta->tipo_alerta }}</dd>
        <dt class="font-semibold">Fecha Programada:</dt>
        <dd>{{ $alerta->fecha_programada->format('d/m/Y') }}</dd>
        <dt class="font-semibold">Enviado:</dt>
        <dd>{{ $alerta->enviado ? 'Sí' : 'No' }}</dd>
        <dt class="font-semibold">Enviado el:</dt>
        <dd>{{ $alerta->enviado_at ? $alerta->enviado_at->format('d/m/Y H:i') : '-' }}</dd>
    </dl>
    <div class="mt-6 flex justify-between">
        <a href="{{ route('alertas.edit', $alerta) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
        <a href="{{ route('alertas.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Volver</a>
    </div>
</div>
@endsection