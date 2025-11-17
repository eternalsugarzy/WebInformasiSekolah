<?php
require_once 'Database.php';

class BeritaModel extends Database {

    // Mengambil berita terbaru dengan batas (Code lama)
    public function getBeritaTerbaru($limit) {
        $limit = intval($limit);
        $sql = "SELECT * FROM berita_artikel ORDER BY tanggal_publikasi DESC LIMIT $limit";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // [BARU] Mengambil satu berita berdasarkan ID
    public function getBeritaById($id) {
        $id = intval($id); // Pastikan ID adalah angka untuk keamanan
        $sql = "SELECT * FROM berita_artikel WHERE id_berita = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // [TAMBAHAN BARU] Ambil semua berita
    public function getAllBerita() {
        $sql = "SELECT * FROM berita_artikel ORDER BY tanggal_publikasi DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}
?>