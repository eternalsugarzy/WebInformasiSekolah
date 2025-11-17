<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/GaleriModel.php'; 

class GaleriController {

    public function index() {
        // 1. Minta data ke Model
        $galeriModel = new GaleriModel();
        // Mengambil semua data album
        $data_album = $galeriModel->getAllAlbums(); 
        
        // 2. Siapkan Judul Halaman
        $title = "Galeri Media Sekolah - SMA Maju Jaya"; // Sesuaikan jika ada variabel $title di header.php

        // 3. Panggil View dengan menyertakan template header dan footer
        // Asumsi folder views/template ada di root/views/template
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/galeri.php'; // View utama galeri
        
    }
}
?>