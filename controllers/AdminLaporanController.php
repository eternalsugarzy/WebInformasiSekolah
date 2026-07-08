<?php
class AdminLaporanController {

    public function __construct() {
        // Logika autentikasi dan pengalihan harus ada di sini
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    // 🎯 FUNGSI BARU: Halaman Index/Daftar Tautan Laporan 🎯
    public function index() {
        $title = "Daftar Laporan Arsip";
        $nama_admin = $_SESSION['admin_nama'];
        
        // PENTING: File ini harus berisi 5 tautan ke laporan spesifik
        require_once '../views/admin/laporan/laporan_index.php'; 
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

    // Halaman Laporan Pengumuman
    public function pagePengumuman() {
        $title = "Laporan Pengumuman";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_pengumuman.php';
    }

    // Halaman Laporan Galeri
    public function pageGaleri() {
        $title = "Laporan Galeri";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_galeri.php';
    }

    // Halaman Laporan Rincian Perhitungan SAW
    public function pageSaw() {
        $title = "Laporan Rincian Perhitungan SAW";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_saw.php';
    }

    // Halaman Laporan Statistik Nilai Rata-Rata Pendaftar
    public function pageStatistikNilai() {
        $title = "Laporan Statistik Nilai Rata-Rata Pendaftar";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_statistik_nilai.php';
    }

    // Halaman Laporan Rekapitulasi Pendaftar per Jalur Seleksi
    public function pageJalur() {
        $title = "Laporan Rekap Jalur Seleksi";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/laporan/laporan_jalur.php';
    }
}
?>