<?php
require_once '../models/SawModel.php';
require_once '../models/HistoriSawModel.php';

class AdminKelulusanController {
    public $model; // Dibuat public agar bisa diakses langsung oleh view kelulusan.php
    private $historiModel;

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
        $this->model = new SawModel();
        $this->historiModel = new HistoriSawModel();
    }

    public function index() {
        // Variabel lokal agar bisa terbaca oleh file view
        $model = $this->model;
        $jalur_list = $this->model->getJalurList();
        $kuota_jalur = $this->model->getKuotaJalur();
        require_once '../views/admin/kelulusan.php';
    }

    // Simpan kuota Diterima & Cadangan untuk SETIAP jalur seleksi.
    // Form mengirim: kuota[Zonasi][diterima], kuota[Zonasi][cadangan], dst.
    public function prosesSimpan() {
        if (isset($_POST['simpan']) && isset($_POST['kuota']) && is_array($_POST['kuota'])) {
            $kuota_sebelum = $this->model->getKuotaJalur();
            $kuota_lama = [];
            $kuota_baru = [];

            foreach ($this->model->getJalurList() as $jalur) {
                if (!isset($_POST['kuota'][$jalur])) continue;

                $d = max(0, intval($_POST['kuota'][$jalur]['diterima'] ?? 0));
                $c = max(0, intval($_POST['kuota'][$jalur]['cadangan'] ?? 0));
                $this->model->updateKuotaJalur($jalur, $d, $c);

                $kuota_lama["$jalur - Diterima"] = $kuota_sebelum[$jalur]['kuota_diterima'];
                $kuota_lama["$jalur - Cadangan"] = $kuota_sebelum[$jalur]['kuota_cadangan'];
                $kuota_baru["$jalur - Diterima"] = $d;
                $kuota_baru["$jalur - Cadangan"] = $c;
            }

            if ($kuota_lama != $kuota_baru) {
                $this->historiModel->catat(
                    'Kuota Kelulusan',
                    'Ubah kuota kelulusan PPDB per jalur seleksi',
                    $kuota_lama,
                    $kuota_baru
                );
            }

            header("Location: kelulusan.php?pesan=sukses");
            exit;
        }
    }
}
