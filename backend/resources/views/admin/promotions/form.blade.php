@csrf
@if(isset($promotion)) @method('PUT') @endif
<p class="mb-3 text-muted">El banner se oculta automáticamente al terminar la vigencia. Si hay varias promociones vigentes, se muestra la última creada. Las fechas de publicación no aplican descuentos ni confirman reservas.</p>
<div class="row">
    <div class="col-12 input-style-1">
        <label for="title">Título</label>
        <input id="title" name="title" maxlength="120" required value="{{ old('title', $promotion->title ?? '') }}">
        @error('title') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <div class="col-12 input-style-1">
        <label for="description">Descripción y condiciones</label>
        <textarea id="description" name="description" rows="3" maxlength="500" required>{{ old('description', $promotion->description ?? '') }}</textarea>
        <p class="text-muted small">Indicá restricciones, fechas de estadía y qué incluye. Máximo 500 caracteres.</p>
        @error('description') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <div class="col-md-6 input-style-1">
        <label for="starts_on">Publicar desde</label>
        <input id="starts_on" name="starts_on" type="date" required value="{{ old('starts_on', isset($promotion) ? $promotion->starts_on->format('Y-m-d') : today()->toDateString()) }}">
        @error('starts_on') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <div class="col-md-6 input-style-1">
        <label for="ends_on">Publicar hasta (inclusive)</label>
        <input id="ends_on" name="ends_on" type="date" required value="{{ old('ends_on', isset($promotion) ? $promotion->ends_on->format('Y-m-d') : '') }}">
        @error('ends_on') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <p class="text-muted small mb-3">Zona horaria del sitio: {{ config('app.timezone') }}.</p>
    <div class="col-md-6 input-style-1">
        <label for="cta_label">Texto del botón</label>
        <input id="cta_label" name="cta_label" maxlength="60" required value="{{ old('cta_label', $promotion->cta_label ?? 'Consultar promoción') }}">
        @error('cta_label') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
    <div class="col-md-6 input-style-1">
        <label for="cta_url">Destino del botón</label>
        <input id="cta_url" name="cta_url" maxlength="500" required value="{{ old('cta_url', $promotion->cta_url ?? '/reservas') }}">
        <p class="text-muted small">Ruta interna como /reservas o URL completa http/https.</p>
        @error('cta_url') <p class="text-danger">{{ $message }}</p> @enderror
    </div>
</div>
<div class="form-check mb-4">
    <input type="hidden" name="is_active" value="0">
    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" @checked(old('is_active', $promotion->is_active ?? false))>
    <label class="form-check-label" for="is_active">Habilitar publicación dentro de la vigencia</label>
    @error('is_active') <p class="text-danger">{{ $message }}</p> @enderror
</div>
<button type="submit" class="main-btn primary-btn btn-hover">Guardar promoción</button>
<a href="{{ route('admin.promociones.index') }}" class="main-btn light-btn btn-hover">Cancelar</a>
