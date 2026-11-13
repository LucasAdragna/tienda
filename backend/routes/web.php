<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Api\PublicContentController;
use App\Http\Controllers\Api\PublicPromotionController;
use App\Http\Controllers\Api\PublicSliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/api/sliders', [PublicSliderController::class, 'index'])->name('api.sliders.index');
Route::get('/api/rooms', [PublicContentController::class, 'rooms'])->name('api.rooms.index');
Route::get('/api/rooms/{product:slug}', [PublicContentController::class, 'room'])->name('api.rooms.show');
Route::get('/api/amenities', [PublicContentController::class, 'amenities'])->name('api.amenities.index');
Route::get('/api/sobre-nosotros', [PublicContentController::class, 'aboutUs'])->name('api.about-us.show');
Route::get('/api/gallery', [PublicContentController::class, 'gallery'])->name('api.gallery.index');
Route::get('/api/promotions', [PublicPromotionController::class, 'index'])->name('api.promotions.index');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::middleware('auth')->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/perfil', [AccountController::class, 'profile'])->name('profile');
        Route::get('/configuracion', [AccountController::class, 'settings'])->name('settings');
        Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
        Route::patch('categorias/{categoria}/visibilidad', [CategoryController::class, 'toggleVisibility'])->name('categorias.visibility');
        Route::resource('categorias', CategoryController::class)->except(['show']);
        Route::patch('productos/{producto}/visibilidad', [ProductController::class, 'toggleVisibility'])->name('productos.visibility');
        Route::resource('productos', ProductController::class)->except(['show']);
        Route::resource('reservas', ReservationController::class)->except(['show']);
        Route::resource('sliders', SliderController::class)->except(['show']);
        Route::resource('promociones', PromotionController::class)->parameters(['promociones' => 'promotion'])->except(['show']);
        Route::resource('sobre-nosotros', AboutUsController::class)
            ->parameters(['sobre-nosotros' => 'aboutUs'])
            ->except(['show']);
    });
});
