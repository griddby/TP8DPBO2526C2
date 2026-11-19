<?php

// Memanggil file yang dibutuhkan oleh Controller
include_once(__DIR__ . "/../models/DB.php");
include_once(__DIR__ . "/../models/Attendance.php");
include_once(__DIR__ . "/../models/Student.php");
include_once(__DIR__ . "/../models/Lecturer.php");
include_once(__DIR__ . "/../views/AttendanceView.php");

class AttendanceController {
    // Properti untuk menyimpan objek Model
    private $attendance;
    private $student;
    private $lecturer;

    // Constructor untuk membuat objek Model
    function __construct() {
        $this->attendance = new Attendance("localhost", "root", "", "tp_mvc26");
        $this->student = new Student("localhost", "root", "", "tp_mvc26");
        $this->lecturer = new Lecturer("localhost", "root", "", "tp_mvc26");
    }

    // Menampilkan seluruh data presensi
    public function index() {
        // Membuka koneksi database
        $this->attendance->open();

        // Mengambil seluruh data presensi
        $this->attendance->getAttendance();

        // Menyiapkan array untuk menyimpan data presensi
        $data = array();

        // Mengambil data presensi satu per satu
        while ($row = $this->attendance->getResult()) {
            array_push($data, $row);
        }

        // Menutup koneksi database
        $this->attendance->close();

        // Membuka koneksi database
        $this->student->open();

        // Mengambil seluruh data mahasiswa
        $this->student->getStudent();

        // Menyiapkan array untuk menyimpan data mahasiswa
        $students = array();

        // Mengambil data mahasiswa satu per satu
        while ($row = $this->student->getResult()) {
            array_push($students, $row);
        }

        // Menutup koneksi database
        $this->student->close();

        // Membuka koneksi database
        $this->lecturer->open();

        // Mengambil seluruh data dosen
        $this->lecturer->getLecturer();

        // Menyiapkan array untuk menyimpan data dosen
        $lecturers = array();

        // Mengambil data dosen satu per satu
        while ($row = $this->lecturer->getResult()) {
            array_push($lecturers, $row);
        }

        // Menutup koneksi database
        $this->lecturer->close();

        // Meneruskan data presensi, mahasiswa, dan dosen ke View
        $view = new AttendanceView();
        $view->render($data, $students, $lecturers);
    }

    // Menambahkan data presensi baru
    function add() {
        // Membuka koneksi database
        $this->attendance->open();

        // Mengambil data presensi dari form
        $id_student = $_POST['id_student'];
        $id_lecturer = $_POST['id_lecturer'];
        $attendance_date = $_POST['attendance_date'];
        $status = $_POST['status'];

        // Memanggil fungsi addAttendance pada Model untuk menyimpan data
        $this->attendance->addAttendance($id_student, $id_lecturer, $attendance_date, $status);

        // Menutup koneksi database
        $this->attendance->close();

        // Mengarahkan kembali ke halaman data presensi
        header("Location: index.php?controller=attendance");
        exit;
    }

    // Mengubah data presensi berdasarkan ID
    function edit() {
        // Membuka koneksi database
        $this->attendance->open();

        // Mengambil ID dan data presensi dari form
        $id_student = $_POST['id_student'];
        $id_lecturer = $_POST['id_lecturer'];
        $id_attendance = $_POST['id_attendance'];
        $attendance_date = $_POST['attendance_date'];
        $status = $_POST['status'];

        // Memanggil fungsi updateAttendance pada Model untuk memperbarui data
        $this->attendance->updateAttendance($id_student, $id_lecturer, $attendance_date, $status, $id_attendance);

        // Menutup koneksi database
        $this->attendance->close();

        // Mengarahkan kembali ke halaman data presensi
        header("Location: index.php?controller=attendance");
        exit;
    }

    // Menghapus data presensi berdasarkan ID
    function delete() {
        // Membuka koneksi database
        $this->attendance->open();

        // Mengambil ID presensi dari form
        $id_attendance = $_POST['id_attendance'];

        // Memanggil fungsi deleteAttendance pada Model untuk menghapus data
        $this->attendance->deleteAttendance($id_attendance);

        // Menutup koneksi database
        $this->attendance->close();

        // Mengarahkan kembali ke halaman data presensi
        header("Location: index.php?controller=attendance");
        exit;
    }
}

?>