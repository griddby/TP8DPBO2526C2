<?php

class Student extends DB {
    // Mengambil seluruh data mahasiswa dari database
    function getStudent() {
        $query = "SELECT * FROM students";
        return $this->execute($query);
    }

    // Menambahkan data mahasiswa ke database
    function addStudent(string $name, string $nim, string $phone, string $prodi) {
        $query = "INSERT INTO students(name, nim, phone, prodi) VALUES ('$name', '$nim', '$phone', '$prodi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data mahasiswa berdasarkan ID
    function deleteStudent(int $id_student) {
        $query = "DELETE FROM students WHERE id_student = $id_student";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengubah data mahasiswa berdasarkan ID
    function updateStudent(string $name, string $nim, string $phone, string $prodi, int $id_student) {
        $query = "UPDATE students SET name = '$name', nim = '$nim', phone = '$phone', prodi = '$prodi' WHERE id_student = $id_student";

        // Mengeksekusi query
        return $this->execute($query);
    }
}

?>
