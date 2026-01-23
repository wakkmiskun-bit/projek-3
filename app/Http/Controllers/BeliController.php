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
        //
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
    // Validasi data
    $validated = $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'no_telepon' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
    ]);

    // Simpan ke database
    Beli::create($validated);

    return redirect()->back()->with('success', 'Data berhasil dikirim!');
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
    public function destroy(string $id)
    {
        //
    }
}
