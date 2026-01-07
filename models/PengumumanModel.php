<?php
require_once 'Database.php';

class PengumumanModel extends Database {

    // --- FITUR FRONTEND (HOME) ---
    public function getAllActivePengumuman() { 
        $sql = "SELECT id_pengumuman, judul, isi_pengumuman, tanggal_penting 
                  FROM pengumuman 
                  WHERE status = 'Aktif'
                  ORDER BY tanggal_penting DESC, id_pengumuman DESC";
        
        $query = $this->query($sql);
        $data_pengumuman = [];

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_pengumuman[] = $row;
            }
        }
        
        return $data_pengumuman;
    }

    // 🔍 SEARCH PENGUMUMAN AKTIF
    public function searchActivePengumuman($keyword) {

    // sanitasi aman TANPA koneksi mysqli
    $keyword = trim($keyword);
    $keyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');

    $sql = "SELECT id_pengumuman, judul, isi_pengumuman, tanggal_penting
            FROM pengumuman
            WHERE status = 'Aktif'
            AND (
                judul LIKE '%$keyword%'
                OR isi_pengumuman LIKE '%$keyword%'
            )
            ORDER BY tanggal_penting DESC, id_pengumuman DESC";

    $query = $this->query($sql);

    $data_pengumuman = [];
    if ($query) {
        while ($row = mysqli_fetch_assoc($query)) {
            $data_pengumuman[] = $row;
        }
    }

    return $data_pengumuman;
}


    // 1. Ambil Pengumuman Terbaru
    public function getPengumumanTerbaru($limit) {
        $limit = intval($limit); 
        $sql = "SELECT * FROM pengumuman WHERE status = 'Aktif' ORDER BY tanggal_penting DESC LIMIT $limit";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // --- FITUR ADMIN (BACKEND) ---
    public function getAllPengumuman() {
        $sql = "SELECT * FROM pengumuman ORDER BY tanggal_penting DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    public function getPengumumanById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM pengumuman WHERE id_pengumuman = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    public function updatePengumuman($id, $judul, $isi, $tanggal, $status) {
        $sql = "UPDATE pengumuman SET 
                judul = '$judul', 
                isi_pengumuman = '$isi', 
                tanggal_penting = '$tanggal', 
                status = '$status' 
                WHERE id_pengumuman = $id";
        return $this->query($sql);
    }

    public function hapusPengumuman($id) {
        $id = intval($id);
        $sql = "DELETE FROM pengumuman WHERE id_pengumuman = $id";
        return $this->query($sql);
    }

    public function countPengumumanAktif() {
        $sql = "SELECT COUNT(*) as total FROM pengumuman WHERE status = 'Aktif'";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }
}
?>
