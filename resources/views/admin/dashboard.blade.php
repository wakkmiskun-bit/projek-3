<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #f4f6f9; }
        .sidebar { height: 100vh; width: 240px; position: fixed; background: #1d3557; color: white; padding-top: 20px; z-index: 1000; }
        .sidebar h4 { text-align: center; margin-bottom: 30px; font-weight: bold; }
        .sidebar a { display: block; color: rgba(255,255,255,0.8); padding: 12px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #457b9d; color: white; border-left: 5px solid #e63946; }
        .content { margin-left: 240px; padding: 30px; min-height: 100vh; }
        .card-box { border-radius: 12px; padding: 25px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <h4>🚗 Admin Panel</h4>
    <a href="{{ route('admin.dashboard') }}" class="active">🏠 Dashboard</a>
    <a href="#">📦 Data Mobil</a>
    <a href="{{ route('beli.index') }}">🛒 Data Pembelian</a>
    <a href="{{ route('manage-admin.index') }}">👥 Staff Admin</a>
    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="w-100 bg-transparent border-0 text-white text-start px-4 py-2 hover:text-danger">🚪 Logout</button>
    </form>
</div>

<div class="content">
    <h2 class="fw-bold mb-4">Dashboard Admin</h2>
    <p>Selamat datang, <b>{{ Auth::user()->name }}</b> 👋</p>
    <div class="row g-4 mt-2">
        <div class="col-md-4"><div class="card-box" style="background: #e63946;"><h5>Total Mobil</h5><h3>12</h3></div></div>
        <div class="col-md-4"><div class="card-box" style="background: #457b9d;"><h5>Total Pesanan</h5><h3>8</h3></div></div>
        <div class="col-md-4"><div class="card-box" style="background: #2a9d8f;"><h5>User Terdaftar</h5><h3>25</h3></div></div>
    </div>
</div>
</body>
</html>