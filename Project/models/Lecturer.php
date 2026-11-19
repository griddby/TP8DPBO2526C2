<?php

class Lecturer extends DB {
    // Mengambil seluruh data dosen dari database
    function getLecturer() {
        $query = "SELECT * FROM lecturers";
        return $this->execute($query);
    }

    // Menambahkan data dosen ke database
    function addLecturer(string $name, string $nidn, string $phone, string $join_date) {
        $query = "INSERT INTO lecturers(name, nidn, phone, join_date) VALUES ('$name', '$nidn', '$phone', '$join_date')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data dosen berdasarkan ID
    function deleteLecturer(int $id_lecturer) {
        $query = "DELETE FROM lecturers WHERE id_lecturer = $id_lecturer";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengubah data dosen berdasarkan ID
    function updateLecturer(string $name, string $nidn, string $phone, string $join_date, int $id_lecturer) {
        $query = "UPDATE lecturers SET name = '$name', nidn = '$nidn', phone = '$phone', join_date = '$join_date' WHERE id_lecturer = $id_lecturer";

        // Mengeksekusi query
        return $this->execute($query);
    }
}

?>
