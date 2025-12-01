<?php
require_once __DIR__ . '/../models/GuruModel.php';
require_once __DIR__ . '/../models/IdentitasModel.php'; // [TAMBAH INI]

class ProfilController {

    public function index() {
    // Guru Model
    $guruModel = new GuruModel();
    $data_guru = $guruModel->getAllGuruList();

    // Ambil Kepala Sekolah dari guru_staf
    $kepsek = $guruModel->getKepalaSekolah();

    // Identitas Sekolah
    $identitasModel = new IdentitasModel();
    $profil = $identitasModel->getIdentitas();

    $title = "Profil Sekolah - SMA Frater Don Bosco Banjarmasin";

    require_once 'views/template/header.php';
    require_once 'views/profil.php';
    require_once 'views/template/footer.php';
}

}
?>