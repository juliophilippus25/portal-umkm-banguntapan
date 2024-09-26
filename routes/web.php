<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route login dan register
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

// Admin
Route::middleware('adminRedirectIfNotAuthenticated')->prefix('/admin')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Pengguna
    Route::get('/users', [App\Http\Controllers\Admin\Users\UserController::class, 'index'])->name('admin.users');
    Route::get('/users/verify/{id}', [App\Http\Controllers\Admin\Users\UserController::class, 'verify'])->name('admin.userVerify');
    Route::post('/users/toggle-active/{id}', [App\Http\Controllers\Admin\Users\UserController::class, 'toggleActive'])->name('user.toggleActive');


    // UMKM
    Route::get('/business', [App\Http\Controllers\Admin\BusinessController::class, 'index'])->name('admin.business');
    Route::get('/business/{id}', [App\Http\Controllers\Admin\BusinessController::class, 'show'])->name('admin.business.show');
    
    // Produk
    Route::get('/products', [App\Http\Controllers\Admin\ProductsController::class, 'index'])->name('admin.products');

    // Iklan
    Route::get('/advertisements', [App\Http\Controllers\Admin\AdvertisementController::class, 'index'])->name('admin.advertisements');


    Route::get('/btypes', [App\Http\Controllers\Admin\BusinessTypeController::class, 'index'])->name('admin.bTypes');
    Route::get('/ptypes', [App\Http\Controllers\Admin\ProductTypeController::class, 'index'])->name('admin.pTypes');
    Route::get('/sdistricts', [App\Http\Controllers\Admin\SubDistricController::class, 'index'])->name('admin.subDistrict');
});

// User
Route::middleware(['userRedirectIfNotAuthenticated', 'activeCheck'])->prefix('/user')->group(function () {
    Route::post('/logout', [App\Http\Controllers\User\Auth\LoginController::class, 'logout'])->name('user.logout');
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');

    // Produk
    Route::get('/products', [App\Http\Controllers\User\ProductController::class, 'index'])->name('user.products');
    Route::get('/products/create', [App\Http\Controllers\User\ProductController::class, 'create'])->name('user.products.create');
    Route::post('/products/store', [App\Http\Controllers\User\ProductController::class, 'store'])->name('user.products.store');

    // Iklan
    Route::get('/advertisements', [App\Http\Controllers\User\AdvertisementController::class, 'index'])->name('user.advertisements');
    Route::get('/advertisements/create', [App\Http\Controllers\User\AdvertisementController::class, 'create'])->name('user.advertisements.create');
    Route::post('/advertisements/store', [App\Http\Controllers\User\AdvertisementController::class, 'store'])->name('user.advertisements.store');
});