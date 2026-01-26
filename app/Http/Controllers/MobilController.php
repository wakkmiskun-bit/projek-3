<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil; // Pastikan Model Mobil diimpor

class MobilController extends Controller
{
    // Menampilkan halaman daftar mobil
    public function index()
{
    $mobils = Mobil::all();
    
    // Tambahkan ini agar saat extends dashboard tidak error
    $totalMobil = Mobil::count();
    $totalPesanan = \App\Models\Pembelian::count(); 
    $totalUser = \App\Models\User::count();

    return view('mobil', compact('mobils', 'totalMobil', 'totalPesanan', 'totalUser'));
}

    // Menyimpan data mobil baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil' => 'required',
            'merek'      => 'required',
            'harga'      => 'required|numeric',
            'stok'       => 'required|numeric',
        ]);

        Mobil::create([
            'nama_mobil' => $request->nama_mobil,
            'merek'      => $request->merek,
            'harga'      => $request->harga,
            'stok'       => $request->stok,
        ]);

        return redirect()->back()->with('success', 'Mobil berhasil ditambahkan!');
    }

    // Tambahkan fungsi ini di dalam class MobilController
public function destroy($id)
{
    $mobil = Mobil::findOrFail($id); // Cari data, jika tidak ada kirim 404
    $mobil->delete(); // Hapus data

    return redirect()->back()->with('success', 'Data mobil berhasil dihapus!');
}

    // Fungsi untuk mengambil data yang akan diedit
    public function edit($id)
    {
        $mobil = Mobil::find($id);
        return response()->json($mobil); // Ini wajib JSON untuk AJAX
    }

// Fungsi untuk menyimpan perubahan
public function update(Request $request, $id)
{
    $request->validate([
        'nama_mobil' => 'required',
        'merek'      => 'required',
        'harga'      => 'required|numeric',
        'stok'       => 'required|numeric',
    ]);

    $mobil = Mobil::findOrFail($id);
    $mobil->update($request->all());

    return redirect()->back()->with('success', 'Data mobil berhasil diperbarui!');
}
}