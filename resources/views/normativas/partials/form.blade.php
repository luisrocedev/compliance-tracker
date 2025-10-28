<div class="mb-4">
    <label class="block font-semibold mb-1">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $normativa->nombre ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('nombre')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Tipo</label>
    <input type="text" name="tipo" value="{{ old('tipo', $normativa->tipo ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('tipo')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Área</label>
    <select name="area" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        <option value="laboral" @selected(old('area', $normativa->area ?? '')=='laboral')>Laboral</option>
        <option value="ambiental" @selected(old('area', $normativa->area ?? '')=='ambiental')>Ambiental</option>
        <option value="seguridad" @selected(old('area', $normativa->area ?? '')=='seguridad')>Seguridad</option>
        <option value="datos" @selected(old('area', $normativa->area ?? '')=='datos')>Datos</option>
    </select>
    @error('area')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">N° Documento</label>
    <input type="text" name="numero_documento" value="{{ old('numero_documento', $normativa->numero_documento ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('numero_documento')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Fecha Emisión</label>
    <input type="date" name="fecha_emision" value="{{ old('fecha_emision', isset($normativa->fecha_emision) ? $normativa->fecha_emision->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2" required>
    @error('fecha_emision')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Fecha Vencimiento</label>
    <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', isset($normativa->fecha_vencimiento) ? $normativa->fecha_vencimiento->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2" required>
    @error('fecha_vencimiento')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Estado</label>
    <select name="estado" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        <option value="vigente" @selected(old('estado', $normativa->estado ?? '')=='vigente')>Vigente</option>
        <option value="por_vencer" @selected(old('estado', $normativa->estado ?? '')=='por_vencer')>Por Vencer</option>
        <option value="vencido" @selected(old('estado', $normativa->estado ?? '')=='vencido')>Vencido</option>
        <option value="en_renovacion" @selected(old('estado', $normativa->estado ?? '')=='en_renovacion')>En Renovación</option>
    </select>
    @error('estado')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Entidad Emisora</label>
    <input type="text" name="entidad_emisora" value="{{ old('entidad_emisora', $normativa->entidad_emisora ?? '') }}" class="w-full border rounded px-3 py-2" required>
    @error('entidad_emisora')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Responsable</label>
    <select name="responsable_id" class="w-full border rounded px-3 py-2" required>
        <option value="">Seleccione</option>
        @foreach($usuarios as $usuario)
        <option value="{{ $usuario->id }}" @selected(old('responsable_id', $normativa->responsable_id ?? '')==$usuario->id)>{{ $usuario->name }}</option>
        @endforeach
    </select>
    @error('responsable_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Notas</label>
    <textarea name="notas" class="w-full border rounded px-3 py-2">{{ old('notas', $normativa->notas ?? '') }}</textarea>
    @error('notas')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
</div>