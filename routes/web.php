<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calendar', [AppointmentController::class, 'show'])->name('calendar');

Route::get('/blog', [BlogController::class, 'show'])->name('blog.show');


// Admin panel
Route::prefix('admin')

    ->name('admin.')

    ->group(function () {

    Route::get('', function () {

        return view('admin.index');

    });

    Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class);

});