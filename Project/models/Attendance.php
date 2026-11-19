<?php

class Attendance extends DB {
    // Mengambil seluruh data presensi beserta nama mahasiswa dan dosen
    function getAttendance() {
        $query = "SELECT attendance.id_attendance,
                         attendance.id_student,
                         students.name AS student_name,
                         attendance.id_lecturer,
                         lecturers.name AS lecturer_name,
                         attendance.attendance_date,
                         attendance.status
                  FROM attendance
                  JOIN students ON attendance.id_student = students.id_student
                  JOIN lecturers ON attendance.id_lecturer = lecturers.id_lecturer";
        return $this->execute($query);
    }

    // Menambahkan data presensi ke database
    function addAttendance(int $id_student, int $id_lecturer, string $attendance_date, string $status) {
        $query = "INSERT INTO attendance(id_student, id_lecturer, attendance_date, status) VALUES ($id_student, $id_lecturer, '$attendance_date', '$status')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data presensi berdasarkan ID
    function deleteAttendance(int $id_attendance) {
        $query = "DELETE FROM attendance WHERE id_attendance = $id_attendance";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengubah data presensi berdasarkan ID
    function updateAttendance(int $id_student, int $id_lecturer, string $attendance_date, string $status, int $id_attendance) {
        $query = "UPDATE attendance SET id_student = $id_student, id_lecturer = $id_lecturer, attendance_date = '$attendance_date', status = '$status' WHERE id_attendance = $id_attendance";

        // Mengeksekusi query
        return $this->execute($query);
    }
}

?>