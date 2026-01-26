<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;     // Tambahkan ini
use App\Models\Pembelian; // Tambahkan ini (Pastikan nama model sesuai)
use App\Models\User;      // Tambahkan ini

class AdminController extends Controller
{
    public function dashboard()
{
    // Ini akan menghitung jumlah baris asli di tabel mobil Anda
    $totalMobil = \App\Models\Mobil::count(); 
    
    $totalPesanan = 0; // Sementara 0 jika tabel pembelian belum ada
    $totalUser = \App\Models\User::count();

    return view('admin.dashboard', compact('totalMobil', 'totalPesanan', 'totalUser'));
}
}