<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\PortfolioController;

Route::get('/', MainController::class)->name('home');

Route::get('/calendar', [AppointmentController::class, 'show'])->name('calendar');

Route::get('/blog', [BlogController::class, 'show'])->name('blog.show');


// Login
Route::controller(LoginController::class)

    ->group(function () {

    Route::get('/login', 'index')->name('login');

    Route::post('/login', 'store')->name('login.store');

    Route::get('/logout', 'logout')->name('logout');

});


// Register
Route::controller(RegisterController::class)

    ->group(function () {

        Route::get('/register', 'create')->name('register.create');

        Route::post('/register', 'store')->name('register.store');

    });


//Email verification
// Notice
Route::get('/email/verify', fn () => view('auth.verify'))

    ->middleware('auth')

    ->name('verification.notice');

// Verify
Route::post('/email/verify/{id}{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    return redirect()->route('home');
})

    ->middleware('auth', 'signed')

    ->name('verification.verify');

// Resend
Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');

})

    ->middleware(['auth', 'throttle:6,1'])

    ->name('verification.send');


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