<?php
require_once '../models/SawModel.php';
require_once '../models/HistoriSawModel.php';

class AdminKelulusanController {
    public $model; // Dibuat public agar bisa diakses langsung oleh view kelulusan.php
    private $historiModel;

    public function __construct() {
        $this->model = new SawModel();
        $this->historiModel = new HistoriSawModel();
    }

   public function index() {
    // Kita buat variabel lokal $model agar bisa terbaca oleh file view
    $model = $this->model; 
    require_once '../views/admin/kelulusan.php';
}

    public function prosesSimpan() {
        if (isset($_POST['simpan'])) {
            // Snapshot kuota lama SEBELUM diubah, untuk histori
            $kuota_lama = [
                'Kuota Diterima' => $this->model->getSetting('kuota_diterima'),
                'Kuota Cadangan' => $this->model->getSetting('kuota_cadangan'),
            ];

            // Simpan masing-masing kuota ke database
            $this->model->updateSetting('kuota_diterima', $_POST['kuota_diterima']);
            $this->model->updateSetting('kuota_cadangan', $_POST['kuota_cadangan']);

            $kuota_baru = [
                'Kuota Diterima' => (int) $_POST['kuota_diterima'],
                'Kuota Cadangan' => (int) $_POST['kuota_cadangan'],
            ];

            if ($kuota_lama != $kuota_baru) {
                $this->historiModel->catat(
                    'Kuota Kelulusan',
                    'Ubah kuota kelulusan PPDB',
                    $kuota_lama,
                    $kuota_baru
                );
            }

            // Redirect dengan pesan sukses
            header("Location: kelulusan.php?pesan=sukses");
            exit;
        }
    }
}