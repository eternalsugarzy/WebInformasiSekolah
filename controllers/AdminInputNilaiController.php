<?php
require_once '../models/SawModel.php';
require_once '../models/HistoriSawModel.php';

class AdminInputNilaiController {
    private $model;
    private $historiModel;

    public function __construct() {
        $this->model = new SawModel();
        $this->historiModel = new HistoriSawModel();
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

            // Snapshot nilai lama SEBELUM diubah, untuk histori (mungkin belum pernah diinput -> semua null)
            $lama = $this->model->getNilaiLengkapByPendaftar($id_pendaftar);

            $berhasil = $this->model->simpanNilaiPendaftar($id_pendaftar, $raport, $tes, $prestasi, $jarak);
            // simpanNilaiPendaftar menolak (return false) jika jarak di bawah batas minimum
            $pesan = $berhasil ? "sukses" : "jarak_invalid";

            if ($berhasil) {
                $nama_siswa = $lama['nama_lengkap'] ?? ('Pendaftar #' . $id_pendaftar);
                $data_lama = [
                    'Nilai Rapor'    => $lama['nilai_raport'] ?? null,
                    'Nilai Tes'      => $lama['nilai_tes'] ?? null,
                    'Nilai Prestasi' => $lama['nilai_prestasi'] ?? null,
                    'Jarak Rumah'    => $lama['jarak_rumah'] ?? null,
                ];
                $data_baru = [
                    'Nilai Rapor'    => $raport,
                    'Nilai Tes'      => $tes,
                    'Nilai Prestasi' => $prestasi,
                    'Jarak Rumah'    => $jarak,
                ];
                if ($data_lama != $data_baru) {
                    $this->historiModel->catat(
                        'Nilai Pendaftar',
                        "Ubah nilai pendaftar SAW: $nama_siswa",
                        $data_lama,
                        $data_baru
                    );
                }
            }

            header("Location: input_nilai.php?pesan=$pesan");
            exit;
        }
    }
}
?>