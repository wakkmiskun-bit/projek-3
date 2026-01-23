<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - AutoShow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #333; color: white; }
        .btn-delete { color: red; cursor: pointer; border: none; background: none; }
    </style>
</head>
<body>
    <h1>👨‍💼 Dashboard Admin - Daftar Pembelian</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataBeli as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_telepon }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->kota }}</td>
                <td>
                    <form action="{{ route('beli.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>