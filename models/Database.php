<?php
// Menggunakan file koneksi lama Anda
require_once __DIR__ . '/../Koneksi Database/koneksi.php';

class Database {
    
    protected $koneksi;

    public function escape($string) {
        // Cek jika koneksi adalah objek yang valid sebelum memanggil mysqli_real_escape_string
        if (is_object($this->koneksi)) {
            return mysqli_real_escape_string($this->koneksi, $string);
        }
        // Jika koneksi tidak ada (misalnya, gagal saat startup), kembalikan string asli
        return $string;
    }

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