@csrf

<div class="row">
    <div class="col-12"><div class="input-style-1"><label for="so_titulo">Título</label><input type="text" id="so_titulo" name="so_titulo" maxlength="150" value="{{ old('so_titulo', $aboutUs->so_titulo ?? '') }}" required></div></div>
    <div class="col-12"><div class="input-style-1"><label for="so_texto">Texto</label><textarea id="so_texto" name="so_texto" rows="4" maxlength="150" required>{{ old('so_texto', $aboutUs->so_texto ?? '') }}</textarea><small class="text-sm">Máximo 150 caracteres según la estructura actual de la tabla.</small></div></div>
    <div class="col-md-6"><div class="input-style-1"><label for="so_imagen">Imagen</label><input type="file" id="so_imagen" name="so_imagen" accept=".jpg,.jpeg,.png,.webp" @required(!isset($aboutUs))><small class="text-sm">JPG, PNG o WEBP. Máximo 4 MB.</small></div></div>
    <div class="col-md-6"><div class="input-style-1"><label for="so_pdf">PDF institucional</label><input type="file" id="so_pdf" name="so_pdf" accept="application/pdf,.pdf" @required(!isset($aboutUs))><small class="text-sm">PDF. Máximo 10 MB.</small></div></div>
    <div class="col-12"><div class="switch-field mb-20"><label for="so_activo" class="mb-0">Activo</label><label class="toggle-switch" for="so_activo"><input type="checkbox" id="so_activo" name="so_activo" value="1" @checked(old('so_activo', $aboutUs->so_activo ?? true))><span class="toggle-slider"></span></label><small class="text-sm">Sólo un contenido activo se muestra en el inicio.</small></div></div>
</div>

<div class="d-flex gap-2 mt-2"><button class="main-btn primary-btn btn-hover" type="submit">Guardar</button><a href="{{ route('admin.sobre-nosotros.index') }}" class="main-btn light-btn btn-hover">Cancelar</a></div>
