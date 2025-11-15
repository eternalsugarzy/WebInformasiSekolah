<?php
require_once 'Database.php';

class PengumumanModel extends Database {

    // Mengambil pengumuman terbaru dengan batas
    public function getPengumumanTerbaru($limit) {
        $limit = intval($limit); // Keamanan
        $sql = "SELECT * FROM pengumuman WHERE status = 'Aktif' ORDER BY tanggal_penting DESC LIMIT $limit";
        
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}
?>