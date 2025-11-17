<?php
require_once 'Database.php';

class GaleriModel extends Database {

    public function getAllAlbums() {
        $sql = "SELECT id_album, judul_album, deskripsi, tanggal_event, file_path, tipe_media 
                  FROM galeri_media 
                  ORDER BY tanggal_event DESC";
        
        // Gunakan fungsi query dari kelas induk (Database)
        $query = $this->query($sql);
        
        // V A R I A B E L  K R U S I A L
        $data_album = []; // <-- BARIS PERBAIKAN: INISIALISASI array
        
        // Isi array dengan hasil dari database
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_album[] = $row;
            }
        }
        return $data_album; // Sekarang variabel ini pasti terdefinisi
    }
    // 1. Ambil Semua Galeri (Ini yang menyebabkan error sebelumnya)
    public function getAllGaleri() {
        $sql = "SELECT * FROM galeri_media ORDER BY id_album DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // 2. Ambil 1 Data Galeri by ID (Untuk Edit/Hapus)
    public function getGaleriById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM galeri_media WHERE id_album = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // 3. Update Data Galeri
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

    // 4. Hapus Data Galeri
    public function hapusGaleri($id) {
        $id = intval($id);
        $sql = "DELETE FROM galeri_media WHERE id_album = $id";
        return $this->query($sql);
    }
}


?>