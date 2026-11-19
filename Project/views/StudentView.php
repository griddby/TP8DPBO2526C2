<?php

class StudentView {
    // Menampilkan data mahasiswa yang diterima dari Controller
    public function render($data) {
        // Menyiapkan nomor urut data mahasiswa
        $no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <!-- Menghubungkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Menghubungkan file CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Navbar untuk navigasi antarhalaman -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">TP MVC 2026</a>

            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="index.php?controller=lecturer">Dosen</a>
                <a class="nav-link active" href="index.php?controller=student">Mahasiswa</a>
                <a class="nav-link" href="index.php?controller=attendance">Presensi</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">

        <!-- Judul halaman -->
        <h1 class="mb-4">Data Mahasiswa</h1>

        <!-- Form untuk menambahkan data mahasiswa -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Tambah Mahasiswa
            </div>

            <div class="card-body">
                <form action="index.php?controller=student&action=add" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Tambah Mahasiswa
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan seluruh data mahasiswa -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Daftar Mahasiswa</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Telepon</th>
                                <th>Program Studi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            // Mengambil dan menampilkan setiap data mahasiswa
                            foreach ($data as $val) {
                                // Mengambil data mahasiswa berdasarkan nama kolom
                                $id_student = htmlspecialchars($val['id_student'], ENT_QUOTES, 'UTF-8');
                                $name = htmlspecialchars($val['name'], ENT_QUOTES, 'UTF-8');
                                $nim = htmlspecialchars($val['nim'], ENT_QUOTES, 'UTF-8');
                                $phone = htmlspecialchars($val['phone'], ENT_QUOTES, 'UTF-8');
                                $prodi = htmlspecialchars($val['prodi'] ?? '', ENT_QUOTES, 'UTF-8');
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $name ?></td>
                                <td><?= $nim ?></td>
                                <td><?= $phone ?></td>
                                <td><?= $prodi ?></td>

                                <td class="text-center">
                                    <!-- Tombol untuk membuka modal edit -->
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $id_student ?>">
                                        Edit
                                    </button>

                                    <!-- Form untuk menghapus data mahasiswa -->
                                    <form action="index.php?controller=student&action=delete"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')">

                                        <input type="hidden" name="id_student" value="<?= $id_student ?>">

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk mengubah data mahasiswa -->
                            <div class="modal fade" id="edit<?= $id_student ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Mahasiswa</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="index.php?controller=student&action=edit" method="POST">

                                                <!-- Mengirim ID mahasiswa yang akan diubah -->
                                                <input type="hidden" name="id_student" value="<?= $id_student ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Mahasiswa</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?= $name ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">NIM</label>
                                                    <input type="text" name="nim" class="form-control"
                                                        value="<?= $nim ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?= $phone ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Program Studi</label>
                                                    <input type="text" name="prodi" class="form-control"
                                                        value="<?= $prodi ?>">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Batal
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        Simpan Perubahan
                                                    </button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Menghubungkan Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
    }
}

?>