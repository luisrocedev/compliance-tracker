@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded">
    <h1 class="text-2xl font-bold mb-4">Detalle de Normativa</h1>
    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <dt class="font-semibold">Nombre:</dt>
        <dd>{{ $normativa->nombre }}</dd>
        <dt class="font-semibold">Tipo:</dt>
        <dd>{{ $normativa->tipo }}</dd>
        <dt class="font-semibold">Área:</dt>
        <dd>{{ $normativa->area }}</dd>
        <dt class="font-semibold">N° Documento:</dt>
        <dd>{{ $normativa->numero_documento }}</dd>
        <dt class="font-semibold">Fecha Emisión:</dt>
        <dd>{{ $normativa->fecha_emision->format('d/m/Y') }}</dd>
        <dt class="font-semibold">Fecha Vencimiento:</dt>
        <dd>{{ $normativa->fecha_vencimiento->format('d/m/Y') }}</dd>
        <dt class="font-semibold">Estado:</dt>
        <dd>{{ $normativa->estado }}</dd>
        <dt class="font-semibold">Entidad Emisora:</dt>
        <dd>{{ $normativa->entidad_emisora }}</dd>
        <dt class="font-semibold">Responsable:</dt>
        <dd>{{ $normativa->responsable->name ?? '-' }}</dd>
        <dt class="font-semibold">Notas:</dt>
        <dd>{{ $normativa->notas }}</dd>
    </dl>
    <div class="mt-6 flex justify-between">
        <a href="{{ route('normativas.edit', $normativa) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Editar</a>
        <a href="{{ route('normativas.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Volver</a>
    </div>
</div>
@endsection