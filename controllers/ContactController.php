<?php
// Menggunakan __DIR__ untuk jalur absolut yang aman dari lokasi controller
require_once __DIR__ . '/../models/ContactModel.php'; 

class ContactController {

    public function index() {
        // 1. Minta data ke Model
        $contactModel = new ContactModel();
        // Variabel yang akan disuntikkan ke View
        $data_kontak = $contactModel->getContactInfo(); 
        
        // 2. Siapkan Judul Halaman
        $title = "Kontak Kami - SMA Frater Don Bosco Bjm"; 

        // 3. Panggil View dengan menyertakan template header dan footer
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/contact.php'; // View utama kontak
        
    }
    
    // FUNGSI TAMBAHAN: Untuk menangani pengiriman formulir (jika Anda mengimplementasikannya)
    // public function submit() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Logika pemrosesan POST data
    //     }
    // }
}
?>