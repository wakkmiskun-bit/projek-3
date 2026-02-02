<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;

class PembelianController extends Controller
{
    // 🔹 TAMPILKAN DATA KE DASHBOARD ADMIN
    public function index()
    {
        // Aku ganti variabelnya jadi $belis supaya cocok sama file pembelian.blade.php kamu
        $belis = Pembelian::latest()->get();
        return view('admin.pembelian', compact('belis'));
    }

    // 🔹 SIMPAN DATA + BUKA WHATSAPP
    public function store(Request $request)
    {
        $request->validate([
            'nama'        => 'required',
            'email'       => 'required|email',
            'no_telepon'  => 'required',
            'kota'        => 'required',
            'alamat'      => 'required',
            'nama_mobil'  => 'required'
        ]);

        $pembelian = Pembelian::create([
            'nama'        => $request->nama,
            'email'       => $request->email,
            'no_telepon'  => $request->no_telepon,
            'kota'        => $request->kota,
            'alamat'      => $request->alamat,
            'nama_mobil'  => $request->nama_mobil
        ]);

        $pesan = "Halo Admin,%0A%0ASaya ingin membeli kendaraan:%0A".
                 "Nama: {$pembelian->nama}%0A".
                 "Mobil: {$pembelian->nama_mobil}%0A".
                 "No HP: {$pembelian->no_telepon}%0A".
                 "Kota: {$pembelian->kota}%0A".
                 "Alamat: {$pembelian->alamat}";

        $urlWa = "https://wa.me/6285191163819?text=$pesan";

        return response()->json([
            'message' => 'Pesanan berhasil dikirim!',
            'target_url' => $urlWa
        ]);
    }

    // 🔹 HAPUS DATA
    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();
        
        return redirect()->route('admin.pembelian')->with('success', 'Data penjualan berhasil dihapus!');
    }
}