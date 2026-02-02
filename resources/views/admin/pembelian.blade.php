@extends('admin.admin')

@section('main-content')
<div class="container-fluid p-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-white">
                <i class="fas fa-receipt text-info me-2"></i> Data Transaksi Penjualan
            </h2>
            <p class="text-muted small mb-0">Kelola dan pantau semua riwayat transaksi pembeli secara real-time.</p>
        </div>
        <div class="text-end">
            <span class="badge px-3 py-2 shadow-sm" style="background: #2563eb; border-radius: 12px; font-weight: 700; color: #ffffff;">
                Total: {{ count($belis) }} Transaksi
            </span>
        </div>
    </div>

    {{-- Tabel Utama --}}
    <div class="card border-0 shadow-lg" style="background: #0f172a; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1);">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #1e293b;">
                    <tr>
                        <th class="py-4 px-4 text-center" style="font-size: 11px; color: #94a3b8; text-transform: uppercase;">NO</th>
                        <th class="py-4" style="font-size: 11px; color: #94a3b8; text-transform: uppercase;">Pembeli & Email</th>
                        <th class="py-4" style="font-size: 11px; color: #94a3b8; text-transform: uppercase;">Kontak</th>
                        <th class="py-4" style="font-size: 11px; color: #94a3b8; text-transform: uppercase;">Alamat & Kota</th>
                        <th class="py-4 text-center" style="font-size: 11px; color: #94a3b8; text-transform: uppercase;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($belis as $item)
                    {{-- Baris dibuat agak terang sedikit agar tulisan hitam terlihat jelas --}}
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; transition: 0.3s;">
                        <td class="px-4 text-center fw-bold" style="color: #64748b;">#{{ $loop->iteration }}</td>
                        
                        {{-- FIX: TULISAN WARNA HITAM --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3 d-flex align-items-center justify-content-center" 
                                     style="width: 42px; height: 42px; background: #0f172a; border-radius: 12px; color: #ffffff; font-weight: 800;">
                                    {{ strtoupper(substr($item->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold mb-0" style="font-size: 15px; color: #000000;">
                                        {{ $item->nama }}
                                    </div>
                                    <div style="color: #334155; font-size: 13px; font-weight: 600;">
                                        {{ $item->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="https://wa.me/{{ $item->no_telepon }}" target="_blank" 
                               style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 13px; border: 1px solid #bbf7d0;">
                                <i class="fab fa-whatsapp me-2"></i>{{ $item->no_telepon }}
                            </a>
                        </td>

                        <td>
                            <div style="color: #000000; font-size: 13.5px; font-weight: 600;">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>{{ $item->alamat }}
                            </div>
                            <span class="badge mt-1" style="background: #e2e8f0; color: #0f172a; font-weight: 800; font-size: 10px; border: 1px solid #cbd5e1;">
                                {{ strtoupper($item->kota) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('beli.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn-del" onclick="return confirm('Hapus data ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .btn-del {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        transition: 0.3s;
    }
    .btn-del:hover {
        background: #ef4444;
        color: white;
    }
    tr:hover {
        background: #f1f5f9 !important;
    }
</style>
@endsection