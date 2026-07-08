<?php
// Panggil semua model yang dibutuhkan untuk dashboard
require_once __DIR__ . '/../models/BeritaModel.php';
require_once __DIR__ . '/../models/PengumumanModel.php';
require_once __DIR__ . '/../models/GuruModel.php';
require_once __DIR__ . '/../models/PengunjungModel.php';
require_once __DIR__ . '/../models/PPDBModel.php';

class DashboardController {

    public function index() {
        // 1. Cek Sesi Login
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }

        // 2. Siapkan Model
        $beritaModel = new BeritaModel();
        $pengumumanModel = new PengumumanModel();
        $guruModel = new GuruModel();
        $pengunjungModel = new PengunjungModel();
        $ppdbModel = new PPDBModel();

        // 3. Ambil Data Real dari Database
        $total_berita = $beritaModel->countBerita();
        $total_pengumuman = $pengumumanModel->countPengumumanAktif();
        $total_guru = $guruModel->countGuru();

        // 3b. [BARU] Statistik Pengunjung
        $total_pengunjung = $pengunjungModel->getTotalPengunjung();
        $pengunjung_hari_ini = $pengunjungModel->getPengunjungHariIni();
        $tren_pengunjung = $pengunjungModel->getTrenPengunjung(14); // 14 hari terakhir

        // 3c. [BARU] Tren Pendaftar PPDB per Tahun
        $tren_pendaftar = $ppdbModel->getTrenPendaftarPerTahun();

        // 3d. [BARU] Statistik Kelulusan (semua tahun)
        $statistik_kelulusan = $ppdbModel->getStatistikKelulusan();

        // 4. Siapkan Data untuk View
        $title = "Dashboard Admin - SMA Frater Don Bosco";
        $nama_admin = $_SESSION['admin_nama'];

        // 5. Panggil View Dashboard
        require_once '../views/admin/dashboard.php';
    }
}
?>