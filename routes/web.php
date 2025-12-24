<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\PortfolioController;

Route::get('/', MainController::class)->name('home');

Route::get('/calendar', [AppointmentController::class, 'show'])->name('calendar');

Route::get('/blog', [BlogController::class, 'show'])->name('blog.show');

// Login
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::get('/logout', 'logout')->name('logout');
});

// Admin panel
Route::prefix('admin')

    ->middleware(['auth'])

    ->name('admin.')

    ->group(function () {

    Route::get('', function () {

        return view('admin.index');

    });

    Route::resource('portfolio', PortfolioController::class);

    Route::resource('user', UserController::class);

});