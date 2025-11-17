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

    // [BARU] Hitung Total Berita
    public function countBerita() {
        $sql = "SELECT COUNT(*) as total FROM berita_artikel";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    // [BARU] Fungsi Update Berita
    public function updateBerita($id, $judul, $konten, $kategori, $gambar = null) {
        // Jika ada gambar baru yang diupload
        if ($gambar != null) {
            $sql = "UPDATE berita_artikel SET 
                    judul = '$judul', 
                    konten_lengkap = '$konten', 
                    kategori = '$kategori', 
                    gambar_utama = '$gambar' 
                    WHERE id_berita = $id";
        } else {
            // Jika TIDAK ada gambar baru (gambar lama tetap dipakai)
            $sql = "UPDATE berita_artikel SET 
                    judul = '$judul', 
                    konten_lengkap = '$konten', 
                    kategori = '$kategori' 
                    WHERE id_berita = $id";
        }
        return $this->query($sql);
    }
}
?>