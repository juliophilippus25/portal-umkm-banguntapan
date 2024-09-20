<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::middleware('adminRedirectIfNotAuthenticated')->group(function () {
    Route::post('/admin/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\Admin\Users\UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/verify/{id}', [App\Http\Controllers\Admin\Users\UserController::class, 'verify'])->name('admin.userVerify');
});

// User
Route::middleware('userRedirectIfNotAuthenticated')->group(function () {
    Route::post('/user/logout', [App\Http\Controllers\User\Auth\LoginController::class, 'logout'])->name('user.logout');
    Route::get('/user/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware('RedirectIfAuthenticated')->group(function () {
    // User
    Route::get('/user/register', [App\Http\Controllers\User\Auth\RegisterController::class, 'showRegisterForm'])->name('user.showRegister');
    Route::post('/user/register/post', [App\Http\Controllers\User\Auth\RegisterController::class, 'register'])->name('user.register');
    Route::get('/user/login', [App\Http\Controllers\User\Auth\LoginController::class, 'showLoginForm'])->name('user.showLogin');
    Route::post('/user/login/post', [App\Http\Controllers\User\Auth\LoginController::class, 'login'])->name('user.login');

    // Admin
    Route::get('/admin/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.showLogin');
    Route::post('/admin/login/post', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login');
});