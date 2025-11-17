<?php
// Asumsi 'Database.php' ada di folder models/ yang sama
require_once 'Database.php'; 

// Mewarisi dari kelas Database agar bisa menggunakan fungsi $this->query()
class GaleriModel extends Database {

    /**
     * Mengambil semua album dari database, diurutkan berdasarkan tanggal terbaru.
     * @return array Data album atau array kosong jika tidak ada.
     */
    public function getAllAlbums() {
        $sql = "SELECT id_album, judul_album, deskripsi, tanggal_event, file_path, tipe_media 
                  FROM galeri_media 
                  ORDER BY tanggal_event DESC";
        
        // Menggunakan fungsi query dari Database.php (yang menangani koneksi)
        $query = $this->query($sql);
        
        $data_album = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_album[] = $row;
            }
        }
        return $data_album;
    }
    
    // Anda bisa tambahkan fungsi lain seperti getAlbumById, dll.
}
?>