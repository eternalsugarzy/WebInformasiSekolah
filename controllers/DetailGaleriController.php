<?php
require_once __DIR__ . '/../models/GaleriModel.php'; 

class DetailGaleriController {

    public function index() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: galeri.php");
            exit;
        }

        $id = intval($_GET['id']);
        $galeriModel = new GaleriModel();
        
        // 1. Ambil data header album utama
        $media_item = $galeriModel->getAlbumById($id); 

        if (!$media_item) {
            $title = "Media Tidak Ditemukan";
            require_once __DIR__ . '/../views/template/header.php';
            echo "<div class='container text-center' style='padding: 50px;'><h3>Item Media/Album Tidak Ditemukan.</h3><a href='galeri.php'>Kembali ke Galeri</a></div>";
            return;
        }

        // 2. BUAT DAFTAR FOTO (SIMULASI DATA DARI TABEL BARU/FOLDER)
        $data_photos = [];
        // Dalam proyek nyata, Anda akan menggunakan Model untuk mengambil data dari tabel media_items WHERE album_id = $id
        // Contoh data dummy untuk demonstrasi grid 8 foto:
        for ($i = 1; $i <= 8; $i++) {
            $data_photos[] = [
                'path' => "admin/uploads/galeri/album_{$id}_foto_{$i}.jpg", // Ganti path ini dengan path foto yang sebenarnya
                'caption' => "Foto {$i}"
            ];
        }

        // 3. Set Judul dan Load View
        $title = "Detail Album: " . $media_item['judul_album'] . " - SMA Frater Don Bosco Bjm";

        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/detail_galeri.php'; 
        
    }
}
?>