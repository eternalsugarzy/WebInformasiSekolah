<?php
// Pastikan jalur ke model benar
require_once __DIR__ . '/../models/GaleriModel.php';

class GaleriController {

    // --- HALAMAN DAFTAR ALBUM ---
    public function index() {
        $model = new GaleriModel();
        
        // ===========================================
        // 🎯 LOGIKA PAGINATION 🎯
        // ===========================================
        $limit = 6; // Maksimal 6 album per halaman

        // 1. Tentukan halaman saat ini (Current Page)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        // 2. Hitung total album dan total halaman
        $total_albums = $model->countAllAlbums(); // Menggunakan fungsi baru
        $total_pages = ceil($total_albums / $limit);
        
        // 3. Validasi halaman dan hitung OFFSET
        if ($page > $total_pages && $total_pages > 0) {
            $page = $total_pages;
        }
        $start = ($page - 1) * $limit; 
        
        // 4. Ambil album dengan LIMIT dan OFFSET
        $data_album = $model->getAllAlbums($limit, $start); // Menggunakan fungsi yang sudah diupdate

        $title = "Galeri Kegiatan - SMA Maju Jaya";

        // 5. Panggil View Frontend
        require_once 'views/template/header.php';
        // View Anda (galeri.php) sekarang memiliki akses ke $data_album, $page, dan $total_pages
        require_once 'views/galeri.php'; 
        require_once 'views/template/footer.php';
    }

    // --- HALAMAN DETAIL (Isi Foto-foto dalam Album) ---
    public function detail($id) {
        $model = new GaleriModel();
        
        // 1. Ambil Info Album (Judul, Deskripsi, Tanggal)
        // Data ini akan disimpan di variabel $album
        $album = $model->getAlbumById($id); 
        
        // 2. Ambil Semua Foto di dalam album tersebut
        $fotos = $model->getFotosByAlbumId($id); 

        // Validasi: Jika album tidak ditemukan
        if (!$album) {
            echo "<h3>Album tidak ditemukan atau telah dihapus.</h3>";
            exit;
        }

        $title = $album['judul_album'] . " - Galeri Sekolah";

        // 3. Panggil View Detail
        require_once 'views/template/header.php';
        
        // PERHATIKAN: Nama file harus sesuai dengan file yang ada di folder views Anda
        // Berdasarkan error Anda, nama filenya adalah 'detail_galeri.php'
        if (file_exists('views/detail_galeri.php')) {
            require_once 'views/detail_galeri.php'; 
        } elseif (file_exists('views/galeri_detail.php')) {
            require_once 'views/galeri_detail.php';
        } else {
            die("Error: File view detail galeri tidak ditemukan.");
        }

        
    }
}
?>