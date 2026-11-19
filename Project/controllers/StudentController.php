<?php

// Memanggil file yang dibutuhkan oleh Controller
include_once(__DIR__ . "/../models/DB.php");
include_once(__DIR__ . "/../models/Student.php");
include_once(__DIR__ . "/../views/StudentView.php");

class StudentController {
    // Properti untuk menyimpan objek Student
    private $student;

    // Constructor untuk membuat objek Student
    function __construct() {
        $this->student = new Student("localhost", "root", "", "tp_mvc26");
    }

    // Menampilkan seluruh data mahasiswa
    public function index() {
        // Membuka koneksi database
        $this->student->open();

        // Mengambil seluruh data mahasiswa dari Model
        $this->student->getStudent();

        // Menyiapkan array untuk menyimpan data mahasiswa
        $data = array();

        // Mengambil data satu per satu dan menyimpannya ke dalam array
        while ($row = $this->student->getResult()) {
            array_push($data, $row);
        }

        // Menutup koneksi database
        $this->student->close();

        // Meneruskan data ke View untuk ditampilkan
        $view = new StudentView();
        $view->render($data);
    }

    // Menambahkan data mahasiswa baru
    function add() {
        // Membuka koneksi database
        $this->student->open();

        // Mengambil data mahasiswa dari form
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $phone = $_POST['phone'];
        $prodi = $_POST['prodi'];

        // Memanggil fungsi addStudent pada Model untuk menyimpan data
        $this->student->addStudent($name, $nim, $phone, $prodi);

        // Menutup koneksi database
        $this->student->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=student");
        exit;
    }

    // Mengubah data mahasiswa berdasarkan ID
    function edit() {
        // Membuka koneksi database
        $this->student->open();

        // Mengambil ID dan data mahasiswa dari form
        $id_student = $_POST['id_student'];
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $phone = $_POST['phone'];
        $prodi = $_POST['prodi'];

        // Memanggil fungsi updateStudent pada Model untuk memperbarui data
        $this->student->updateStudent($name, $nim, $phone, $prodi, $id_student);

        // Menutup koneksi database
        $this->student->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=student");
        exit;
    }

    // Menghapus data mahasiswa berdasarkan ID
    function delete() {
        // Membuka koneksi database
        $this->student->open();

        // Mengambil ID mahasiswa dari form
        $id_student = $_POST['id_student'];

        // Memanggil fungsi deleteStudent pada Model untuk menghapus data
        $this->student->deleteStudent($id_student);

        // Menutup koneksi database
        $this->student->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=student");
        exit;
    }
}

?>