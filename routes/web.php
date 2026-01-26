<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeliController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManageAdminController;
use App\Http\Controllers\MobilController;

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

Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');

Route::get('/mobil/{id}/edit', [MobilController::class, 'edit'])->name('mobil.edit');
Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');

// Tambahkan baris ini di routes/web.php
Route::delete('/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

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