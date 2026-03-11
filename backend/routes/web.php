<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Api\PublicContentController;
use App\Http\Controllers\Api\PublicSliderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});
Route::get('/api/sliders', [PublicSliderController::class, 'index'])->name('api.sliders.index');
Route::get('/api/rooms', [PublicContentController::class, 'rooms'])->name('api.rooms.index');
Route::get('/api/amenities', [PublicContentController::class, 'amenities'])->name('api.amenities.index');
Route::get('/api/gallery', [PublicContentController::class, 'gallery'])->name('api.gallery.index');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil', [AccountController::class, 'profile'])->name('profile');
    Route::get('/configuracion', [AccountController::class, 'settings'])->name('settings');
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::resource('categorias', CategoryController::class)->except(['show']);
    Route::resource('productos', ProductController::class)->except(['show']);
    Route::resource('reservas', ReservationController::class)->except(['show']);
    Route::resource('sliders', SliderController::class)->except(['show']);
});
