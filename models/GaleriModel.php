<?php
require_once 'Database.php';

class GaleriModel extends Database {

    // 1. Ambil Semua Album (Untuk List Admin)
    // Kita update query-nya agar menghitung jumlah foto dan mengambil 1 foto sebagai cover
    public function getAllAlbums() {
        // Subquery untuk mengambil 1 foto sebagai cover & hitung jumlah
        $sql = "SELECT g.*, 
                (SELECT file_foto FROM galeri_fotos WHERE id_album = g.id_album LIMIT 1) as cover_foto,
                (SELECT COUNT(*) FROM galeri_fotos WHERE id_album = g.id_album) as jumlah_foto
                FROM galeri_media g 
                ORDER BY g.id_album DESC";
        
        $query = $this->query($sql);
        $data_album = [];
        
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_album[] = $row;
            }
        }
        return $data_album;
    }

    // Alias agar controller yang lama tetap jalan
    public function getAllGaleri() {
        return $this->getAllAlbums();
    }

    // 2. Ambil Detail Album (Judul & Deskripsi)
    public function getAlbumById($id_album) {
        $id = intval($id_album);
        $sql = "SELECT * FROM galeri_media WHERE id_album = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }
    // Alias
    public function getGaleriById($id) {
        return $this->getAlbumById($id);
    }

    // 3. [BARU] Ambil Daftar Foto milik Album tertentu
    public function getFotosByAlbumId($id_album) {
        $id = intval($id_album);
        $sql = "SELECT * FROM galeri_fotos WHERE id_album = $id";
        $query = $this->query($sql);
        $hasil = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $hasil[] = $row;
            }
        }
        return $hasil;
    }

    // 4. [BARU] Simpan Album Baru (Hanya Judul & Deskripsi)
    // Mengembalikan ID Album yang baru dibuat agar bisa dipakai upload foto
    public function createAlbum($judul, $deskripsi, $tgl) {
        $judul = mysqli_real_escape_string($this->koneksi, $judul);
        $deskripsi = mysqli_real_escape_string($this->koneksi, $deskripsi);
        
        $sql = "INSERT INTO galeri_media (judul_album, deskripsi, tanggal_event, tipe_media) 
                VALUES ('$judul', '$deskripsi', '$tgl', 'Foto')";
        
        if ($this->query($sql)) {
            return mysqli_insert_id($this->koneksi); // Return ID Album Baru
        }
        return false;
    }

    // 5. [BARU] Simpan File Foto ke tabel galeri_fotos
    public function insertFoto($id_album, $filename) {
        $id_album = intval($id_album);
        $sql = "INSERT INTO galeri_fotos (id_album, file_foto) VALUES ('$id_album', '$filename')";
        return $this->query($sql);
    }

    // 6. Update Data Album (Hanya Teks)
    public function updateGaleri($id, $judul, $deskripsi, $tgl, $tipe, $file = null) {
        // Note: Parameter $file tidak lagi dipakai di sini untuk update text
        // Foto ditangani terpisah lewat insertFoto / hapusFoto
        
        $judul = mysqli_real_escape_string($this->koneksi, $judul);
        $deskripsi = mysqli_real_escape_string($this->koneksi, $deskripsi);

        $sql = "UPDATE galeri_media SET 
                judul_album = '$judul', 
                deskripsi = '$deskripsi', 
                tanggal_event = '$tgl', 
                tipe_media = '$tipe'
                WHERE id_album = $id";
        
        return $this->query($sql);
    }

    // 7. [BARU] Hapus Satu Foto Spesifik
    public function deleteFotoById($id_foto) {
        $id_foto = intval($id_foto);
        
        // Ambil nama file dulu buat direturn (agar controller bisa hapus fisik file)
        $q = $this->query("SELECT file_foto FROM galeri_fotos WHERE id_foto = $id_foto");
        $data = mysqli_fetch_assoc($q);
        
        // Hapus dari DB
        $this->query("DELETE FROM galeri_fotos WHERE id_foto = $id_foto");
        
        return $data['file_foto'] ?? null;
    }

    // 8. Hapus Album (Dan otomatis semua fotonya di DB jika pakai cascade, tapi kita perlu hapus fisik)
    public function hapusGaleri($id) {
        $id = intval($id);
        // Data foto di tabel galeri_fotos akan kita hapus manual di controller sebelum ini
        // atau biarkan terhapus jika tabel database disetting ON DELETE CASCADE
        $sql = "DELETE FROM galeri_media WHERE id_album = $id";
        return $this->query($sql);
    }
}
?>