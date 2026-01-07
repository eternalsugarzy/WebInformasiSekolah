<?php
require_once __DIR__ . '/../models/PengumumanModel.php'; 

class PengumumanController {

    public function index() {

        $pengumumanModel = new PengumumanModel();

        // 🔍 Ambil keyword dari URL
        $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';

        // 🔁 Tentukan data berdasarkan keyword
        if (!empty($keyword)) {
            $data_pengumuman = $pengumumanModel->searchActivePengumuman($keyword);
        } else {
            $data_pengumuman = $pengumumanModel->getAllActivePengumuman();
        }

        // Judul halaman
        $title = "Pengumuman Sekolah - SMA Maju Jaya"; 

        // Load View
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/pengumuman.php';
        require_once 'views/template/footer.php';
    }
}
?>
