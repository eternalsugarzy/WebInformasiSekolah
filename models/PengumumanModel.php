<?php
// Mewarisi dari kelas Database agar bisa menggunakan fungsi $this->query()
require_once 'Database.php'; 

class PengumumanModel extends Database {

    /**
     * Mengambil semua pengumuman yang berstatus 'Aktif', diurutkan berdasarkan tanggal penting terbaru.
     * @return array Data pengumuman atau array kosong jika tidak ada.
     */
    public function getAllActivePengumuman() {
        // Query hanya mengambil pengumuman yang aktif
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
}
?>