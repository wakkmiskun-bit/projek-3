<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; overflow-x: hidden; }
        .sidebar { height: 100vh; width: 250px; position: fixed; background: #2c3e50; color: white; transition: 0.3s; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 15px 20px; display: block; }
        .sidebar a:hover { background: #34495e; color: white; }
        .sidebar .active { background: #3498db; color: white; }
        .main-container { margin-left: 250px; background: #f8f9fa; min-height: 100vh; }
        .navbar { background: white; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="p-3 text-center">
            <h4 class="fw-bold"><i class="fas fa-car-side"></i> Admin Panel</h4>
        </div>
        <hr>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('mobil.index') }}" class="{{ request()->is('mobil*') ? 'active' : '' }}">
                <i class="fas fa-car me-2"></i> Data Mobil
            </a>
            <a href="#"><i class="fas fa-shopping-cart me-2"></i> Data Pembelian</a>
            <a href="#"><i class="fas fa-users me-2"></i> Staff Admin</a>
            <hr>
            <a href="#" class="nav-link text-danger" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt me-2"></i> Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
        </nav>
    </div>

    <div class="main-container">
        <nav class="navbar navbar-expand-lg px-4 py-3 shadow-sm">
            <div class="container-fluid">
                <span class="navbar-text fw-medium">
                    Selamat datang, <strong>Admin 👋</strong>
                </span>
            </div>
        </nav>

        <div class="p-4">
            @yield('main-content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>