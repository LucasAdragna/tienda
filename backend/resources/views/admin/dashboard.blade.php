@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
    <style>
        .admin-module-card {
            display: flex;
            align-items: center;
            gap: 20px;
            min-height: 150px;
            padding: 28px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            background: #fff;
            color: #1f2937;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }
        .admin-module-card:hover {
            color: #1f2937;
            transform: translateY(-4px);
            border-color: #93c5fd;
            box-shadow: 0 16px 32px rgba(37, 99, 235, .14);
        }
        .admin-module-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 62px;
            height: 62px;
            flex: 0 0 62px;
            border-radius: 14px;
            background: #eaf2ff;
            color: #2563eb;
            font-size: 28px;
        }
        .admin-module-card h3 {
            margin: 0 0 6px;
            font-size: 18px;
            color: inherit;
        }
        .admin-module-card p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }
        body[data-theme="dark"] .admin-module-card {
            background: #1f2937;
            border-color: #374151;
            color: #f8fafc;
        }
        body[data-theme="dark"] .admin-module-card:hover { color: #f8fafc; border-color: #60a5fa; }
        body[data-theme="dark"] .admin-module-card p { color: #94a3b8; }
        body[data-theme="dark"] .admin-module-icon { background: #1e3a8a; color: #bfdbfe; }
    </style>
@endpush

@section('content')
    <div class="row pt-30">
        <div class="col-12 col-md-6 col-xl-4">
            <a class="admin-module-card mb-30" href="{{ route('admin.productos.index') }}">
                <span class="admin-module-icon"><i class="lni lni-apartment"></i></span>
                <span><h3>Habitaciones</h3><p>Administrá las habitaciones y sus datos.</p></span>
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <a class="admin-module-card mb-30" href="{{ route('admin.categorias.index') }}">
                <span class="admin-module-icon"><i class="lni lni-grid-alt"></i></span>
                <span><h3>Tipos de habitación</h3><p>Configurá las categorías de las habitaciones.</p></span>
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <a class="admin-module-card mb-30" href="{{ route('admin.reservas.index') }}">
                <span class="admin-module-icon"><i class="lni lni-calendar"></i></span>
                <span><h3>Reservas</h3><p>Consultá y gestioná las reservas del hotel.</p></span>
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <a class="admin-module-card mb-30" href="{{ route('admin.sliders.index') }}">
                <span class="admin-module-icon"><i class="lni lni-image"></i></span>
                <span><h3>Slider</h3><p>Actualizá las imágenes destacadas de la web.</p></span>
            </a>
        </div>
        <div class="col-12 col-md-6 col-xl-4">
            <a class="admin-module-card mb-30" href="{{ route('admin.sobre-nosotros.index') }}">
                <span class="admin-module-icon"><i class="lni lni-library"></i></span>
                <span><h3>Sobre nosotros</h3><p>Actualizá la presentación institucional del hotel.</p></span>
            </a>
        </div>
    </div>
@endsection
