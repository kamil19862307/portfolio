<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn() => 'pong');
Route::post('/calendar', [AppointmentController::class, 'store'])->name('calendar.store');
