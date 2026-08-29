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
            <input class="form-check-input" type="checkbox" value="1" id="is_visible" name="is_visible" @checked(old('is_visible', $product->is_visible ?? true))>
            <label class="form-check-label" for="is_visible">Habitacion visible</label>
        </div>
    </div>
    <div class="col-12">
        <div class="input-style-1 mb-20">
            <label for="images">Galeria de imagenes</label>
            <div class="image-upload-field" data-multiple-upload="true">
                <input type="file" id="images" name="images[]" accept=".jpg,.jpeg,.png,.webp" multiple>
                <div class="upload-content">
                    <div class="upload-icon">
                        <i class="lni lni-image"></i>
                    </div>
                    <p class="upload-title">Carga una o mas imagenes de la habitacion</p>
                    <p class="upload-hint">JPG, PNG o WEBP - maximo 4MB por imagen</p>
                    <p class="upload-filename" data-upload-filename>Ningun archivo seleccionado</p>
                </div>
            </div>
            <div class="upload-preview-list mt-3 d-none" data-upload-preview-list></div>
        </div>
    </div>
</div>

@if(isset($product) && $product->images->isNotEmpty())
    <div class="mb-20">
        <label class="form-label d-block">Galeria actual</label>
        <div class="table-wrapper table-responsive data-grid-wrap p-0">
            <table class="table grid-table mb-0">
                <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Orden</th>
                    <th class="text-center">Visible</th>
                    <th class="text-center">Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product->images as $image)
                    @php
                        $imageUrl = str_starts_with($image->path, 'http')
                            ? $image->path
                            : asset('storage/' . $image->path);
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ $imageUrl }}" alt="{{ $product->name }}" style="width: 88px; height: 58px; object-fit: cover; border-radius: 8px; margin: 0;">
                        </td>
                        <td style="max-width: 120px;">
                            <input type="number" name="image_order[{{ $image->id }}]" min="0" max="999" value="{{ old('image_order.' . $image->id, $image->sort_order) }}" class="form-control form-control-sm">
                        </td>
                        <td class="text-center">
                            <label class="toggle-switch mx-auto" for="visible_image_{{ $image->id }}" title="Mostrar imagen">
                                <input type="checkbox" id="visible_image_{{ $image->id }}" name="visible_images[]" value="{{ $image->id }}" @checked(old('visible_images') ? in_array($image->id, old('visible_images', [])) : $image->is_visible)>
                                <span class="toggle-slider"></span>
                            </label>
                        </td>
                        <td class="text-center">
                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" aria-label="Eliminar imagen {{ $image->id }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <small class="text-sm d-block mt-2">Modifica el orden para reordenar. Visible define si se muestra en el sitio. Eliminar deja la imagen inactiva.</small>
    </div>
@endif

<div class="d-flex gap-2 mt-3">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.productos.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
