<?php
require_once '../models/SawModel.php';
require_once '../models/EmailNotifikasiModel.php';

class AdminSawController {
    private $model;
    private $emailModel;

    public function __construct() {
        $this->model = new SawModel();
        $this->emailModel = new EmailNotifikasiModel();
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

        // 4. Kirim notifikasi email hasil kelulusan (otomatis, ke pendaftar yang belum
        // dinotifikasi atau statusnya berubah sejak terakhir dikirim). Kegagalan kirim
        // email (mis. SMTP belum dikonfigurasi) tidak boleh menggagalkan proses seleksi.
        try {
            $this->emailModel->kirimSemua();
        } catch (Exception $e) {
            // Diamkan di sini -- detail sukses/gagal per pendaftar tetap tercatat di
            // log_notifikasi_email dan bisa dicek/kirim ulang lewat menu Notifikasi Email.
        }

        header("Location: proses_saw.php?pesan=sukses");
        exit;
    }
}
?>