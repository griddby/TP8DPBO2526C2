<?php

class DB {
    // Atribut untuk menyimpan konfigurasi database
    public string $db_host = "";
    public string $db_user = "";
    public string $db_pass = "";
    public string $db_name = "";

    // Atribut untuk menyimpan koneksi dan hasil query
    public mysqli|false|null $db_link = null;
    public mysqli_result|bool|null $result = null;

    // Constructor untuk menerima konfigurasi database
    function __construct(string $db_host, string $db_user, string $db_pass, string $db_name) {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    // Membuka koneksi ke database
    function open() {
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if (!$this->db_link) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }
    }

    // Menjalankan query ke database
    function execute(string $query) {
        $this->result = mysqli_query($this->db_link, $query);
        return $this->result;
    }

    // Mengambil data dari hasil query
    function getResult() {
        if ($this->result instanceof mysqli_result) {
            return mysqli_fetch_array($this->result);
        }

        return null;
    }

    // Menutup koneksi database
    function close() {
        if ($this->db_link instanceof mysqli) {
            mysqli_close($this->db_link);
            $this->db_link = null;
        }
    }
}

?>
