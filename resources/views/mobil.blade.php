@extends('admin.admin') 

@section('main-content')
<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Data Mobil</h5>
        <button class="btn btn-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#modalTambahMobil">
            <i class="fas fa-plus me-1"></i> Tambah Mobil
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
        @endif

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Mobil</th>
                    <th>Merek</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mobils as $m)
                <tr>
                    <td>{{ $m->nama_mobil }}</td>
                    <td>{{ $m->merek }}</td>
                    <td>Rp {{ number_format($m->harga, 0, ',', '.') }}</td>
                    <td>{{ $m->stok }}</td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm text-white" onclick="editMobil('{{ $m->id }}')">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="/mobil/{{ $m->id }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahMobil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('mobil.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nama Mobil</label>
                    <input type="text" name="nama_mobil" class="form-control mb-2" required>
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" class="form-control mb-2" required>
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control mb-2" required>
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control mb-2" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditMobil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form id="formEditMobil" method="POST">
                @csrf @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title fw-bold">Edit Data Mobil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nama Mobil</label>
                    <input type="text" name="nama_mobil" id="edit_nama" class="form-control mb-2" required>
                    <label class="form-label">Merek</label>
                    <input type="text" name="merek" id="edit_merek" class="form-control mb-2" required>
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" id="edit_harga" class="form-control mb-2" required>
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" id="edit_stok" class="form-control mb-2" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning text-white w-100">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/mobil.js') }}"></script>

@endsection