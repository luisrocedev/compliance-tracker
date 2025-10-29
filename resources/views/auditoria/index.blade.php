@extends('layouts.app')
@section('content')
<div class="mb-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
    <h1 class="text-2xl font-bold">Historial de Auditoría</h1>
    <form method="GET" class="flex flex-wrap gap-4 items-end bg-gray-50 p-6 rounded-2xl shadow-lg border border-gray-100">
        <div>
            <label class="block text-xs font-semibold mb-1">Usuario</label>
            <input type="text" name="usuario" value="{{ request('usuario') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-40" placeholder="Nombre usuario">
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Acción</label>
            <select name="accion" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-32">
                <option value="">Todas</option>
                @foreach($acciones as $accion)
                <option value="{{ $accion }}" @selected(request('accion')==$accion)> {{ $accion }} </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Tabla</label>
            <select name="tabla" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-32">
                <option value="">Todas</option>
                @foreach($tablas as $tabla)
                <option value="{{ $tabla }}" @selected(request('tabla')==$tabla)> {{ $tabla }} </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Desde</label>
            <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-36">
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Hasta</label>
            <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-36">
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1">Buscar Detalles</label>
            <input type="text" name="busqueda" value="{{ request('busqueda') }}" class="border border-gray-300 rounded-lg px-3 py-2 text-base focus:ring-2 focus:ring-red-200 focus:border-red-400 transition w-48" placeholder="Palabra clave">
        </div>
        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-full text-base font-semibold shadow hover:bg-red-700 transition">Filtrar</button>
        <a href="{{ route('auditoria.index') }}" class="text-xs text-gray-500 underline ml-2">Limpiar</a>
    </form>
</div>
@include('partials.flash')
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow text-xs md:text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-2 py-2">Usuario</th>
                <th class="px-2 py-2">Acción</th>
                <th class="px-2 py-2">Tabla</th>
                <th class="px-2 py-2">Registro</th>
                <th class="px-2 py-2">Detalles</th>
                <th class="px-2 py-2">IP</th>
                <th class="px-2 py-2">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($auditorias as $auditoria)
            <tr class="hover:bg-gray-50 transition">
                <td class="border px-2 py-1">{{ $auditoria->user->name ?? '-' }}</td>
                <td class="border px-2 py-1">{{ $auditoria->accion }}</td>
                <td class="border px-2 py-1">{{ $auditoria->tabla_afectada }}</td>
                <td class="border px-2 py-1">{{ $auditoria->registro_id }}</td>
                <td class="border px-2 py-1 max-w-xs overflow-x-auto">
                    <pre class="whitespace-pre-wrap text-xs">{{ json_encode($auditoria->detalles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                </td>
                <td class="border px-2 py-1">{{ $auditoria->ip }}</td>
                <td class="border px-2 py-1">{{ $auditoria->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 py-4">No se encontraron registros.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $auditorias->links() }}
</div>
@endsection