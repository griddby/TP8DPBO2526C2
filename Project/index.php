<?php

// Memeriksa apakah pengguna membuka halaman Home
if (!isset($_GET['controller'])) {
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - TP MVC 2026</title>

    <!-- Menghubungkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar untuk navigasi halaman -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TP MVC 2026</a>

            <div class="navbar-nav">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link" href="index.php?controller=lecturer">Dosen</a>
                <a class="nav-link" href="index.php?controller=student">Mahasiswa</a>
                <a class="nav-link" href="index.php?controller=attendance">Presensi</a>
            </div>
        </div>
    </nav>

    <!-- Konten utama halaman Home -->
    <div class="container my-5">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-4">
                <h1 class="display-5 fw-bold">Sistem Informasi Akademik</h1>

                <p class="col-md-8 fs-5">
                    Selamat datang di Sistem Informasi Akademik TP MVC 2026.
                    Website ini digunakan untuk mengelola data dosen,
                    mahasiswa, dan presensi.
                </p>

                <a href="index.php?controller=lecturer" class="btn btn-primary btn-lg">
                    Mulai
                </a>
            </div>
        </div>

        <!-- Menampilkan pilihan menu -->
        <div class="row g-4">

            <!-- Menu data dosen -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Data Dosen</h5>
                        <p class="card-text">
                            Mengelola informasi dosen, seperti nama, NIDN,
                            nomor telepon, dan tanggal bergabung.
                        </p>
                        <a href="index.php?controller=lecturer" class="btn btn-primary">
                            Lihat Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu data mahasiswa -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Data Mahasiswa</h5>
                        <p class="card-text">
                            Mengelola informasi mahasiswa, seperti nama,
                            NIM, nomor telepon, dan program studi.
                        </p>
                        <a href="index.php?controller=student" class="btn btn-primary">
                            Lihat Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu data presensi -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Data Presensi</h5>
                        <p class="card-text">
                            Mengelola data kehadiran mahasiswa berdasarkan dosen, tanggal, dan status presensi.
                        </p>
                        <a href="index.php?controller=attendance" class="btn btn-primary">
                            Lihat Data
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Menghubungkan Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
} else {
    // Menentukan Controller yang akan digunakan
    $controller_name = $_GET['controller'];

    // Menentukan fungsi yang akan dijalankan
    $action = $_GET['action'] ?? 'index';

    // Memilih Controller berdasarkan parameter URL
    switch ($controller_name) {
        case 'lecturer':
            // Memanggil file LecturerController
            include_once("controllers/LecturerController.php");

            // Membuat objek LecturerController
            $controller = new LecturerController();
            break;

        case 'student':
            // Memanggil file StudentController
            include_once("controllers/StudentController.php");

            // Membuat objek StudentController
            $controller = new StudentController();
            break;

        case 'attendance':
            // Memanggil file AttendanceController
            include_once("controllers/AttendanceController.php");

            // Membuat objek AttendanceController
            $controller = new AttendanceController();
            break;

        default:
            // Menampilkan pesan jika Controller tidak ditemukan
            die("Controller tidak ditemukan!");
    }

    // Menentukan fungsi yang boleh dijalankan
    $allowed_actions = ['index', 'add', 'edit', 'delete'];

    // Memeriksa ketersediaan fungsi pada Controller
    if (in_array($action, $allowed_actions) && method_exists($controller, $action)) {
        // Menjalankan fungsi pada Controller
        $controller->$action();
    } else {
        // Menampilkan pesan jika fungsi tidak ditemukan
        die("Action tidak ditemukan!");
    }
}

?>
