<?php
require_once __DIR__ . '/../models/PencarianModel.php';

class PencarianController {

    public function index() {
        $keyword = isset($_GET['cari']) ? $_GET['cari'] : '';
        $hasil = [];

        if (!empty($keyword)) {
            $model = new PencarianModel();
            
            // Kumpulkan semua hasil pencarian dalam satu array besar
            $hasil['berita'] = $model->cariBerita($keyword);
            $hasil['pengumuman'] = $model->cariPengumuman($keyword);
            $hasil['guru'] = $model->cariGuru($keyword);
            $hasil['galeri'] = $model->cariGaleri($keyword);
            $hasil['ppdb'] = $model->cariPPDB($keyword);
        }

        $title = "Hasil Pencarian: " . htmlspecialchars($keyword);

        require_once 'views/template/header.php';
        require_once 'views/pencarian.php'; // Kita buat di langkah 3
        require_once 'views/template/footer.php';
    }
}
?>