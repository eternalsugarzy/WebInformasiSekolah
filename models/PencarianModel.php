<?php
require_once 'Database.php';

class PencarianModel extends Database {

    // 1. Cari Berita
    public function cariBerita($keyword) {
        $key = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT * FROM berita_artikel 
                WHERE judul LIKE '%$key%' OR konten_lengkap LIKE '%$key%' 
                ORDER BY tanggal_publikasi DESC LIMIT 5";
        return $this->fetchAll($sql);
    }

    // 2. Cari Pengumuman
    public function cariPengumuman($keyword) {
        $key = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT * FROM pengumuman 
                WHERE judul LIKE '%$key%' OR isi_pengumuman LIKE '%$key%' 
                ORDER BY tanggal_penting DESC LIMIT 5";
        return $this->fetchAll($sql);
    }

    // 3. Cari Guru
    public function cariGuru($keyword) {
        $key = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT * FROM guru_staf 
                WHERE nama_lengkap LIKE '%$key%' OR jabatan LIKE '%$key%' OR bidang_studi LIKE '%$key%'
                ORDER BY nama_lengkap ASC LIMIT 10";
        return $this->fetchAll($sql);
    }

    // 4. Cari Galeri
    public function cariGaleri($keyword) {
        $key = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT g.*, 
                (SELECT file_foto FROM galeri_fotos WHERE id_album = g.id_album LIMIT 1) as cover_foto
                FROM galeri_media g
                WHERE judul_album LIKE '%$key%' OR deskripsi LIKE '%$key%'
                ORDER BY tanggal_event DESC LIMIT 5";
        return $this->fetchAll($sql);
    }

    // 5. Cari PPDB
    public function cariPPDB($keyword) {
        $key = mysqli_real_escape_string($this->koneksi, $keyword);
        $sql = "SELECT * FROM info_ppdb 
                WHERE jenis_informasi LIKE '%$key%' OR isi_detail LIKE '%$key%'";
        return $this->fetchAll($sql);
    }

    // Fungsi Bantuan untuk Fetch All
    private function fetchAll($sql) {
        $query = $this->query($sql);
        $hasil = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $hasil[] = $row;
            }
        }
        return $hasil;
    }
}
?>