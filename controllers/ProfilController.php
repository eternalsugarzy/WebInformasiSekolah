<?php
require_once __DIR__ . '/../models/GuruModel.php';
require_once __DIR__ . '/../models/IdentitasModel.php'; // [TAMBAH INI]

class ProfilController {

    public function index() {
        // 1. Ambil Data Guru (Tetap)
        $guruModel = new GuruModel();
        $data_guru = $guruModel->getAllGuru();

        // 2. [BARU] Ambil Data Identitas (Sejarah, Visi, Misi)
        $identitasModel = new IdentitasModel();
        $profil = $identitasModel->getIdentitas();

        $title = "Profil Sekolah - SMA Frater Don Bosco Banjarmasin";

        require_once 'views/template/header.php';
        require_once 'views/profil.php';
    
        require_once 'views/template/footer.php';
    }
}
?>