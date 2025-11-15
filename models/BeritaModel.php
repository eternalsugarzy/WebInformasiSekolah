<?php
require_once 'Database.php';

class BeritaModel extends Database {

    // Mengambil berita terbaru dengan batas
    public function getBeritaTerbaru($limit) {
        $limit = intval($limit); // Keamanan
        $sql = "SELECT * FROM berita_artikel ORDER BY tanggal_publikasi DESC LIMIT $limit";
        
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
}
?>