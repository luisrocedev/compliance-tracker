@extends('layouts.app')
@section('content')
<div class="mb-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold">Alertas</h1>
</div>
@include('partials.flash')
<table class="min-w-full bg-white border rounded shadow">
    <thead>
        <tr>
            <th class="px-4 py-2">Normativa</th>
            <th class="px-4 py-2">Tipo Alerta</th>
            <th class="px-4 py-2">Fecha Programada</th>
            <th class="px-4 py-2">Enviado</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alertas as $alerta)
        <tr class="hover:bg-gray-50 transition">
            <td class="border px-4 py-2">{{ $alerta->normativa->nombre ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $alerta->tipo_alerta }}</td>
            <td class="border px-4 py-2">{{ $alerta->fecha_programada->format('d/m/Y') }}</td>
            <td class="border px-4 py-2">{{ $alerta->enviado ? 'Sí' : 'No' }}</td>
            <td class="border px-4 py-2 flex gap-2">
                <a href="{{ route('alertas.show', $alerta) }}" class="text-red-600 font-semibold hover:underline">Ver</a>
                <a href="{{ route('alertas.edit', $alerta) }}" class="text-gray-700 font-semibold hover:text-yellow-600 hover:underline">Editar</a>
                <form action="{{ route('alertas.destroy', $alerta) }}" method="POST" onsubmit="return confirm('¿Eliminar alerta?');">
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