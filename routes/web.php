<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManageAdminController;

// HALAMAN USER
Route::get('/', function () {
    return view('user');
});

// BELI
Route::resource('beli', BeliController::class);

// LOGIN ADMIN
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// --- RUTE KHUSUS ADMIN ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Staff Admin
    Route::resource('manage-admin', ManageAdminController::class);

    // Lihat Data Pembelian
    Route::get('/admin/beli', [BeliController::class, 'index'])->name('beli.index');
    Route::delete('/admin/beli/{id}', [BeliController::class, 'destroy'])->name('beli.destroy');
});