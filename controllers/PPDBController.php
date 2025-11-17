<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/PPDBModel.php'; 

class PPDBController {

    public function index() {
        // 1. Minta data ke Model
        $ppdbModel = new PPDBModel();
        // Variabel yang akan disuntikkan ke View
        $data_ppdb = $ppdbModel->getAllPPDBInfo(); 
        
        // 2. Siapkan Judul Halaman (menggunakan nama sekolah SMA Frater Don Bosco Bjm)
        $title = "Penerimaan Peserta Didik Baru - SMA Frater Don Bosco Bjm"; 

        // 3. Panggil View dengan menyertakan template header dan footer
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/ppdb.php'; // View utama ppdb
      
    }
}
?>