<?php
class AdminLaporanController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    // Halaman Filter Laporan Guru
    public function pageGuru() {
        $title = "Laporan Data Guru";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_guru.php';
    }

    // Halaman Filter Laporan Berita
    public function pageBerita() {
        $title = "Laporan Berita";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_berita.php';
    }

    // Halaman Filter Laporan PPDB
    public function pagePPDB() {
        $title = "Laporan PPDB";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_ppdb.php';
    }

    // [BARU] Halaman Laporan Pengumuman
    public function pagePengumuman() {
        $title = "Laporan Pengumuman";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_pengumuman.php';
    }

    // [BARU] Halaman Laporan Galeri
    public function pageGaleri() {
        $title = "Laporan Galeri";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_galeri.php';
    }
}
?>