<div class="mb-4">
    <label class="block font-semibold mb-1">Normativa</label>
    <select name="normativa_id" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        @foreach($normativas as $normativa)
        <option value="{{ $normativa->id }}" @selected(old('normativa_id', $alerta->normativa_id ?? '')==$normativa->id)>{{ $normativa->nombre }}</option>
        @endforeach
    </select>
    @error('normativa_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Tipo de Alerta</label>
    <select name="tipo_alerta" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        <option value="30d" @selected(old('tipo_alerta', $alerta->tipo_alerta ?? '')=='30d')>30 días antes</option>
        <option value="15d" @selected(old('tipo_alerta', $alerta->tipo_alerta ?? '')=='15d')>15 días antes</option>
        <option value="7d" @selected(old('tipo_alerta', $alerta->tipo_alerta ?? '')=='7d')>7 días antes</option>
    </select>
    @error('tipo_alerta')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Fecha Programada</label>
    <input type="date" name="fecha_programada" value="{{ old('fecha_programada', isset($alerta->fecha_programada) ? $alerta->fecha_programada->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2" required>
    @error('fecha_programada')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Enviado</label>
    <select name="enviado" class="w-full border rounded px-3 py-2" required>
        <option value="0" @selected(old('enviado', $alerta->enviado ?? 0)==0)>No</option>
        <option value="1" @selected(old('enviado', $alerta->enviado ?? 0)==1)>Sí</option>
    </select>
    @error('enviado')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>