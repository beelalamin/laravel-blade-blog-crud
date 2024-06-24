<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'users.dashboard')->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email Verification Notice
    Route::get('/email/verify', [AuthController::class, 'verificationNotice'])->name('verification.notice');

    // Email Verification Handler
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationHandler'])->middleware(['signed'])->name('verification.verify');

    // Resending the Verification Email
    Route::post('/email/verification-notification', [AuthController::class, 'ResendVerificationEmail'])->middleware(['throttle:6,1'])->name('verification.send');
});

Route::middleware('guest')->group(function () {

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::redirect('/', 'posts');
Route::resource('posts', PostController::class);

Route::get('/posts/{user}/posts', [DashboardController::class, 'userPosts'])->name('users.posts');
