# Backend Tienda - Panel de Administracion

Proyecto Laravel 12 con panel de administracion responsive (Bootstrap 5 + jQuery) para:

- Categorias
- Productos
- Reservas

## 1. Configurar base de datos (phpMyAdmin)

1. Crear una base en phpMyAdmin llamada `tienda_admin`.
2. Copiar `.env.example` a `.env` (si no existe).
3. Verificar estas variables en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tienda_admin
DB_USERNAME=root
DB_PASSWORD=
```

## 2. Instalar y migrar

```bash
composer install
php artisan key:generate
php artisan migrate
```

## 3. Levantar servidor

```bash
php artisan serve
```

Panel admin: `http://127.0.0.1:8000/admin`

## Estructura principal creada

- Rutas admin: `routes/web.php`
- Controladores: `app/Http/Controllers/Admin`
- Modelos: `app/Models/Category.php`, `Product.php`, `Reservation.php`
- Migraciones: `database/migrations/2026_03_06_*`
- Vistas admin Bootstrap: `resources/views/admin`
