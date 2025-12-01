<?php
require_once __DIR__ . '/../models/GuruModel.php'; 

class GuruController {

    public function index() {
        $guruModel = new GuruModel();
        
        // 1. Ambil keyword pencarian dari URL (GET request)
        $keyword = isset($_GET['cari']) ? trim($_GET['cari']) : null;
        
        // 2. Jika ada keyword, panggil fungsi pencarian (filter), jika tidak ada, panggil daftar lengkap.
        if ($keyword) {
            // Asumsi: Model memiliki fungsi untuk mencari dengan keyword (akan kita buat selanjutnya)
            $data_guru = $guruModel->getGuruBySearch($keyword); 
        } else {
            // Ambil daftar lengkap guru (yang diurutkan berdasarkan jabatan)
            $data_guru = $guruModel->getAllGuruList(); 
        }
        
        // 3. Kirim keyword kembali ke View agar form pencarian tetap terisi
        $current_keyword = $keyword;
        
        // 4. Set Judul dan Panggil View
        $title = "Daftar Guru dan Staf - SMA Frater Don Bosco Bjm"; 

        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/guru.php'; // View Tabel Direktori
        require_once __DIR__ . '/../views/template/footer.php';
    }
}
?>