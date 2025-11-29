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
        $id = intval($id);
        $judul = mysqli_real_escape_string($this->koneksi, $judul);
        $konten = mysqli_real_escape_string($this->koneksi, $konten);
        $kategori = mysqli_real_escape_string($this->koneksi, $kategori);

        // Jika ada gambar baru yang diupload
        if ($gambar != null) {
            $gambar = mysqli_real_escape_string($this->koneksi, $gambar);
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

    // [BARU] Ambil Berita Berdasarkan Rentang Tanggal (Untuk Laporan)
    public function getBeritaByDate($tgl_awal, $tgl_akhir) {
        $tgl_awal = mysqli_real_escape_string($this->koneksi, $tgl_awal);
        $tgl_akhir = mysqli_real_escape_string($this->koneksi, $tgl_akhir);
        
        // Tambahkan jam agar rentang akurat (00:00:00 s/d 23:59:59)
        $sql = "SELECT * FROM berita_artikel 
                WHERE tanggal_publikasi BETWEEN '$tgl_awal 00:00:00' AND '$tgl_akhir 23:59:59' 
                ORDER BY tanggal_publikasi DESC";
                
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ================= SEARCH =================
    public function searchBerita($keyword) {
        $keyword = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT * FROM berita_artikel 
                WHERE judul LIKE '%$keyword%' 
                OR konten_lengkap LIKE '%$keyword%' 
                ORDER BY tanggal_publikasi DESC";

        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ================= KATEGORI =================
    public function getBeritaByKategori($kategori) {
        $kategori = mysqli_real_escape_string($this->koneksi, $kategori);
        $sql = "SELECT * FROM berita_artikel 
                WHERE kategori = '$kategori' 
                ORDER BY tanggal_publikasi DESC";

        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // ================= ARCHIVE =================
    public function getBeritaByYear($tahun) {
        $tahun = intval($tahun);
        $sql = "SELECT * FROM berita_artikel 
                WHERE YEAR(tanggal_publikasi) = '$tahun' 
                ORDER BY tanggal_publikasi DESC";

        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Pagination: Ambil berita per halaman
public function getBeritaByPage($limit, $offset) {
    $limit = intval($limit);
    $offset = intval($offset);

    $sql = "SELECT * FROM berita_artikel 
            ORDER BY tanggal_publikasi DESC 
            LIMIT $limit OFFSET $offset";

    $query = $this->query($sql);
    $hasil = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $hasil[] = $row;
    }

    return $hasil;
}


} // end class

?>
