<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.showLogin');
    Route::post('/admin/login/post', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login');
});

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\Admin\Users\UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/verify/{id}', [App\Http\Controllers\Admin\Users\UserController::class, 'verify'])->name('admin.userVerify');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('user.showRegister');
    Route::post('/register/post', [App\Http\Controllers\User\Auth\RegisterController::class, 'register'])->name('user.register');
});

Route::get('/verify', function () {
    return view('mail.verify');
});