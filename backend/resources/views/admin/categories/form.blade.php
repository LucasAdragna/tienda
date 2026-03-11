@csrf

<div class="input-style-1">
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" maxlength="80" required>
</div>

<div class="input-style-1">
    <label for="description">Descripcion</label>
    <textarea id="description" name="description" rows="4" maxlength="500">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div class="form-check checkbox-style mb-30">
    <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $category->is_active ?? true))>
    <label class="form-check-label" for="is_active">Categoria activa</label>
</div>

<div class="d-flex gap-2">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.categorias.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
