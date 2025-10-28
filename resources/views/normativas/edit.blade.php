@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Normativa</h1>
@include('partials.flash')
<form action="{{ route('normativas.update', $normativa) }}" method="POST" class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 max-w-xl mx-auto">
    @csrf
    @method('PUT')
    @include('normativas.partials.form')
    <div class="mt-6 flex justify-end">
        <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-full font-semibold shadow hover:bg-red-700 transition">Actualizar</button>
    </div>
</form>
@endsection