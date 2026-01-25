<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beli;


class BeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $belis = \App\Models\Beli::all();
    return view('admin.beli.index', compact('belis'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Simpan ke Database
    $data = \App\Models\Beli::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'no_telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'kota' => 'User Input', // atau tambahkan input kota di form
    ]);

    // 2. Susun format pesan WhatsApp
    $nomorWA = "628123456789"; // GANTI NOMOR ADMIN KAMU
    $pesan = "Halo Admin, saya sudah mengisi formulir pembelian!\n\n"
           . "Nama: " . $data->nama . "\n"
           . "Email: " . $data->email . "\n"
           . "Alamat: " . $data->alamat;

    // 3. Alihkan ke WhatsApp
    return redirect()->away("https://wa.me/" . $nomorWA . "?text=" . urlencode($pesan));

    $belis = \App\Models\Beli::all(); 
    
    // Kirim data ke folder view admin/beli/index.blade.php
    return view('admin.beli.index', compact('belis'));
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $data = \App\Models\Beli::findOrFail($id);
    $data->delete();

    return redirect()->route('beli.index')->with('success', 'Data berhasil dihapus');
}
}
