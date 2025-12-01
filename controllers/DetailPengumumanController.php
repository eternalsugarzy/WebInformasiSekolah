<?php
// controllers/DetailPengumumanController.php

require_once __DIR__ . '/../models/PengumumanModel.php';

class DetailPengumumanController
{
    private $model;

    public function __construct()
    {
        $this->model = new PengumumanModel();
    }

    /**
     * Tampilkan halaman detail pengumuman.
     * Dipanggil dari root: detail_pengumuman.php?id=...
     */
    public function index()
    {
        // Ambil ID dari querystring
        if (!isset($_GET['id']) || $_GET['id'] === '') {
            header("Location: pengumuman.php");
            exit;
        }

        // Karena model kamu memakai integer id, cast ke int
        $rawId = $_GET['id'];
        $id = intval($rawId);

        // Gunakan method yang ada di model: getPengumumanById
        $pengumuman = $this->model->getPengumumanById($id);

        // jika tidak ditemukan, set status 404 (opsional) dan tetap show view
        if (!$pengumuman) {
            http_response_code(404);
            $error_message = "Pengumuman tidak ditemukan.";
            // view di root: /views/detail_pengumuman.php
            require_once __DIR__ . '/../views/detail_pengumuman.php';
            return;
        }

        // jika ditemukan, view akan menggunakan $pengumuman
        require_once __DIR__ . '/../views/detail_pengumuman.php';
    }
}
