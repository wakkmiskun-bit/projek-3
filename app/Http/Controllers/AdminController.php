<?php

namespace App\Http\Controllers; // WAJIB ADA BARIS INI

use Illuminate\Http\Request;
use App\Models\Beli;
use App\Models\Admin;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPesanan = Beli::count(); 
        $totalUser = Admin::count(); 
        $totalMobil = 12; 

        return view('admin.dashboard', compact('totalPesanan', 'totalUser', 'totalMobil'));
    }
}