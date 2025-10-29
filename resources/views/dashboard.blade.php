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
{{--
    TODO: Reactivar sección de predicciones IA cuando se habilite la funcionalidad IA
    @if(isset($prediccionesNormativas) && count($prediccionesNormativas))
    ...sección de prediccionesNormativas...
    @endif
    @if(isset($prediccionesDocumentos) && count($prediccionesDocumentos))
    ...sección de prediccionesDocumentos...
    @endif
--}}
@endsection