<?php
require_once __DIR__ . '/../models/GaleriModel.php'; 

class DetailGaleriController {

    public function index() {
        // 1. Cek apakah ada parameter 'id' di URL
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: galeri.php"); // Kembali ke halaman daftar galeri
            exit;
        }

        $id = intval($_GET['id']);

        // 2. Minta data ke Model
        $galeriModel = new GaleriModel();
        // Mengambil data item media tunggal (karena struktur tabel saat ini)
        $media_item = $galeriModel->getAlbumById($id); 

        // Jika item tidak ditemukan
        if (!$media_item) {
            $title = "Media Tidak Ditemukan";
            require_once __DIR__ . '/../views/template/header.php';
            echo "<div class='container text-center' style='padding: 50px;'><h3>Item Media Tidak Ditemukan.</h3><a href='galeri.php'>Kembali ke Galeri</a></div>";
          
            return;
        }

        // 3. Siapkan Judul Halaman dinamis
        $title = "Detail Media: " . $media_item['judul_album'] . " - SMA Frater Don Bosco Bjm";

        // 4. Panggil View
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/detail_galeri.php'; 
      
    }
}
?>