<?php
require_once __DIR__ . '/../models/BeritaModel.php';

class BeritaController {

    public function index() {
        // 1. Minta data semua berita ke Model
        $beritaModel = new BeritaModel();
        $data_berita = $beritaModel->getAllBerita();
        
        // 2. Set Judul Halaman
        $title = "Semua Berita - SMA Maju Jaya";
        
        // 3. Panggil View
        require_once 'views/template/header.php';
        require_once 'views/berita.php'; // Kita buat ini di langkah 3
        require_once 'views/template/footer.php';
    }
}
?>