<?php
require_once 'Database.php';

class GaleriModel extends Database {

    // Ambil Semua Galeri
    public function getAllGaleri() {
        $sql = "SELECT * FROM galeri_media ORDER BY id_album DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Ambil 1 Data (Untuk hapus file)
    public function getGaleriById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM galeri_media WHERE id_album = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // Hapus Data
    public function hapusGaleri($id) {
        $id = intval($id);
        $sql = "DELETE FROM galeri_media WHERE id_album = $id";
        return $this->query($sql);
    }

    // [BARU] Update Data Galeri
    public function updateGaleri($id, $judul, $deskripsi, $tgl, $tipe, $file = null) {
        if ($file != null) {
            // Jika ada file baru
            $sql = "UPDATE galeri_media SET 
                    judul_album = '$judul', 
                    deskripsi = '$deskripsi', 
                    tanggal_event = '$tgl', 
                    tipe_media = '$tipe',
                    file_path = '$file' 
                    WHERE id_album = $id";
        } else {
            // Jika TIDAK ada file baru
            $sql = "UPDATE galeri_media SET 
                    judul_album = '$judul', 
                    deskripsi = '$deskripsi', 
                    tanggal_event = '$tgl', 
                    tipe_media = '$tipe'
                    WHERE id_album = $id";
        }
        return $this->query($sql);
    }
}
?>