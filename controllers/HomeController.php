<?php
// Panggil semua model yang dibutuhkan
require_once __DIR__ . '/../models/PengumumanModel.php';
require_once __DIR__ . '/../models/BeritaModel.php';
require_once __DIR__ . '/../models/IdentitasModel.php'; // [BARU]

class HomeController {

    public function index() {
        // 1. Ambil Data Pengumuman (Misal 3 terbaru)
        $pengumumanModel = new PengumumanModel();
        $data_pengumuman = $pengumumanModel->getPengumumanTerbaru(3);

        // 2. Ambil Data Berita (Misal 3 terbaru)
        $beritaModel = new BeritaModel();
        $data_berita = $beritaModel->getBeritaTerbaru(3);

        // 3. [BARU] Ambil Data Identitas & Poster Slider
        $identitasModel = new IdentitasModel();
        $data_identitas = $identitasModel->getIdentitas(); // Untuk sambutan kepsek
        $data_posters = $identitasModel->getAllPosters(); // Untuk slider gambar

        $title = "Beranda - SMA Frater Don Bosco Banjarmasin"; // Atau ambil nama sekolah dari $data_identitas['nama_sekolah']

        // 4. Panggil View
        require_once 'views/template/header.php';
        require_once 'views/home.php';
        require_once 'views/contact.php';
        require_once 'views/template/footer.php';
    }
}
?>