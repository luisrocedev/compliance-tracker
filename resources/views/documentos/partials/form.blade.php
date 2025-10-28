<div class="mb-4">
    <label class="block font-semibold mb-1">Normativa</label>
    <select name="normativa_id" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        @foreach($normativas as $normativa)
        <option value="{{ $normativa->id }}" @selected(old('normativa_id', $documento->normativa_id ?? '')==$normativa->id)>{{ $normativa->nombre }}</option>
        @endforeach
    </select>
    @error('normativa_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Archivo</label>
    <input type="file" name="archivo" class="w-full border rounded px-3 py-2" @if(!isset($documento)) required @endif>
    @if(isset($documento) && $documento->ruta_archivo)
    <a href="{{ asset('storage/' . $documento->ruta_archivo) }}" target="_blank" class="text-blue-600 hover:underline">Ver archivo actual</a>
    @endif
    @error('archivo')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Versión</label>
    <input type="text" name="version" value="{{ old('version', $documento->version ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('version')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>