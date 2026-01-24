<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            width: 230px;
            position: fixed;
            background: #1d3557;
            padding-top: 20px;
            color: white;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #457b9d;
        }
        .content {
            margin-left: 230px;
            padding: 30px;
        }
        .card-box {
            border-radius: 12px;
            padding: 20px;
            color: white;
        }
        .bg1 { background: #e63946; }
        .bg2 { background: #457b9d; }
        .bg3 { background: #2a9d8f; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>🚗 Admin Panel</h4>
    <a href="#">🏠 Dashboard</a>
    <a href="#">📦 Data Mobil</a>
    <a href="#">🛒 Data Pembelian</a>
    <a href="/">🚪 Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, <b>{{ Auth::user()->name }}</b> 👋</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card-box bg1">
                <h5>Total Mobil</h5>
                <h3>12</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box bg2">
                <h5>Total Pesanan</h5>
                <h3>8</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box bg3">
                <h5>User Terdaftar</h5>
                <h3>25</h3>
            </div>
        </div>
    </div>

</div>

</body>
</html>
