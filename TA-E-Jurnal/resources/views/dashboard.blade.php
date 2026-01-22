<!-- DASHBOARD ADMIN E-JURNAL PKL (Laravel Blade + Bootstrap)
     Fitur:
     - Sidebar toggle
     - CRUD Akun Pembimbing
     - CRUD Akun Siswa
     - CRUD Data PKL (tempat, tanggal, pembimbing)
-->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | E-Jurnal PKL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { overflow-x: hidden; }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1f2937;
            transition: all 0.3s;
        }
        .sidebar.hide { margin-left: -250px; }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
        }
        .sidebar a:hover { background: #374151; }
        .content { width: 100%; padding: 20px; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <h5 class="text-white text-center py-3">ADMIN PANEL</h5>
        <a href="#">Dashboard</a>
        <a href="#">Data Siswa</a>
        <a href="#">Data Pembimbing</a>
        <a href="#">Data PKL</a>
        <a href="#">Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <button class="btn btn-outline-dark mb-3" onclick="toggleSidebar()">☰</button>

        <h3>Dashboard Admin</h3>
        <p>Kelola akun siswa, pembimbing, dan data PKL.</p>

        <!-- STAT CARD -->
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">Total Siswa<br><b>120</b></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">Total Pembimbing<br><b>10</b></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">Siswa PKL Aktif<br><b>80</b></div>
                </div>
            </div>
        </div>

        <!-- CONTOH TABEL DATA PKL -->
        <div class="mt-4">
            <h5>Data PKL Siswa</h5>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Tempat PKL</th>
                        <th>Tanggal Berangkat</th>
                        <th>Pembimbing</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmad Fauzi</td>
                        <td>PT Telkom Indonesia</td>
                        <td>2025-01-10</td>
                        <td>Pak Budi</td>
                        <td>
                            <button class="btn btn-sm btn-warning">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary">+ Tambah Data PKL</button>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('hide');
    }
</script>

</body>
</html>
