@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">Reportes Avanzados</h1>
<div class="mb-6 bg-white p-6 rounded shadow">
    <form method="GET" action="{{ route('reportes.index') }}" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-sm font-semibold mb-1">Área</label>
            <select name="area" class="border rounded px-2 py-1">
                <option value="">Todas</option>
                <option value="laboral">Laboral</option>
                <option value="ambiental">Ambiental</option>
                <option value="seguridad">Seguridad</option>
                <option value="datos">Datos</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Estado</label>
            <select name="estado" class="border rounded px-2 py-1">
                <option value="">Todos</option>
                <option value="vigente">Vigente</option>
                <option value="vencido">Vencido</option>
                <option value="por vencer">Por vencer</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Responsable</label>
            <input type="text" name="responsable" class="border rounded px-2 py-1" placeholder="Nombre responsable">
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Rango de fechas</label>
            <input type="date" name="desde" class="border rounded px-2 py-1">
            <span class="mx-1">a</span>
            <input type="date" name="hasta" class="border rounded px-2 py-1">
        </div>
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded font-semibold shadow hover:bg-red-700 transition">Filtrar</button>
    </form>
</div>
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-bold mb-4">Resultados</h2>
    {{-- Aquí se mostrarán los resultados de los reportes filtrados --}}
    <div class="mb-4 flex gap-2">
        <a href="{{ route('reportes.exportar.pdf', request()->all()) }}" class="bg-gray-800 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-gray-900 transition">Exportar PDF</a>
        <a href="{{ route('reportes.exportar.excel', request()->all()) }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm font-semibold hover:bg-green-700 transition">Exportar Excel</a>
    </div>
    <table class="min-w-full bg-white border rounded shadow text-sm">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Área</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Responsable</th>
                <th class="px-4 py-2">Fecha Emisión</th>
                <th class="px-4 py-2">Fecha Vencimiento</th>
            </tr>
        </thead>
        <tbody>
            {{-- Ejemplo de fila --}}
            <tr>
                <td class="border px-4 py-2">Normativa X</td>
                <td class="border px-4 py-2">Laboral</td>
                <td class="border px-4 py-2">Vigente</td>
                <td class="border px-4 py-2">Juan Pérez</td>
                <td class="border px-4 py-2">01/01/2024</td>
                <td class="border px-4 py-2">01/01/2025</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection