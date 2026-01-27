<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian; // Pastikan menggunakan model Pembelian secara konsisten

class BeliController extends Controller
{
    public function index()
    {
        // Mengambil semua data untuk ditampilkan di tabel Admin
        $pembelians = Pembelian::all();
        return view('admin.pembelian', compact('pembelians'));
    }

    public function store(Request $request) 
    {
        // 1. Validasi Input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'telepon' => 'required',
            'kota' => 'required',
            'alamat' => 'required',
        ]);

        // 2. Cek Duplikat (Anti Spam)
        $duplikat = Pembelian::where('nama', $request->nama)
                    ->where('telepon', $request->telepon)
                    ->where('created_at', '>=', now()->subSeconds(10))
                    ->first();

        if ($duplikat) {
            return response()->json(['message' => 'Data sedang diproses, mohon tunggu sebentar.'], 422);
        }

        // 3. Simpan ke Database
        Pembelian::create($request->all());

        // 4. Kirim Respon JSON (Agar user tetap di halaman katalog)
        return response()->json([
            'status' => 'success',
            'message' => 'Pesanan berhasil dikirim! Silahkan cek riwayat atau tunggu admin menghubungi Anda.'
        ]);
    }

    public function destroy($id)
    {
        // Gunakan Pembelian:: agar konsisten dengan tabel yang ada
        $data = Pembelian::findOrFail($id);
        $data->delete();

        // Redirect kembali ke halaman daftar pembelian admin
        return redirect()->route('admin.pembelian')->with('success', 'Data berhasil dihapus');
    }
}