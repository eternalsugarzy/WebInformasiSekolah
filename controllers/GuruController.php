<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/GuruModel.php'; 

class GuruController {

   public function index() {
        $guruModel = new GuruModel();
        
        // 1. Ambil keyword pencarian dari URL (GET request)
        $keyword = isset($_GET['cari']) ? trim($_GET['cari']) : null;
        
        // 2. Minta data ke Model, sertakan keyword
        $data_guru = $guruModel->getAllGuruStaf($keyword); 
        
        // Variabel untuk View
        $title = "Daftar Guru dan Staf - SMA Frater Don Bosco Bjm"; 
        
        // Kirim keyword kembali ke View agar form pencarian tetap terisi
        $current_keyword = $keyword;

        // 3. Panggil View
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/guru.php'; 
       
    }
}
?>