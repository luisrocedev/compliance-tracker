@extends('layouts.app')
@section('content')
<div class="mb-4 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
    <h1 class="text-2xl font-bold">Normativas</h1>
    <form method="GET" class="flex flex-wrap gap-2 items-end bg-gray-50 p-3 rounded shadow">
        <input type="text" name="busqueda" value="{{ request('busqueda') }}" class="border rounded px-2 py-1 text-sm" placeholder="Buscar normativa, tipo, área, estado...">
        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow hover:bg-red-700 transition">Buscar</button>
        <a href="{{ route('normativas.index') }}" class="text-xs text-gray-500 underline ml-2">Limpiar</a>
    </form>
    <a href="{{ route('normativas.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-full font-semibold shadow hover:bg-red-700 transition">Nueva Normativa</a>
</div>
@include('partials.flash')
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Área</th>
                <th class="px-4 py-2">Nº Documento</th>
                <th class="px-4 py-2">Vencimiento</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($normativas as $normativa)
            <tr class="hover:bg-gray-50 transition">
                <td class="border px-4 py-2">{{ $normativa->nombre }}</td>
                <td class="border px-4 py-2">{{ $normativa->tipo }}</td>
                <td class="border px-4 py-2">{{ $normativa->area }}</td>
                <td class="border px-4 py-2">{{ $normativa->numero_documento }}</td>
                <td class="border px-4 py-2">{{ $normativa->fecha_vencimiento->format('d/m/Y') }}</td>
                <td class="border px-4 py-2">{{ $normativa->estado }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <a href="{{ route('normativas.show', $normativa) }}" class="text-red-600 font-semibold hover:underline">Ver</a>
                    <a href="{{ route('normativas.edit', $normativa) }}" class="text-gray-700 font-semibold hover:text-yellow-600 hover:underline">Editar</a>
                    <form action="{{ route('normativas.destroy', $normativa) }}" method="POST" onsubmit="return confirm('¿Eliminar normativa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 rounded-full px-3 py-1 font-semibold shadow hover:bg-red-700 transition">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 py-4">No se encontraron normativas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $normativas->links() }}
</div>
@endsection