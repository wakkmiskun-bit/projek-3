<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\AdminAuthController;

// HALAMAN USER
Route::get('/', function () {
    return view('user');
});

// BELI
Route::resource('beli', BeliController::class);

// LOGIN ADMIN
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// DASHBOARD ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
