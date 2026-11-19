
<?php

class AttendanceView {
    // Menampilkan data presensi yang diterima dari Controller
    public function render($data, $students, $lecturers) {
        // Menyiapkan nomor urut data presensi
        $no = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Presensi</title>

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
                <a class="nav-link" href="index.php?controller=student">Mahasiswa</a>
                <a class="nav-link active" href="index.php?controller=attendance">Presensi</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">

        <!-- Judul halaman -->
        <h1 class="mb-4">Data Presensi</h1>

        <!-- Form untuk menambahkan data presensi -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Tambah Presensi
            </div>

            <div class="card-body">
                <form action="index.php?controller=attendance&action=add" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <select name="id_student" class="form-select" required>
                                <option value="">-- Pilih Mahasiswa --</option>

                                <?php
                                // Menampilkan pilihan mahasiswa
                                foreach ($students as $student) {
                                    $id_student = htmlspecialchars($student['id_student'], ENT_QUOTES, 'UTF-8');
                                    $student_name = htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8');
                                ?>

                                <option value="<?= $id_student ?>">
                                    <?= $student_name ?>
                                </option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <select name="id_lecturer" class="form-select" required>
                                <option value="">-- Pilih Dosen --</option>

                                <?php
                                // Menampilkan pilihan dosen
                                foreach ($lecturers as $lecturer) {
                                    $id_lecturer = htmlspecialchars($lecturer['id_lecturer'], ENT_QUOTES, 'UTF-8');
                                    $lecturer_name = htmlspecialchars($lecturer['name'], ENT_QUOTES, 'UTF-8');
                                ?>

                                <option value="<?= $id_lecturer ?>">
                                    <?= $lecturer_name ?>
                                </option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Presensi</label>
                            <input type="date" name="attendance_date" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Presensi</label>
                            <select name="status" class="form-select" required>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Tambah Presensi
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel untuk menampilkan seluruh data presensi -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Daftar Presensi</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nama Dosen</th>
                                <th>Tanggal Presensi</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            // Mengambil dan menampilkan setiap data presensi
                            foreach ($data as $val) {
                                // Mengambil data presensi berdasarkan nama kolom
                                $id_attendance = htmlspecialchars($val['id_attendance'], ENT_QUOTES, 'UTF-8');
                                $id_student = htmlspecialchars($val['id_student'], ENT_QUOTES, 'UTF-8');
                                $student_name = htmlspecialchars($val['student_name'], ENT_QUOTES, 'UTF-8');
                                $id_lecturer = htmlspecialchars($val['id_lecturer'], ENT_QUOTES, 'UTF-8');
                                $lecturer_name = htmlspecialchars($val['lecturer_name'], ENT_QUOTES, 'UTF-8');
                                $attendance_date = htmlspecialchars($val['attendance_date'], ENT_QUOTES, 'UTF-8');
                                $status = htmlspecialchars($val['status'], ENT_QUOTES, 'UTF-8');
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $student_name ?></td>
                                <td><?= $lecturer_name ?></td>
                                <td><?= $attendance_date ?></td>

                                <td>
                                    <!-- Menampilkan status presensi -->
                                    <?php
                                    if ($status == 'Hadir') {
                                        echo '<span class="badge bg-success">Hadir</span>';
                                    } elseif ($status == 'Izin') {
                                        echo '<span class="badge bg-info text-dark">Izin</span>';
                                    } elseif ($status == 'Sakit') {
                                        echo '<span class="badge bg-warning text-dark">Sakit</span>';
                                    } else {
                                        echo '<span class="badge bg-danger">Alpa</span>';
                                    }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <!-- Tombol untuk membuka modal edit -->
                                    <button type="button" class="btn btn-success btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $id_attendance ?>">
                                        Edit
                                    </button>

                                    <!-- Form untuk menghapus data presensi -->
                                    <form action="index.php?controller=attendance&action=delete"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data presensi ini?')">

                                        <input type="hidden" name="id_attendance" value="<?= $id_attendance ?>">

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal untuk mengubah data presensi -->
        <?php
        // Mengambil kembali data untuk membuat modal edit setiap presensi
        foreach ($data as $val) {
            // Mengambil data presensi berdasarkan nama kolom
            $id_attendance = htmlspecialchars($val['id_attendance'], ENT_QUOTES, 'UTF-8');
            $id_student = htmlspecialchars($val['id_student'], ENT_QUOTES, 'UTF-8');
            $id_lecturer = htmlspecialchars($val['id_lecturer'], ENT_QUOTES, 'UTF-8');
            $attendance_date = htmlspecialchars($val['attendance_date'], ENT_QUOTES, 'UTF-8');
            $status = htmlspecialchars($val['status'], ENT_QUOTES, 'UTF-8');
        ?>

        <div class="modal fade" id="edit<?= $id_attendance ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Presensi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form action="index.php?controller=attendance&action=edit" method="POST">

                            <!-- Mengirim ID presensi yang akan diubah -->
                            <input type="hidden" name="id_attendance" value="<?= $id_attendance ?>">

                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa</label>
                                <select name="id_student" class="form-select" required>
                                    <?php
                                    // Menampilkan pilihan mahasiswa pada form edit
                                    foreach ($students as $student) {
                                        $student_id = htmlspecialchars($student['id_student'], ENT_QUOTES, 'UTF-8');
                                        $student_name = htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8');
                                    ?>

                                    <option value="<?= $student_id ?>"
                                        <?= $student_id == $id_student ? 'selected' : '' ?>>
                                        <?= $student_name ?>
                                    </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Dosen</label>
                                <select name="id_lecturer" class="form-select" required>
                                    <?php
                                    // Menampilkan pilihan dosen pada form edit
                                    foreach ($lecturers as $lecturer) {
                                        $lecturer_id = htmlspecialchars($lecturer['id_lecturer'], ENT_QUOTES, 'UTF-8');
                                        $lecturer_name = htmlspecialchars($lecturer['name'], ENT_QUOTES, 'UTF-8');
                                    ?>

                                    <option value="<?= $lecturer_id ?>"
                                        <?= $lecturer_id == $id_lecturer ? 'selected' : '' ?>>
                                        <?= $lecturer_name ?>
                                    </option>

                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Presensi</label>
                                <input type="date" name="attendance_date" class="form-control"
                                    value="<?= $attendance_date ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Presensi</label>
                                <select name="status" class="form-select" required>
                                    <option value="Hadir" <?= $status == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
                                    <option value="Izin" <?= $status == 'Izin' ? 'selected' : '' ?>>Izin</option>
                                    <option value="Sakit" <?= $status == 'Sakit' ? 'selected' : '' ?>>Sakit</option>
                                    <option value="Alpa" <?= $status == 'Alpa' ? 'selected' : '' ?>>Alpa</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
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

    </div>

    <!-- Menghubungkan Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
    }
}

?>
