@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto bg-white p-10 rounded-2xl shadow-lg border border-gray-100">
    <h1 class="text-4xl font-extrabold mb-4 tracking-tight text-black">Bienvenido al <span class="text-red-600">Compliance Tracker</span></h1>
    <p class="mb-8 text-lg text-gray-700">Gestiona normativas, documentos, alertas y auditoría de forma centralizada y segura.</p>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <a href="{{ route('normativas.index') }}" class="group block bg-white border border-gray-200 hover:border-red-600 hover:shadow-lg p-8 rounded-xl text-center transition">
            <span class="text-2xl font-bold text-black group-hover:text-red-600 transition">Normativas</span>
            <div class="mt-2 text-gray-500 text-sm">Consulta y administra el marco normativo.</div>
        </a>
        <a href="{{ route('documentos.index') }}" class="group block bg-white border border-gray-200 hover:border-red-600 hover:shadow-lg p-8 rounded-xl text-center transition">
            <span class="text-2xl font-bold text-black group-hover:text-red-600 transition">Documentos</span>
            <div class="mt-2 text-gray-500 text-sm">Gestiona archivos y versiones asociadas.</div>
        </a>
        <a href="{{ route('alertas.index') }}" class="group block bg-white border border-gray-200 hover:border-red-600 hover:shadow-lg p-8 rounded-xl text-center transition">
            <span class="text-2xl font-bold text-black group-hover:text-red-600 transition">Alertas</span>
            <div class="mt-2 text-gray-500 text-sm">Visualiza y programa alertas clave.</div>
        </a>
        <a href="{{ route('auditoria.index') }}" class="group block bg-white border border-gray-200 hover:border-red-600 hover:shadow-lg p-8 rounded-xl text-center transition">
            <span class="text-2xl font-bold text-black group-hover:text-red-600 transition">Auditoría</span>
            <div class="mt-2 text-gray-500 text-sm">Revisa el historial de acciones del sistema.</div>
        </a>
    </div>
</div>
@if(isset($prediccionesNormativas) && count($prediccionesNormativas))
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
        Próximas renovaciones (Normativas)
    </h2>
    <ul class="bg-white border rounded divide-y">
        @foreach($prediccionesNormativas as $p)
        <li class="flex items-center justify-between px-4 py-3">
            <div>
                <span class="font-semibold">{{ $p['nombre'] }}</span>
                <span class="ml-2 text-gray-500 text-sm">(Vence: {{ \Carbon\Carbon::parse($p['fecha_vencimiento'])->format('d/m/Y') }})</span>
            </div>
            <span data-ia-normativa="{{ $p['id'] }}" class="block"></span>
        </li>
        @endforeach
    </ul>
</div>
@endif

@if(isset($prediccionesDocumentos) && count($prediccionesDocumentos))
<div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
        Próximas renovaciones (Documentos)
    </h2>
    <ul class="bg-white border rounded divide-y">
        @foreach($prediccionesDocumentos as $p)
        <li class="flex items-center justify-between px-4 py-3">
            <div>
                <span class="font-semibold">{{ $p['nombre'] }}</span>
                <span class="ml-2 text-gray-500 text-sm">(Vence: {{ \Carbon\Carbon::parse($p['fecha_vencimiento'])->format('d/m/Y') }})</span>
            </div>
            <span data-ia-documento="{{ $p['id'] }}" class="block"></span>
        </li>
        @endforeach
    </ul>
</div>
@endif
@endsection