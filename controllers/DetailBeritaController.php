<?php
require_once __DIR__ . '/../models/BeritaModel.php';

class DetailBeritaController {

    public function index() {
        // 1. Cek apakah ada parameter 'id' di URL
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            // Jika tidak ada ID, kembalikan ke halaman utama
            header("Location: index.php");
            exit;
        }

        $id = $_GET['id'];

        // 2. Minta data ke Model
        $beritaModel = new BeritaModel();
        $berita = $beritaModel->getBeritaById($id);

        // Jika berita tidak ditemukan di database
        if (!$berita) {
            echo "Berita tidak ditemukan.";
            exit;
        }

        // 3. Siapkan Judul Halaman dinamis
        $title = $berita['judul'] . " - SMA Maju Jaya";

        // 4. Panggil View
        require_once 'views/template/header.php';
        require_once 'views/detail_berita.php'; // Kita akan buat ini di langkah 3
        
    }
}
?>