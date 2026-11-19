<?php

class LecturerView {
    // Menampilkan data dosen yang diterima dari Controller
    public function render($data) {
        // Menyiapkan nomor urut data dosen
        $no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dosen</title>

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
                <a class="nav-link active" href="index.php?controller=lecturer">Dosen</a>
                <a class="nav-link" href="index.php?controller=student">Mahasiswa</a>
                <a class="nav-link" href="index.php?controller=attendance">Presensi</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">

        <!-- Judul halaman -->
        <h1 class="mb-4">Data Dosen</h1>

        <!-- Form untuk menambahkan data dosen -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Tambah Dosen
            </div>

            <div class="card-body">
                <form action="index.php?controller=lecturer&action=add" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIDN</label>
                            <input type="text" name="nidn" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Bergabung</label>
                            <input type="date" name="join_date" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Tambah Dosen
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan seluruh data dosen -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Daftar Dosen</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIDN</th>
                                <th>Telepon</th>
                                <th>Tanggal Bergabung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            // Mengambil dan menampilkan setiap data dosen
                            foreach ($data as $val) {
                                // Mengambil data dosen berdasarkan nama kolom
                                $id_lecturer = htmlspecialchars($val['id_lecturer']);
                                $name = htmlspecialchars($val['name']);
                                $nidn = htmlspecialchars($val['nidn']);
                                $phone = htmlspecialchars($val['phone']);
                                $join_date = htmlspecialchars($val['join_date']);
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $name ?></td>
                                <td><?= $nidn ?></td>
                                <td><?= $phone ?></td>
                                <td><?= $join_date ?></td>

                                <td class="text-center">
                                    <!-- Tombol untuk membuka modal edit -->
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $id_lecturer ?>">
                                        Edit
                                    </button>

                                    <!-- Form untuk menghapus data dosen -->
                                    <form action="index.php?controller=lecturer&action=delete"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data dosen ini?')">

                                        <input type="hidden" name="id_lecturer" value="<?= $id_lecturer ?>">

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk mengubah data dosen -->
                            <div class="modal fade" id="edit<?= $id_lecturer ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Data Dosen</h5>
                                            <button type="button" class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="index.php?controller=lecturer&action=edit" method="POST">

                                                <!-- Mengirim ID dosen yang akan diubah -->
                                                <input type="hidden" name="id_lecturer" value="<?= $id_lecturer ?>">

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Dosen</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="<?= $name ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">NIDN</label>
                                                    <input type="text" name="nidn" class="form-control"
                                                        value="<?= $nidn ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Telepon</label>
                                                    <input type="text" name="phone" class="form-control"
                                                        value="<?= $phone ?>" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Bergabung</label>
                                                    <input type="date" name="join_date" class="form-control"
                                                        value="<?= $join_date ?>" required>
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
