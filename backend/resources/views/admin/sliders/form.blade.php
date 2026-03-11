@csrf

<div class="row">
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="s_titulo">Titulo</label>
            <input type="text" id="s_titulo" name="s_titulo" maxlength="100" value="{{ old('s_titulo', $slider->s_titulo ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-style-1">
            <label for="s_link">Link del boton</label>
            <input type="text" id="s_link" name="s_link" maxlength="100" value="{{ old('s_link', $slider->s_link ?? '') }}" placeholder="https://..." required>
        </div>
    </div>
    <div class="col-12">
        <div class="input-style-1">
            <label for="s_texto">Texto</label>
            <textarea id="s_texto" name="s_texto" rows="4" required>{{ old('s_texto', $slider->s_texto ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-style-1">
            <label for="s_orden">Orden</label>
            <input type="number" id="s_orden" name="s_orden" min="0" max="999" value="{{ old('s_orden', $slider->s_orden ?? 1) }}" required>
        </div>
    </div>
    <div class="col-md-8">
        <div class="input-style-1 mb-20">
            <label for="s_imagen">Imagen</label>
            <div class="image-upload-field @if(isset($slider) && $slider->s_imagen) has-file @endif" data-preview-target="#slider-preview-image" data-preview-wrapper="#slider-preview-wrapper">
                <input type="file" id="s_imagen" name="s_imagen" accept=".jpg,.jpeg,.png,.webp" @if(!isset($slider)) required @endif>
                <div class="upload-content">
                    <div class="upload-icon">
                        <i class="lni lni-image"></i>
                    </div>
                    <p class="upload-title">Carga una imagen para el slider</p>
                    <p class="upload-hint">Formato recomendado 1920x800 - JPG, PNG o WEBP</p>
                    <p class="upload-filename" data-upload-filename>
                        @if(isset($slider) && $slider->s_imagen)
                            Imagen cargada: {{ basename($slider->s_imagen) }}
                        @else
                            Ningun archivo seleccionado
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($slider) && $slider->s_imagen)
    @php
        $imageUrl = str_starts_with($slider->s_imagen, 'http')
            ? $slider->s_imagen
            : asset('storage/' . $slider->s_imagen);
    @endphp
    <div class="mb-20 image-preview-card" id="slider-preview-wrapper">
        <label class="form-label d-block">Imagen actual</label>
        <img id="slider-preview-image" src="{{ $imageUrl }}" alt="{{ $slider->s_titulo }}">
    </div>
@else
    <div class="mb-20 image-preview-card d-none" id="slider-preview-wrapper">
        <label class="form-label d-block">Vista previa</label>
        <img id="slider-preview-image" src="" alt="Vista previa slider">
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="switch-field mb-20">
            <label for="s_visible" class="mb-0">Visible</label>
            <label class="toggle-switch" for="s_visible">
                <input type="checkbox" id="s_visible" name="s_visible" value="1" @checked(old('s_visible', $slider->s_visible ?? 1))>
                <span class="toggle-slider"></span>
            </label>
            <small class="text-sm">Mostrar este slide en el home.</small>
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-2">
    <button class="main-btn primary-btn btn-hover" type="submit">Guardar</button>
    <a href="{{ route('admin.sliders.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
</div>
