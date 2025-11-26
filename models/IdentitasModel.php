<?php
require_once 'Database.php';

class IdentitasModel extends Database {

    // Ambil Data
    public function getIdentitas() {
        $sql = "SELECT * FROM identitas_sekolah WHERE id_identitas = 1";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // Update Data (Hanya kolom yang diminta)
    public function updateIdentitas($sejarah, $visi, $misi, $fasilitas, $poster = null) {
        if ($poster != null) {
            $sql = "UPDATE identitas_sekolah SET 
                    sejarah = '$sejarah', 
                    visi = '$visi', 
                    misi = '$misi', 
                    fasilitas = '$fasilitas',
                    file_poster = '$poster' 
                    WHERE id_identitas = 1";
        } else {
            $sql = "UPDATE identitas_sekolah SET 
                    sejarah = '$sejarah', 
                    visi = '$visi', 
                    misi = '$misi', 
                    fasilitas = '$fasilitas'
                    WHERE id_identitas = 1";
        }
        return $this->query($sql);
    }

    // --- FITUR POSTER SLIDER ---

    // 1. Ambil Semua Poster
    public function getAllPosters() {
        $sql = "SELECT * FROM posters ORDER BY id_poster DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // 2. Tambah Poster Baru
    public function insertPoster($filename) {
        $sql = "INSERT INTO posters (file_poster) VALUES ('$filename')";
        return $this->query($sql);
    }

    // 3. Ambil 1 Poster (Untuk Hapus File)
    public function getPosterById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM posters WHERE id_poster = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // 4. Hapus Poster dari DB
    public function deletePoster($id) {
        $id = intval($id);
        return $this->query("DELETE FROM posters WHERE id_poster = $id");
    }
}
?>