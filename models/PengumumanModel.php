<?php
require_once 'Database.php';

class PengumumanModel extends Database {

    // (Fungsi getPengumumanTerbaru yang lama biarkan saja)
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

    // [BARU] Ambil SEMUA pengumuman (untuk Admin)
    public function getAllPengumuman() {
        $sql = "SELECT * FROM pengumuman ORDER BY tanggal_penting DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // [BARU] Hapus Pengumuman
    public function hapusPengumuman($id) {
        $id = intval($id);
        $sql = "DELETE FROM pengumuman WHERE id_pengumuman = $id";
        return $this->query($sql);
    }

    // [BARU] Hitung Total Pengumuman Aktif
    public function countPengumumanAktif() {
        $sql = "SELECT COUNT(*) as total FROM pengumuman WHERE status = 'Aktif'";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    // [BARU] Ambil 1 Pengumuman by ID
    public function getPengumumanById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM pengumuman WHERE id_pengumuman = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // [BARU] Update Pengumuman
    public function updatePengumuman($id, $judul, $isi, $tanggal, $status) {
        $sql = "UPDATE pengumuman SET 
                judul = '$judul', 
                isi_pengumuman = '$isi', 
                tanggal_penting = '$tanggal', 
                status = '$status' 
                WHERE id_pengumuman = $id";
        return $this->query($sql);
    }
}
?>