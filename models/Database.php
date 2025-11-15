<?php
// Menggunakan file koneksi lama Anda
require_once __DIR__ . '/../Koneksi Database/koneksi.php';

class Database {
    
    protected $koneksi;

    public function __construct() {
        // Mengambil variabel $koneksi dari file koneksi.php
        global $koneksi; 
        
        if ($koneksi === null) {
            die("Error: Koneksi database gagal.");
        }
        $this->koneksi = $koneksi;
    }

    // Fungsi untuk menjalankan query (SELECT)
    public function query($sql) {
        return mysqli_query($this->koneksi, $sql);
    }
}
?>