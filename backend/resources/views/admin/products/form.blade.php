@csrf

<div class="row">
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" maxlength="120" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="select-style-1">
            <label for="category_id">Tipo de habitacion</label>
            <div class="select-position">
                <select id="category_id" name="category_id">
                    <option value="">Sin tipo</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) old('category_id', $product->category_id ?? '') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="input-style-1">
            <label for="description">Descripcion</label>
            <textarea id="description" name="description" rows="4" maxlength="1000">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="price">Tarifa por noche</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="stock">Disponibles</label>
            <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-center">
        <div class="form-check checkbox-style mb-30">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $product->is_active ?? true))>
            <label class="form-check-label" for="is_active">Habitacion activa</label>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-3">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.productos.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
