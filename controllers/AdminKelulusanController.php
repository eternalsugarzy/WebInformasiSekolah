<?php
require_once '../models/SawModel.php';

class AdminKelulusanController {
    public $model; // Dibuat public agar bisa diakses langsung oleh view kelulusan.php

    public function __construct() {
        $this->model = new SawModel();
    }

   public function index() {
    // Kita buat variabel lokal $model agar bisa terbaca oleh file view
    $model = $this->model; 
    require_once '../views/admin/kelulusan.php';
}

    public function prosesSimpan() {
        if (isset($_POST['simpan'])) {
            // Simpan masing-masing kuota ke database
            $this->model->updateSetting('kuota_diterima', $_POST['kuota_diterima']);
            $this->model->updateSetting('kuota_cadangan', $_POST['kuota_cadangan']);
            
            // Redirect dengan pesan sukses
            header("Location: kelulusan.php?pesan=sukses");
            exit;
        }
    }
}