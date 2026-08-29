<?php

use App\Http\Controllers\Api\PublicReservationController;
use Illuminate\Support\Facades\Route;

Route::post('/reservations', [PublicReservationController::class, 'store'])
    ->middleware('throttle:reservations')
    ->name('api.reservations.store');
