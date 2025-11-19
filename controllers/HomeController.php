<?php
// Memanggil Model yang diperlukan
require_once __DIR__ . '/../models/PengumumanModel.php';
require_once __DIR__ . '/../models/BeritaModel.php';

class HomeController {

    public function index() {
        // 1. Minta data ke Model
        $pengumumanModel = new PengumumanModel();
        $beritaModel = new BeritaModel();
        
       $data_pengumuman = $pengumumanModel->getPengumumanTerbaru(2);
        $data_berita = $beritaModel->getBeritaTerbaru(4);
        
        // 2. Tentukan judul halaman
        $title = "Beranda - SMA Frater Don Bosco";
        
        // 3. Panggil View (Template Anda) dan kirimkan data
        // Ini adalah tempat template 400 baris Anda dipanggil
        require_once 'views/template/header.php';
        require_once 'views/home.php';
        require_once 'views/template/footer.php';
    }
}
?>