@php
    $brandName = config('admin_branding.name');
    $panelTitle = config('admin_branding.panel_title');
    $tagline = config('admin_branding.tagline');
    $logoUrl = config('admin_branding.logo_url');
    $loginImageUrl = config('admin_branding.login_image_url');
    $accentColor = config('admin_branding.accent_color');
    $logoSrc = $logoUrl ? (str_starts_with($logoUrl, 'http') || str_starts_with($logoUrl, '/') ? $logoUrl : asset($logoUrl)) : null;
    $loginImageSrc = $loginImageUrl ? (str_starts_with($loginImageUrl, 'http') || str_starts_with($loginImageUrl, '/') ? $loginImageUrl : asset($loginImageUrl)) : null;
    $coverSrc = $loginImageSrc ?: ($logoSrc ?: asset('plainadmin/images/auth/signin-image.svg'));
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
            --admin-accent-soft: color-mix(in srgb, var(--admin-accent) 12%, white);
            --auth-ink: #20242d;
            --auth-muted: #737986;
            --auth-border: #e5e7eb;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--auth-ink);
            background: #f7f8fb;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .auth-cover {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(420px, 1fr);
        }

        .auth-cover-left {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 56px;
            border-right: 1px solid var(--auth-border);
            background:
                radial-gradient(circle at 18% 18%, color-mix(in srgb, var(--admin-accent) 10%, white), transparent 36%),
                linear-gradient(145deg, #ffffff 0%, #f4f6fb 100%);
        }

        .auth-cover-left::before,
        .auth-cover-left::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-cover-left::before {
            width: 420px;
            height: 420px;
            left: -180px;
            bottom: -210px;
            background: color-mix(in srgb, var(--admin-accent) 9%, transparent);
        }

        .auth-cover-left::after {
            width: 260px;
            height: 260px;
            right: -110px;
            top: -130px;
            border: 1px solid color-mix(in srgb, var(--admin-accent) 18%, transparent);
        }

        .auth-cover-brand {
            position: relative;
            z-index: 1;
            width: min(100%, 700px);
            text-align: center;
        }

        .auth-cover-brand img {
            display: block;
            width: auto;
            max-width: min(100%, 650px);
            max-height: 58vh;
            margin: 0 auto 34px;
            object-fit: contain;
        }

        .auth-cover-brand h1 {
            margin: 0 0 10px;
            color: var(--auth-ink);
            font-size: clamp(24px, 3vw, 38px);
            font-weight: 700;
            letter-spacing: -0.04em;
        }

        .auth-cover-brand p {
            max-width: 520px;
            margin: 0 auto;
            color: var(--auth-muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .auth-cover-right {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 0;
            padding: 44px 38px;
            border-top: 4px solid transparent;
            border-image: linear-gradient(90deg, var(--admin-accent), #6d28d9) 1;
            background: #fff;
        }

        .auth-form-card {
            width: min(100%, 440px);
        }

        .auth-form-card h2 {
            margin: 0 0 8px;
            color: var(--auth-ink);
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.045em;
        }

        .auth-form-card .intro {
            margin: 0;
            color: var(--auth-muted);
            font-size: 14px;
        }

        .auth-form {
            margin-top: 34px;
        }

        .auth-form .form-label {
            margin-bottom: 8px;
            color: #454b57;
            font-size: 14px;
            font-weight: 600;
        }

        .auth-form .form-control,
        .auth-form .input-group-text {
            min-height: 48px;
            border-color: var(--auth-border);
            border-radius: 8px;
            background: #fff;
        }

        .auth-form .form-control {
            padding: 12px 14px;
        }

        .auth-form .input-group .form-control {
            border-right: 0;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .auth-form .input-group-text {
            padding: 0 14px;
            color: var(--auth-muted);
            border-left: 0;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            cursor: pointer;
        }

        .auth-form .form-control:focus {
            border-color: var(--admin-accent);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--admin-accent) 12%, transparent);
        }

        .auth-form .input-group:focus-within .input-group-text {
            border-color: var(--admin-accent);
        }

        .auth-form .form-check-input:checked {
            border-color: var(--admin-accent);
            background-color: var(--admin-accent);
        }

        .auth-form .form-check-label {
            color: var(--auth-muted);
            font-size: 13px;
        }

        .btn-login {
            min-height: 48px;
            border: 0;
            border-radius: 8px;
            background: linear-gradient(90deg, var(--admin-accent), #6d28d9);
            color: #fff;
            font-weight: 700;
            box-shadow: 0 12px 25px color-mix(in srgb, var(--admin-accent) 22%, transparent);
        }

        .btn-login:hover,
        .btn-login:focus {
            color: #fff;
            filter: brightness(1.05);
        }

        .auth-note {
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid #f0f1f3;
            color: var(--auth-muted);
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 991.98px) {
            .auth-cover {
                grid-template-columns: 1fr;
            }

            .auth-cover-left {
                min-height: 310px;
                padding: 36px 24px;
                border-right: 0;
            }

            .auth-cover-brand img {
                max-height: 180px;
                margin-bottom: 20px;
            }

            .auth-cover-brand h1 {
                font-size: 28px;
            }

            .auth-cover-right {
                min-height: calc(100vh - 310px);
                padding: 42px 24px 50px;
            }
        }

        @media (max-width: 575.98px) {
            .auth-cover-left {
                min-height: 250px;
                padding: 28px 20px;
            }

            .auth-cover-brand img {
                max-height: 120px;
            }

            .auth-cover-brand h1 {
                font-size: 24px;
            }

            .auth-cover-brand p {
                font-size: 13px;
            }

            .auth-cover-right {
                min-height: auto;
                padding: 34px 20px 40px;
            }

            .auth-form-card h2 {
                font-size: 27px;
            }
        }
    </style>
</head>
<body>
    <main class="auth-cover">
        <section class="auth-cover-left" aria-label="Identidad del sistema">
            <div class="auth-cover-brand">
                <img src="{{ $coverSrc }}" alt="{{ $brandName }}">
                <h1>{{ $brandName }}</h1>
                <p>{{ $tagline }}</p>
            </div>
        </section>

        <section class="auth-cover-right">
            <div class="auth-form-card">
                <h2>Ingresar al panel</h2>
                <p class="intro">Ingresá tus credenciales para administrar el sistema.</p>

                @if(session('success'))
                    <div class="alert alert-success mt-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.store') }}" class="auth-form" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="nombre@ejemplo.com"
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
                        <div class="input-group">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Ingresá tu password"
                                autocomplete="current-password"
                                required
                            >
                            <button class="input-group-text" type="button" data-password-toggle aria-label="Mostrar password">
                                <span aria-hidden="true">◉</span>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check form-switch">
                            <input id="remember" name="remember" class="form-check-input" type="checkbox" value="1">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>
                    </div>

                    <button class="btn btn-login w-100" type="submit">Ingresar</button>
                </form>

                <p class="auth-note mb-0">
                    La identidad del sistema se puede personalizar con <strong>ADMIN_BRAND_NAME</strong>,
                    <strong>ADMIN_BRAND_LOGO_URL</strong> o <strong>ADMIN_LOGIN_IMAGE_URL</strong>.
                </p>
            </div>
        </section>
    </main>

    <script>
        document.querySelector('[data-password-toggle]')?.addEventListener('click', function () {
            const password = document.getElementById('password');
            const isPassword = password.type === 'password';

            password.type = isPassword ? 'text' : 'password';
            this.setAttribute('aria-label', isPassword ? 'Ocultar password' : 'Mostrar password');
            this.firstElementChild.textContent = isPassword ? '◌' : '◉';
        });
    </script>
</body>
</html>
