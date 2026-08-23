<?php
require_once '../models/EmailNotifikasiModel.php';

class AdminNotifikasiController {
    private $model;

    public function __construct() {
        $this->model = new EmailNotifikasiModel();
    }

    public function index() {
        $data_notifikasi = $this->model->getDaftarNotifikasi();
        $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : "";
        $ringkasan_terkirim = isset($_GET['t']) ? intval($_GET['t']) : 0;
        $ringkasan_gagal = isset($_GET['g']) ? intval($_GET['g']) : 0;
        $ringkasan_dilewati = isset($_GET['d']) ? intval($_GET['d']) : 0;

        require_once '../views/admin/notifikasi_email.php';
    }

    // Kirim/kirim ulang notifikasi untuk 1 pendaftar
    public function kirimSatu() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $hasil = $this->model->kirimSatu($id, true); // paksa=true, dipicu manual oleh admin
        $status = $hasil['sukses'] ? 'sukses' : 'gagal';

        header("Location: notifikasi_email.php?pesan=$status");
        exit;
    }

    // Kirim notifikasi massal ke semua pendaftar berstatus final yang belum dinotifikasi
    public function kirimSemua() {
        $ringkasan = $this->model->kirimSemua();
        header("Location: notifikasi_email.php?pesan=massal&t={$ringkasan['terkirim']}&g={$ringkasan['gagal']}&d={$ringkasan['dilewati']}");
        exit;
    }
}
?>