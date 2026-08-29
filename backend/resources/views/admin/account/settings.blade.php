@extends('layouts.admin')

@section('title', 'Configuracion')

@section('content')
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="title mb-30">
                    <h2>Configuracion del panel</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card-style mb-30">
        <h6 class="mb-20">Preferencias</h6>
        <p class="text-sm mb-10">El modo claro/oscuro ya se puede cambiar desde el header y queda guardado en el navegador.</p>
        <p class="text-sm mb-0">Podemos agregar aca configuraciones del hotel (moneda, zona horaria, politicas de reserva, etc.).</p>
    </div>

    <div class="card-style mb-30">
        <h6 class="mb-20">Personalizacion para compradores</h6>
        <p class="text-sm mb-10">El login y la marca del panel leen estos valores desde el entorno, sin tocar codigo:</p>
        <ul class="text-sm mb-0">
            <li><code>ADMIN_BRAND_NAME</code>: nombre comercial del hotel o comprador.</li>
            <li><code>ADMIN_PANEL_TITLE</code>: titulo del panel.</li>
            <li><code>ADMIN_BRAND_LOGO_URL</code>: URL o ruta publica del logo.</li>
            <li><code>ADMIN_LOGIN_IMAGE_URL</code>: imagen principal del login.</li>
            <li><code>ADMIN_BRAND_ACCENT</code>: color principal, por ejemplo <code>#2563eb</code>.</li>
        </ul>
    </div>
@endsection
