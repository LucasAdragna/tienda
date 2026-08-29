@php
    $adminBrandName = config('admin_branding.name', 'Hotel Admin');
    $adminPanelTitle = config('admin_branding.panel_title', 'Panel Hotel');
    $adminTagline = config('admin_branding.tagline', 'Gestion centralizada de habitaciones, reservas y contenido de la web.');
    $adminLogoUrl = config('admin_branding.logo_url');
    $adminLogoSrc = $adminLogoUrl ? (str_starts_with($adminLogoUrl, 'http') || str_starts_with($adminLogoUrl, '/') ? $adminLogoUrl : asset($adminLogoUrl)) : asset('plainadmin/images/logo/logo.svg');
@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('plainadmin/images/favicon.svg') }}" type="image/x-icon">
    <title>@yield('title', $adminPanelTitle) | {{ $adminPanelTitle }}</title>

    <link rel="stylesheet" href="{{ asset('plainadmin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plainadmin/css/lineicons.css') }}">
    <link rel="stylesheet" href="{{ asset('plainadmin/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plainadmin/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        .header .header-right .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: nowrap;
        }
        .header .header-right .theme-toggle-btn {
            width: auto;
            min-width: 122px;
            height: 42px;
            border-radius: 8px;
            padding: 0 12px;
            border: 1px solid #efefef;
            background: #f6f6f6;
            position: static;
            white-space: nowrap;
        }
        .header .header-right .profile-box .profile-menu-toggle {
            width: auto;
            height: auto;
            border: 0;
            background: transparent;
            border-radius: 0;
            position: static;
            padding: 0;
        }
        .header-right .profile-box .profile-menu-toggle {
            background: transparent;
            border: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-right .profile-box .profile-menu-toggle .info h6 {
            margin-bottom: 2px;
            font-size: 14px;
        }
        .header-right .profile-box .profile-menu-toggle .info span {
            font-size: 12px;
            color: #5d657b;
        }
        .header-right .profile-box .profile-menu-toggle img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
        }
        .theme-toggle-btn i {
            margin-right: 6px;
        }
        .sidebar-nav-wrapper {
            background: linear-gradient(180deg, #0f172a 0%, #111827 48%, #1e293b 100%);
            box-shadow: 18px 0 45px rgba(15, 23, 42, 0.18);
            scrollbar-width: thin;
            scrollbar-color: rgba(148, 163, 184, 0.45) transparent;
        }
        .sidebar-nav-wrapper::after {
            content: "";
            position: fixed;
            top: 0;
            right: 0;
            width: 1px;
            height: 100vh;
            background: linear-gradient(180deg, rgba(99, 102, 241, 0), rgba(99, 102, 241, 0.65), rgba(14, 165, 233, 0));
        }
        .sidebar-nav-wrapper .navbar-logo {
            border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            margin-bottom: 20px;
            padding-bottom: 24px;
        }
        .sidebar-nav-wrapper .navbar-logo img {
            filter: brightness(0) invert(1);
        }
        .sidebar-nav-wrapper .navbar-logo img.custom-brand-logo {
            max-height: 54px;
            width: auto;
            filter: none;
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item a {
            color: #cbd5e1;
            border-radius: 12px;
            margin: 3px 14px;
            width: auto;
            padding: 11px 14px;
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item a .icon {
            color: #94a3b8;
            margin-top: 0;
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item.active > a,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item.active > a.collapsed,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item:hover > a,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item:hover > a.collapsed {
            color: #ffffff;
            background: rgba(59, 130, 246, 0.14);
            box-shadow: inset 3px 0 0 #38bdf8;
        }
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item.active > a .icon,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item.active > a.collapsed .icon,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item:hover > a .icon,
        .sidebar-nav-wrapper .sidebar-nav ul .nav-item:hover > a.collapsed .icon {
            color: #38bdf8;
        }
        .sidebar-nav-wrapper .promo-box {
            background: rgba(15, 23, 42, 0.72);
            border: 1px solid rgba(148, 163, 184, 0.18);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
        }
        .sidebar-nav-wrapper .promo-box .promo-icon {
            border-color: #1e293b;
        }
        .sidebar-nav-wrapper .promo-box h3 {
            color: #f8fafc;
        }
        .sidebar-nav-wrapper .promo-box p {
            color: #cbd5e1;
        }
        .main-wrapper {
            background: #f4f7fb;
        }
        .header {
            background: rgba(255, 255, 255, 0.94);
            border-bottom: 1px solid #e5e7eb;
            backdrop-filter: blur(10px);
        }
        #menu-toggle {
            min-width: 132px;
            justify-content: center;
        }
        .image-upload-field {
            position: relative;
            border: 1.5px dashed #cbd5e1;
            border-radius: 14px;
            background: #f8fafc;
            padding: 18px 16px;
            text-align: center;
            transition: all 0.2s ease;
            overflow: hidden;
        }
        .image-upload-field:hover {
            border-color: #365cf5;
            background: #eef4ff;
        }
        .image-upload-field.has-file {
            border-style: solid;
            border-color: #365cf5;
            background: #eef4ff;
        }
        .image-upload-field input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }
        .image-upload-field .upload-content {
            pointer-events: none;
        }
        .image-upload-field .upload-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dbe7ff;
            color: #365cf5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .image-upload-field .upload-title {
            font-size: 14px;
            font-weight: 600;
            color: #1a2142;
            margin-bottom: 4px;
        }
        .image-upload-field .upload-hint {
            font-size: 12px;
            color: #5d657b;
            margin-bottom: 6px;
        }
        .image-upload-field .upload-filename {
            font-size: 12px;
            color: #365cf5;
            font-weight: 600;
            margin-bottom: 0;
            word-break: break-word;
        }
        .image-preview-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px;
            background: #ffffff;
        }
        .image-preview-card img {
            width: 280px;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }
        .upload-preview-list {
            display: grid;
            gap: 10px;
            max-width: 460px;
        }
        .upload-preview-item {
            display: flex;
            align-items: center;
            gap: 12px;
            width: fit-content;
            max-width: 100%;
            min-width: 320px;
            padding: 8px 10px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #ffffff;
        }
        .upload-preview-item img {
            width: 64px;
            height: 46px;
            object-fit: cover;
            border-radius: 8px;
            flex: 0 0 auto;
        }
        .upload-preview-item span {
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            word-break: break-word;
            max-width: 330px;
        }
        .grid-table {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }
        .grid-table thead th,
        .grid-table tbody td {
            border-right: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
            padding: 18px 16px;
            line-height: 1.4;
        }
        .grid-table thead th {
            font-weight: 600;
            color: #334155;
        }
        .grid-table tbody td {
            font-weight: 400;
            color: #475569;
        }
        .grid-table tbody td h6 {
            margin-bottom: 0;
            font-weight: 500;
            color: #1f2937;
        }
        .grid-table tbody td .text-sm {
            color: #64748b;
            font-weight: 400;
            margin-top: 4px;
        }
        .grid-table tbody td img {
            display: block;
            margin: 0 auto;
        }
        .grid-table thead th:last-child,
        .grid-table tbody td:last-child {
            border-right: 0;
        }
        .grid-table tbody tr:last-child td {
            border-bottom: 0;
        }
        .icon-action-btn {
            width: auto;
            height: auto;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            background: transparent;
            color: #64748b;
            margin-left: 10px;
            text-decoration: none;
            padding: 2px;
            appearance: none;
            transition: all 0.2s ease;
        }
        .icon-action-btn i {
            font-size: 16px;
        }
        .icon-action-btn.is-edit:hover {
            color: #2563eb;
            background: transparent;
        }
        .icon-action-btn.is-delete:hover {
            color: #dc2626;
            background: transparent;
        }
        .bool-indicator {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 14px;
            font-weight: 700;
            border: 0;
            cursor: pointer;
        }
        .bool-indicator.is-true {
            color: #047857;
            background: #d1fae5;
        }
        .bool-indicator.is-false {
            color: #b91c1c;
            background: #fee2e2;
        }
        .switch-field {
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }
        .switch-field > label {
            font-size: 14px;
            font-weight: 600;
            color: #1a2142;
        }
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 28px;
        }
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .toggle-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: #cbd5e1;
            border-radius: 999px;
            transition: all 0.2s ease;
        }
        .toggle-slider::before {
            content: "";
            position: absolute;
            width: 22px;
            height: 22px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
        }
        .toggle-switch input:checked + .toggle-slider {
            background: #22c55e;
        }
        .toggle-switch input:checked + .toggle-slider::before {
            transform: translateX(22px);
        }
        .alert ul {
            margin-bottom: 0;
        }
        .app-alert-backdrop {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
        }
        .app-alert-backdrop.is-open {
            display: flex;
        }
        .app-alert-dialog {
            width: min(420px, 100%);
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 24px 80px rgba(15, 23, 42, 0.28);
            overflow: hidden;
        }
        .app-alert-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 20px 10px;
        }
        .app-alert-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #b45309;
            background: #fef3c7;
            flex: 0 0 auto;
        }
        .app-alert-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
        }
        .app-alert-message {
            padding: 0 20px 18px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.55;
        }
        .app-alert-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 20px;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }

        body[data-theme="dark"] {
            background: #111827;
            color: #e5e7eb;
        }
        body[data-theme="dark"] .main-wrapper,
        body[data-theme="dark"] .header,
        body[data-theme="dark"] .footer,
        body[data-theme="dark"] .card-style,
        body[data-theme="dark"] .sidebar-nav-wrapper,
        body[data-theme="dark"] .promo-box,
        body[data-theme="dark"] .dropdown-menu {
            background: #1f2937 !important;
            border-color: #374151 !important;
        }
        body[data-theme="dark"] .title h2,
        body[data-theme="dark"] h6,
        body[data-theme="dark"] th,
        body[data-theme="dark"] td,
        body[data-theme="dark"] p,
        body[data-theme="dark"] label,
        body[data-theme="dark"] .text-sm,
        body[data-theme="dark"] .breadcrumb-item,
        body[data-theme="dark"] .dropdown-item,
        body[data-theme="dark"] .sidebar-nav-wrapper .sidebar-nav ul .nav-item a {
            color: #e5e7eb !important;
        }
        body[data-theme="dark"] .breadcrumb-item.active,
        body[data-theme="dark"] .profile-box .profile-menu-toggle .info span {
            color: #9ca3af !important;
        }
        body[data-theme="dark"] .table > :not(caption) > * > * {
            background: transparent !important;
            border-color: #374151 !important;
        }
        body[data-theme="dark"] .app-alert-dialog {
            background: #1f2937;
            border-color: #374151;
        }
        body[data-theme="dark"] .app-alert-title {
            color: #f8fafc;
        }
        body[data-theme="dark"] .app-alert-message {
            color: #cbd5e1;
        }
        body[data-theme="dark"] .app-alert-actions {
            background: #111827;
            border-top-color: #374151;
        }
        body[data-theme="dark"] .sidebar-nav-wrapper {
            background: linear-gradient(180deg, #020617 0%, #0f172a 52%, #111827 100%) !important;
            box-shadow: 18px 0 45px rgba(0, 0, 0, 0.28);
        }
        body[data-theme="dark"] .sidebar-nav-wrapper .promo-box {
            background: rgba(2, 6, 23, 0.72) !important;
        }
        body[data-theme="dark"] .main-wrapper {
            background: #0f172a !important;
        }
        body[data-theme="dark"] .header {
            background: rgba(31, 41, 55, 0.94) !important;
            border-bottom-color: #374151 !important;
        }
        body[data-theme="dark"] .input-style-1 input,
        body[data-theme="dark"] .input-style-1 textarea,
        body[data-theme="dark"] .select-style-1 .select-position select {
            background: #111827 !important;
            border-color: #374151 !important;
            color: #e5e7eb !important;
        }
        body[data-theme="dark"] .image-upload-field {
            background: #111827;
            border-color: #4b5563;
        }
        body[data-theme="dark"] .image-upload-field:hover,
        body[data-theme="dark"] .image-upload-field.has-file {
            background: #0f172a;
            border-color: #60a5fa;
        }
        body[data-theme="dark"] .image-upload-field .upload-icon {
            background: #1e3a8a;
            color: #dbeafe;
        }
        body[data-theme="dark"] .image-upload-field .upload-title {
            color: #e5e7eb;
        }
        body[data-theme="dark"] .image-upload-field .upload-hint {
            color: #9ca3af;
        }
        body[data-theme="dark"] .image-upload-field .upload-filename {
            color: #93c5fd;
        }
        body[data-theme="dark"] .image-preview-card {
            background: #111827;
            border-color: #374151;
        }
        body[data-theme="dark"] .upload-preview-item {
            background: #111827;
            border-color: #374151;
        }
        body[data-theme="dark"] .upload-preview-item span {
            color: #cbd5e1;
        }
        body[data-theme="dark"] .grid-table {
            border-color: #374151;
        }
        body[data-theme="dark"] .grid-table thead th,
        body[data-theme="dark"] .grid-table tbody td {
            border-right-color: #374151;
            border-bottom-color: #374151;
        }
        body[data-theme="dark"] .grid-table thead th {
            color: #cbd5e1;
        }
        body[data-theme="dark"] .grid-table tbody td {
            color: #cbd5e1;
        }
        body[data-theme="dark"] .grid-table tbody td h6 {
            color: #e5e7eb;
        }
        body[data-theme="dark"] .grid-table tbody td .text-sm {
            color: #94a3b8;
        }
        body[data-theme="dark"] .icon-action-btn {
            background: transparent;
            color: #cbd5e1;
        }
        body[data-theme="dark"] .icon-action-btn.is-edit:hover {
            color: #93c5fd;
            background: transparent;
        }
        body[data-theme="dark"] .icon-action-btn.is-delete:hover {
            color: #fca5a5;
            background: transparent;
        }
        body[data-theme="dark"] .bool-indicator.is-true {
            background: #14532d;
            color: #bbf7d0;
        }
        body[data-theme="dark"] .bool-indicator.is-false {
            background: #7f1d1d;
            color: #fecaca;
        }
        body[data-theme="dark"] .switch-field > label {
            color: #e5e7eb;
        }
        body[data-theme="dark"] .toggle-slider {
            background: #4b5563;
        }
        body[data-theme="dark"] .dropdown-item:hover {
            background: #374151;
        }
        body[data-theme="dark"] .overlay.active {
            background: rgba(0, 0, 0, 0.55);
        }
        @media (max-width: 767px) {
            .header .header-right .theme-toggle-btn {
                min-width: 42px;
                width: 42px;
                padding: 0;
            }
            .header .header-right .theme-toggle-btn #theme-toggle-label {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
<div id="preloader">
    <div class="spinner"></div>
</div>

<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route('admin.dashboard') }}">
            <img class="{{ $adminLogoUrl ? 'custom-brand-logo' : '' }}" src="{{ $adminLogoSrc }}" alt="{{ $adminBrandName }}">
        </a>
    </div>
    @include('partials.admin-nav')
</aside>
<div class="overlay"></div>

<main class="main-wrapper">
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="header-left d-flex align-items-center">
                        <div class="menu-toggle-btn mr-15">
                            <button id="menu-toggle" class="main-btn primary-btn btn-hover" type="button" aria-expanded="true">
                                <i class="lni lni-chevron-left me-2"></i><span id="sidebar-toggle-label">Cerrar menu</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="header-right justify-content-end d-flex align-items-center">
                        <div class="header-actions">
                            <button type="button" class="main-btn light-btn btn-hover theme-toggle-btn" id="theme-toggle">
                                <i id="theme-toggle-icon" class="lni lni-night"></i>
                                <!-- <span id="theme-toggle-label">Oscuro</span> -->
                            </button>

                            <div class="dropdown profile-box">
                                <button
                                    class="profile-menu-toggle dropdown-toggle"
                                    type="button"
                                    id="profileMenu"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    <div class="info d-none d-md-block text-end">
                                        <h6>{{ auth()->user()->name ?? 'Administrador' }}</h6>
                                        <!-- <span>{{ auth()->user()->email ?? 'admin@hotel.local' }}</span> -->
                                    </div>
                                    <img src="{{ asset('plainadmin/images/profile/profile-image.png') }}" alt="Perfil">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                            <i class="lni lni-user me-2"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                            <i class="lni lni-cog me-2"></i> Configuracion
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">
                                                <i class="lni lni-power-switch me-2"></i> Cerrar sesion
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="section">
        <div class="container-fluid">
            @include('partials.flash')
            @yield('content')
        </div>
    </section>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="copyright text-center text-md-start">
                        <p class="text-sm">Panel Administrativo Hotel</p>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </footer>
</main>

<div class="app-alert-backdrop" id="app-alert" aria-hidden="true">
    <div class="app-alert-dialog" role="dialog" aria-modal="true" aria-labelledby="app-alert-title" aria-describedby="app-alert-message">
        <div class="app-alert-header">
            <span class="app-alert-icon"><i class="lni lni-warning"></i></span>
            <h3 class="app-alert-title" id="app-alert-title">Confirmar accion</h3>
        </div>
        <div class="app-alert-message" id="app-alert-message">Esta accion requiere confirmacion.</div>
        <div class="app-alert-actions">
            <button type="button" class="main-btn light-btn btn-hover" id="app-alert-cancel">Cancelar</button>
            <button type="button" class="main-btn danger-btn btn-hover" id="app-alert-confirm">Confirmar</button>
        </div>
    </div>
</div>

<script src="{{ asset('plainadmin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plainadmin/js/main.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    (function () {
        const storageKey = 'admin-theme';
        const body = document.body;
        const toggleButton = document.getElementById('theme-toggle');
        const toggleLabel = document.getElementById('theme-toggle-label');
        const toggleIcon = document.getElementById('theme-toggle-icon');

        function applyTheme(theme) {
            body.setAttribute('data-theme', theme);

            if (!toggleLabel || !toggleIcon) {
                return;
            }

            if (theme === 'dark') {
                toggleLabel.textContent = 'Claro';
                toggleIcon.classList.remove('lni-night');
                toggleIcon.classList.add('lni-sun');
            } else {
                toggleLabel.textContent = 'Oscuro';
                toggleIcon.classList.remove('lni-sun');
                toggleIcon.classList.add('lni-night');
            }
        }

        const savedTheme = localStorage.getItem(storageKey) || 'light';
        applyTheme(savedTheme);

        if (toggleButton) {
            toggleButton.addEventListener('click', function () {
                const current = body.getAttribute('data-theme') || 'light';
                const next = current === 'dark' ? 'light' : 'dark';
                localStorage.setItem(storageKey, next);
                applyTheme(next);
            });
        }
    })();

    $(function () {
        const appAlert = $('#app-alert');
        const appAlertTitle = $('#app-alert-title');
        const appAlertMessage = $('#app-alert-message');
        const appAlertCancel = $('#app-alert-cancel');
        const appAlertConfirm = $('#app-alert-confirm');
        let appAlertResolver = null;

        function closeAppAlert(result) {
            appAlert.removeClass('is-open').attr('aria-hidden', 'true');

            if (appAlertResolver) {
                appAlertResolver(result);
                appAlertResolver = null;
            }
        }

        window.AppAlert = {
            confirm: function (options) {
                const settings = Object.assign({
                    title: 'Confirmar accion',
                    message: 'Esta accion requiere confirmacion.',
                    confirmText: 'Confirmar',
                    cancelText: 'Cancelar',
                }, options || {});

                appAlertTitle.text(settings.title);
                appAlertMessage.text(settings.message);
                appAlertConfirm.text(settings.confirmText).show();
                appAlertCancel.text(settings.cancelText).show();
                appAlert.addClass('is-open').attr('aria-hidden', 'false');
                appAlertConfirm.trigger('focus');

                return new Promise(function (resolve) {
                    appAlertResolver = resolve;
                });
            },
            show: function (options) {
                const settings = Object.assign({
                    title: 'Aviso',
                    message: '',
                    confirmText: 'Entendido',
                }, options || {});

                appAlertTitle.text(settings.title);
                appAlertMessage.text(settings.message);
                appAlertConfirm.text(settings.confirmText).show();
                appAlertCancel.hide();
                appAlert.addClass('is-open').attr('aria-hidden', 'false');
                appAlertConfirm.trigger('focus');

                return new Promise(function (resolve) {
                    appAlertResolver = resolve;
                });
            },
        };

        appAlertCancel.on('click', function () {
            closeAppAlert(false);
        });

        appAlertConfirm.on('click', function () {
            closeAppAlert(true);
        });

        appAlert.on('click', function (event) {
            if (event.target === this) {
                closeAppAlert(false);
            }
        });

        $(document).on('keydown', function (event) {
            if (event.key === 'Escape' && appAlert.hasClass('is-open')) {
                closeAppAlert(false);
            }
        });

        $('.image-upload-field').each(function () {
            const field = $(this);
            const input = field.find('input[type="file"]');
            const fileNameTarget = field.find('[data-upload-filename]');
            const previewSelector = field.data('preview-target');
            const previewWrapperSelector = field.data('preview-wrapper');
            const previewList = field.siblings('[data-upload-preview-list]');
            let selectedFiles = [];

            function syncMultipleInputFiles() {
                if (!field.data('multiple-upload') || typeof DataTransfer === 'undefined') {
                    return;
                }

                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(function (selectedFile) {
                    dataTransfer.items.add(selectedFile);
                });
                input[0].files = dataTransfer.files;
            }

            function renderPreviewList() {
                if (!previewList.length) {
                    return;
                }

                previewList.empty();

                if (selectedFiles.length === 0) {
                    previewList.addClass('d-none');
                    return;
                }

                previewList.removeClass('d-none');
                selectedFiles.forEach(function (selectedFile) {
                    const objectUrl = URL.createObjectURL(selectedFile);
                    const item = $('<div class="upload-preview-item"></div>');
                    item.append($('<img>', { src: objectUrl, alt: selectedFile.name }));
                    item.append($('<span></span>').text(selectedFile.name));
                    previewList.append(item);
                });
            }

            input.on('change', function () {
                const files = this.files ? Array.from(this.files) : [];
                const file = files[0] ?? null;

                if (!file) {
                    return;
                }

                if (field.data('multiple-upload')) {
                    selectedFiles = selectedFiles.concat(files);
                    syncMultipleInputFiles();
                } else {
                    selectedFiles = files;
                }

                field.addClass('has-file');
                fileNameTarget.text(selectedFiles.length > 1 ? selectedFiles.length + ' archivos seleccionados' : selectedFiles[0].name);
                renderPreviewList();

                if (previewSelector) {
                    const previewImage = $(previewSelector);
                    if (previewImage.length) {
                        const objectUrl = URL.createObjectURL(file);
                        previewImage.attr('src', objectUrl);
                    }
                }

                if (previewWrapperSelector) {
                    $(previewWrapperSelector).removeClass('d-none');
                }
            });
        });

        setTimeout(function () {
            $('.alert[data-autoclose="true"]').fadeOut(300);
        }, 2500);

        $(document).on('click', '[data-confirm-delete]', function (event) {
            event.preventDefault();

            const trigger = $(this);
            const form = trigger.closest('form');
            const message = trigger.data('confirmMessage') || 'Esta accion eliminara o desactivara el registro. Deseas continuar?';

            window.AppAlert.confirm({
                title: 'Confirmar eliminacion',
                message: message,
                confirmText: 'Si, continuar',
                cancelText: 'Cancelar',
            }).then(function (confirmed) {
                if (confirmed && form.length) {
                    form.trigger('submit');
                }
            });
        });

        $(document).on('submit', '[data-toggle-visibility]', function (event) {
            event.preventDefault();

            const form = $(this);
            const button = form.find('.bool-indicator');
            const token = form.find('input[name="_token"]').val();

            button.prop('disabled', true);

            fetch(form.attr('action'), {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
            })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('No se pudo actualizar la visibilidad.');
                    }

                    return response.json();
                })
                .then(function (payload) {
                    button
                        .toggleClass('is-true', payload.visible)
                        .toggleClass('is-false', !payload.visible)
                        .attr('title', payload.label)
                        .attr('aria-label', payload.label)
                        .html(payload.symbol);
                })
                .catch(function () {
                    window.AppAlert.show({
                        title: 'No se pudo actualizar',
                        message: 'Intenta nuevamente en unos segundos.',
                    });
                })
                .finally(function () {
                    button.prop('disabled', false);
                });
        });
    });
</script>
@stack('scripts')
</body>
</html>
