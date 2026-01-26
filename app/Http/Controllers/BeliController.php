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
    public function store(Request $request) {
        \App\Models\Pembelian::create([
            'mobil_id' => $request->id_mobil,
            'nama_pembeli' => auth()->user()->name,
            'jumlah' => 1,
            'total_harga' => $request->harga_mobil,
        ]);
        
        // Kurangi stok mobil otomatis
        $mobil = \App\Models\Mobil::find($request->id_mobil);
        $mobil->decrement('stok');
    
        return redirect()->back()->with('success', 'Pembelian Berhasil!');
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
