<?php
require_once '../models/SawModel.php';

class AdminInputNilaiController {
    private $model;

    public function __construct() {
        $this->model = new SawModel();
    }

    public function index() {
        $data_pendaftar = $this->model->getPendaftarDanNilai();
        require_once '../views/admin/input_nilai.php';
    }

    public function simpan() {
        if (isset($_POST['simpan_nilai'])) {
            $id_pendaftar = $_POST['id_pendaftar'];
            $raport = $_POST['nilai_raport'];
            $tes = $_POST['nilai_tes'];
            $prestasi = $_POST['nilai_prestasi'];
            $jarak = $_POST['jarak_rumah'];

            $berhasil = $this->model->simpanNilaiPendaftar($id_pendaftar, $raport, $tes, $prestasi, $jarak);
            // simpanNilaiPendaftar menolak (return false) jika jarak di bawah batas minimum
            $pesan = $berhasil ? "sukses" : "jarak_invalid";

            header("Location: input_nilai.php?pesan=$pesan");
            exit;
        }
    }
}
?>