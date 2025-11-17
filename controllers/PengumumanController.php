<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/PengumumanModel.php'; 

class PengumumanController {

    public function index() {
        // 1. Minta data ke Model
        $pengumumanModel = new PengumumanModel();
        // Variabel yang akan disuntikkan ke View
        $data_pengumuman = $pengumumanModel->getAllActivePengumuman(); 
        
        // 2. Siapkan Judul Halaman
        $title = "Pengumuman Sekolah - SMA Maju Jaya"; 

        // 3. Panggil View dengan menyertakan template header dan footer
        // Menggunakan BASE_PATH atau jalur relatif yang benar dari Controller
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/pengumuman.php'; // View utama pengumuman
        
    }
}
?>