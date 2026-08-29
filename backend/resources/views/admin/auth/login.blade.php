@php
    $brandName = config('admin_branding.name');
    $panelTitle = config('admin_branding.panel_title');
    $tagline = config('admin_branding.tagline');
    $logoUrl = config('admin_branding.logo_url');
    $loginImageUrl = config('admin_branding.login_image_url');
    $accentColor = config('admin_branding.accent_color');
    $logoSrc = $logoUrl ? (str_starts_with($logoUrl, 'http') || str_starts_with($logoUrl, '/') ? $logoUrl : asset($logoUrl)) : null;
    $loginImageSrc = $loginImageUrl ? (str_starts_with($loginImageUrl, 'http') || str_starts_with($loginImageUrl, '/') ? $loginImageUrl : asset($loginImageUrl)) : asset('plainadmin/images/signin/signin-image.svg');
@endphp
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar | {{ $panelTitle }}</title>
    <link rel="shortcut icon" href="{{ asset('plainadmin/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('plainadmin/css/bootstrap.min.css') }}">
    <style>
        :root {
            --admin-accent: {{ $accentColor }};
            --admin-accent-soft: color-mix(in srgb, var(--admin-accent) 16%, white);
        }
        * {
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #0f172a;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.18), transparent 34%),
                linear-gradient(135deg, #f8fafc 0%, #eef2ff 52%, #e0f2fe 100%);
        }
        .login-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(380px, 0.95fr);
        }
        .login-visual {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            overflow: hidden;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.84), rgba(30, 64, 175, 0.72)),
                url('{{ $loginImageSrc }}') center / cover no-repeat;
        }
        .login-visual::after {
            content: "";
            position: absolute;
            inset: auto -12% -18% auto;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            filter: blur(2px);
        }
        .brand-lockup {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 800;
            letter-spacing: -0.03em;
            font-size: 24px;
        }
        .brand-logo {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.92);
            color: var(--admin-accent);
            font-size: 22px;
            font-weight: 900;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.26);
            overflow: hidden;
        }
        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }
        .visual-copy {
            position: relative;
            z-index: 1;
            max-width: 620px;
        }
        .visual-copy .eyebrow {
            display: inline-flex;
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            font-size: 13px;
            margin-bottom: 22px;
        }
        .visual-copy h1 {
            font-size: clamp(40px, 6vw, 76px);
            line-height: 0.95;
            letter-spacing: -0.07em;
            margin: 0 0 22px;
        }
        .visual-copy p {
            max-width: 520px;
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.82);
            margin: 0;
        }
        .login-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }
        .login-card {
            width: min(100%, 440px);
            padding: 34px;
            border: 1px solid rgba(148, 163, 184, 0.28);
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.86);
            box-shadow: 0 28px 80px rgba(15, 23, 42, 0.14);
            backdrop-filter: blur(18px);
        }
        .login-card h2 {
            margin: 0 0 8px;
            font-size: 30px;
            letter-spacing: -0.04em;
        }
        .login-card .subtitle {
            margin: 0 0 28px;
            color: #64748b;
        }
        .form-label {
            font-weight: 700;
            color: #334155;
        }
        .form-control {
            min-height: 52px;
            border: 1px solid #dbe3ef;
            border-radius: 16px;
            padding: 12px 15px;
            background: #fff;
        }
        .form-control:focus {
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 4px color-mix(in srgb, var(--admin-accent) 14%, transparent);
        }
        .btn-login {
            min-height: 52px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--admin-accent), #0f172a);
            color: #fff;
            font-weight: 800;
            box-shadow: 0 18px 36px color-mix(in srgb, var(--admin-accent) 28%, transparent);
        }
        .btn-login:hover {
            color: #fff;
            transform: translateY(-1px);
        }
        .custom-note {
            margin-top: 24px;
            padding: 14px 16px;
            border-radius: 18px;
            background: #f8fafc;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }
        @media (max-width: 960px) {
            .login-shell {
                grid-template-columns: 1fr;
            }
            .login-visual {
                min-height: 320px;
                padding: 28px;
            }
            .visual-copy h1 {
                font-size: 42px;
            }
        }
        @media (max-width: 520px) {
            .login-panel {
                padding: 22px 14px;
            }
            .login-card {
                padding: 24px;
                border-radius: 22px;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="login-visual" aria-label="Identidad del hotel">
            <div class="brand-lockup">
                <span class="brand-logo">
                    @if($logoSrc)
                        <img src="{{ $logoSrc }}" alt="{{ $brandName }}">
                    @else
                        {{ substr($brandName, 0, 1) }}
                    @endif
                </span>
                <span>{{ $brandName }}</span>
            </div>

            <div class="visual-copy">
                <span class="eyebrow">Panel administrativo personalizable</span>
                <h1>Gestion hotelera clara, segura y lista para vender.</h1>
                <p>{{ $tagline }}</p>
            </div>
        </section>

        <section class="login-panel">
            <div class="login-card">
                <h2>Ingresar al panel</h2>
                <p class="subtitle">Usa tu cuenta administradora para gestionar habitaciones, reservas y contenido.</p>

                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            autocomplete="current-password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input id="remember" name="remember" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>
                    </div>

                    <button class="btn btn-login w-100" type="submit">Entrar</button>
                </form>

                <div class="custom-note">
                    Para personalizar al vender el sistema: configurar <strong>ADMIN_BRAND_NAME</strong>, <strong>ADMIN_BRAND_LOGO_URL</strong> y <strong>ADMIN_LOGIN_IMAGE_URL</strong> en el entorno del comprador.
                </div>
            </div>
        </section>
    </main>
</body>
</html>
