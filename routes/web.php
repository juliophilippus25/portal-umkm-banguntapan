<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'home'])->name('home');
Route::get('/umkm', [App\Http\Controllers\LandingPageController::class, 'businesses'])->name('businesses');
Route::get('/umkm/{id}', [App\Http\Controllers\LandingPageController::class, 'detailBusiness'])->name('businesses.detail');
Route::get('/iklan', [App\Http\Controllers\LandingPageController::class, 'advertisements'])->name('advertisements');
Route::get('/iklan/{id}', [App\Http\Controllers\LandingPageController::class, 'detailAdvertisement'])->name('advertisements.detail');
Route::get('/produk', [App\Http\Controllers\LandingPageController::class, 'products'])->name('products');
Route::get('/produk/{id}', [App\Http\Controllers\LandingPageController::class, 'detailProduct'])->name('products.detail');



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
    Route::get('/profil-ku', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profil-ku/update/{adminId}', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

    // Pengguna
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('/users/verify/{id}', [App\Http\Controllers\Admin\UserController::class, 'verify'])->name('admin.userVerify');
    Route::post('/users/toggle-active/{id}', [App\Http\Controllers\Admin\UserController::class, 'toggleActive'])->name('user.toggleActive');

    // UMKM
    Route::get('/business', [App\Http\Controllers\Admin\BusinessController::class, 'index'])->name('admin.business');
    Route::get('/business/{id}', [App\Http\Controllers\Admin\BusinessController::class, 'show'])->name('admin.business.show');
    
    // Produk
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');

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
    Route::get('/profil-ku', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile');
    Route::put('/profil-ku/update/{userId}', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profil-umkm', [App\Http\Controllers\User\BusinessController::class, 'index'])->name('user.profile.business');
    Route::put('/profil-umkm/update/{businessId}', [App\Http\Controllers\User\BusinessController::class, 'update'])->name('user.profile.business.update');

    // Produk
    Route::get('/products', [App\Http\Controllers\User\ProductController::class, 'index'])->name('user.products');
    Route::get('/products/create', [App\Http\Controllers\User\ProductController::class, 'create'])->name('user.products.create');
    Route::post('/products/store', [App\Http\Controllers\User\ProductController::class, 'store'])->name('user.products.store');
    Route::delete('/products/destoy/{id}', [App\Http\Controllers\User\ProductController::class, 'destroy'])->name('user.products.destroy')->middleware('checkOwnership:product');
    Route::get('/products/edit/{id}', [App\Http\Controllers\User\ProductController::class, 'edit'])->name('user.products.edit')->middleware('checkOwnership:product');
    Route::put('/products/update/{id}', [App\Http\Controllers\User\ProductController::class, 'update'])->name('user.products.update')->middleware('checkOwnership:product');

    // Iklan
    Route::get('/advertisements', [App\Http\Controllers\User\AdvertisementController::class, 'index'])->name('user.advertisements');
    Route::get('/advertisements/create', [App\Http\Controllers\User\AdvertisementController::class, 'create'])->name('user.advertisements.create');
    Route::post('/advertisements/store', [App\Http\Controllers\User\AdvertisementController::class, 'store'])->name('user.advertisements.store');
    Route::delete('/advertisements/destoy/{id}', [App\Http\Controllers\User\AdvertisementController::class, 'destroy'])->name('user.advertisements.destroy')->middleware('checkOwnership:advertisement');
});