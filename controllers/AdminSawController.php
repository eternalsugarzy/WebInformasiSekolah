<?php
require_once '../models/SawModel.php';

class AdminSawController {
    private $model;

    public function __construct() {
        $this->model = new SawModel();
    }

    public function index() {
        // Ambil data untuk ditampilkan
        $data_pendaftar = $this->model->getPendaftarDanNilai();
        $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : "";
        
        // Panggil View
        require_once '../views/admin/proses_saw.php';
    }

    public function jalankan() {
        // 1. Hitung ulang nilai SAW
        $this->model->hitungDanUpdateSAW();
        
        // 2. Pastikan Ranking diurutkan ulang (WAJIB dilakukan sebelum update status)
        $this->model->updateRanking();
        
        // 3. Update status kelulusan berdasarkan kuota yang diatur admin (tabel setting_ppdb)
        $this->model->updateStatusKelulusan();
        
        header("Location: proses_saw.php?pesan=sukses");
        exit;
    }
}
?>