<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('mobils', function (Blueprint $table) {
        $table->id();
        $table->string('nama_mobil');
        $table->string('merek');
        $table->integer('harga');
        $table->integer('stok');
        // Tambahkan kolom baru sesuai kartu frontend:
        $table->string('seri')->nullable();
        $table->string('mesin')->nullable();
        $table->string('transmisi')->nullable();
        $table->string('bahan_bakar')->nullable();
        $table->string('cc')->nullable();
        $table->string('warna')->nullable();
        $table->integer('tahun')->nullable();
        $table->string('penggerak')->nullable();
        $table->string('gambar')->nullable(); // Untuk upload foto
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
