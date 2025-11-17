<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/ProfilModel.php'; 

class ProfilController {

    public function index() {
        // 1. Minta data ke Model
        $profilModel = new ProfilModel();
        // Variabel yang akan disuntikkan ke View
        $data_profil = $profilModel->getProfilData(); 
        
        // 2. Siapkan Judul Halaman
        $title = "Profil Sekolah & Visi Misi - SMA Maju Jaya"; 

        // 3. Panggil View dengan menyertakan template header dan footer
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/profil.php'; // View utama profil
       
    }
}
?>