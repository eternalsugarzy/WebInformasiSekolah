<?php
require_once __DIR__ . '/../models/PrestasiModel.php';

// Halaman publik "Siswa Berprestasi" -- hanya menampilkan prestasi yang sudah TERVERIFIKASI
class PrestasiController {

    public function index() {
        $model = new PrestasiModel();

        $filters = [
            'tahun'   => $_GET['tahun'] ?? '',
            'jenis'   => $_GET['jenis'] ?? '',
            'tingkat' => $_GET['tingkat'] ?? '',
            'q'       => trim($_GET['q'] ?? ''),
            'status'  => 'Terverifikasi', // tidak bisa diubah dari URL
        ];

        $data_prestasi = $model->getAll($filters);
        $ringkasan = $model->getRingkasan($filters);
        $daftar_tahun = $model->getDaftarTahun();

        $title = "Siswa Berprestasi - SMA Frater Don Bosco Banjarmasin";

        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/prestasi.php';
        require_once __DIR__ . '/../views/template/footer.php';
    }
}
