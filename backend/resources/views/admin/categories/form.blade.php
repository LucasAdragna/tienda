@csrf

<div class="input-style-1">
    <label for="name">Nombre</label>
    <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" maxlength="80" required>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="input-style-1">
            <label for="description">Descripcion</label>
            <textarea id="description" name="description" rows="4" maxlength="500">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="sort_order">Orden</label>
            <input type="number" id="sort_order" name="sort_order" min="0" max="999" value="{{ old('sort_order', $category->sort_order ?? 1) }}">
        </div>
    </div>
</div>

<div class="d-flex flex-wrap gap-4 mb-30">
    <div class="form-check checkbox-style">
        <input class="form-check-input" type="checkbox" value="1" id="is_visible" name="is_visible" @checked(old('is_visible', $category->is_visible ?? true))>
        <label class="form-check-label" for="is_visible">Categoria visible</label>
    </div>
    <div class="form-check checkbox-style">
        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $category->is_active ?? true))>
        <label class="form-check-label" for="is_active">Categoria activa</label>
    </div>
</div>

<div class="d-flex gap-2">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.categorias.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
