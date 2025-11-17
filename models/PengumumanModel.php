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
        
        // V A R I A B E L  I N I  H A R U S  D I D E F I N I S I K A N
        $data_pengumuman = []; // <--- BARIS PERBAIKAN: INISIALISASI
        
        // Anda perlu menambahkan logika untuk mengisi array ini
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_pengumuman[] = $row;
            }
        }
        
        return $data_pengumuman; // Sekarang variabel ini sudah terdefinisi
    }
    // 1. Ambil Pengumuman Terbaru (Dipakai di HomeController)
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

    // 2. Ambil SEMUA pengumuman (Dipakai di AdminPengumumanController)
    public function getAllPengumuman() {
        $sql = "SELECT * FROM pengumuman ORDER BY tanggal_penting DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // 3. Ambil 1 Pengumuman by ID (Dipakai untuk Edit)
    public function getPengumumanById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM pengumuman WHERE id_pengumuman = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // 4. Update Pengumuman
    public function updatePengumuman($id, $judul, $isi, $tanggal, $status) {
        $sql = "UPDATE pengumuman SET 
                judul = '$judul', 
                isi_pengumuman = '$isi', 
                tanggal_penting = '$tanggal', 
                status = '$status' 
                WHERE id_pengumuman = $id";
        return $this->query($sql);
    }

    // 5. Hapus Pengumuman
    public function hapusPengumuman($id) {
        $id = intval($id);
        $sql = "DELETE FROM pengumuman WHERE id_pengumuman = $id";
        return $this->query($sql);
    }

    // 6. Hitung Total Pengumuman Aktif (Dipakai di Dashboard)
    public function countPengumumanAktif() {
        $sql = "SELECT COUNT(*) as total FROM pengumuman WHERE status = 'Aktif'";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }
}


?>