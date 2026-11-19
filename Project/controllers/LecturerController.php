<?php

// Memanggil file yang dibutuhkan oleh Controller
include_once(__DIR__ . "/../models/DB.php");
include_once(__DIR__ . "/../models/Lecturer.php");
include_once(__DIR__ . "/../views/LecturerView.php");

class LecturerController {
    // Properti untuk menyimpan objek Lecturer
    private $lecturer;

    // Constructor untuk membuat objek Lecturer
    function __construct() {
        $this->lecturer = new Lecturer("localhost", "root", "", "tp_mvc26");
    }

    // Menampilkan seluruh data dosen
    public function index() {
        // Membuka koneksi database
        $this->lecturer->open();

        // Mengambil seluruh data dosen dari Model
        $this->lecturer->getLecturer();

        // Menyiapkan array untuk menyimpan data dosen
        $data = array();

        // Mengambil data satu per satu dan menyimpannya ke dalam array
        while ($row = $this->lecturer->getResult()) {
            array_push($data, $row);
        }

        // Menutup koneksi database
        $this->lecturer->close();

        // Meneruskan data ke View untuk ditampilkan
        $view = new LecturerView();
        $view->render($data);
    }

    // Menambahkan data dosen baru
    function add() {
        // Membuka koneksi database
        $this->lecturer->open();

        // Mengambil data dosen dari form
        $name = $_POST['name'];
        $nidn = $_POST['nidn'];
        $phone = $_POST['phone'];
        $join_date = $_POST['join_date'];

        // Memanggil fungsi addLecturer pada Model untuk menyimpan data
        $this->lecturer->addLecturer($name, $nidn, $phone, $join_date);

        // Menutup koneksi database
        $this->lecturer->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=lecturer");
        exit;
    }

    // Mengubah data dosen berdasarkan ID
    function edit() {
        // Membuka koneksi database
        $this->lecturer->open();

        // Mengambil ID dan data dosen dari form
        $id_lecturer = $_POST['id_lecturer'];
        $name = $_POST['name'];
        $nidn = $_POST['nidn'];
        $phone = $_POST['phone'];
        $join_date = $_POST['join_date'];

        // Memanggil fungsi updateLecturer pada Model untuk memperbarui data
        $this->lecturer->updateLecturer($name, $nidn, $phone, $join_date, $id_lecturer);

        // Menutup koneksi database
        $this->lecturer->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=lecturer");
        exit;
    }

    // Menghapus data dosen berdasarkan ID
    function delete() {
        // Membuka koneksi database
        $this->lecturer->open();

        // Mengambil ID dosen dari form
        $id_lecturer = $_POST['id_lecturer'];

        // Memanggil fungsi deleteLecturer pada Model untuk menghapus data
        $this->lecturer->deleteLecturer($id_lecturer);

        // Menutup koneksi database
        $this->lecturer->close();

        // Mengarahkan kembali ke halaman utama
        header("Location: index.php?controller=lecturer");
        exit;
    }
}

?>