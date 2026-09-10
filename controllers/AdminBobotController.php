<?php
require_once '../models/SawModel.php';
require_once '../models/HistoriSawModel.php';

class AdminBobotController {
    private $model;
    private $historiModel;

    public function __construct() {
        $this->model = new SawModel();
        $this->historiModel = new HistoriSawModel();
    }

    public function index() {
        $jalur_list = $this->model->getJalurList();
        $jalur_terpilih = isset($_GET['jalur']) && in_array($_GET['jalur'], $jalur_list)
            ? $_GET['jalur']
            : $jalur_list[0];

        $data_kriteria = $this->model->getKriteriaByJalur($jalur_terpilih);
        $total_bobot = array_sum(array_column($data_kriteria, 'bobot'));
        $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : "";

        // Panggil View
        require_once '../views/admin/bobot_saw.php';
    }

    public function update() {
        if (isset($_POST['update_bobot'])) {
            $jalur_list = $this->model->getJalurList();
            $jalur = isset($_POST['jalur_seleksi']) && in_array($_POST['jalur_seleksi'], $jalur_list)
                ? $_POST['jalur_seleksi']
                : $jalur_list[0];

            $id_kriterias = $_POST['id_kriteria'];
            $bobots = $_POST['bobot'];

            // Ambil bobot lama SEBELUM diubah, untuk dicatat di histori (data_lama -> data_baru)
            $kriteria_lama = $this->model->getKriteriaByJalur($jalur);
            $bobot_lama = [];
            foreach ($kriteria_lama as $k) {
                $bobot_lama[$k['nama_kriteria']] = (float) $k['bobot'];
            }

            $berhasil = true;
            $bobot_baru = [];
            for ($i = 0; $i < count($id_kriterias); $i++) {
                if (!$this->model->updateBobotJalur($jalur, $id_kriterias[$i], $bobots[$i])) {
                    $berhasil = false;
                }
                $nama_k = isset($kriteria_lama[$i]['nama_kriteria']) ? $kriteria_lama[$i]['nama_kriteria'] : ('Kriteria #' . $id_kriterias[$i]);
                $bobot_baru[$nama_k] = (float) $bobots[$i];
            }

            // Catat histori hanya jika ada nilai yang benar-benar berubah (hindari log kosong)
            if ($berhasil && $bobot_lama != $bobot_baru) {
                $this->historiModel->catat(
                    'Bobot SAW',
                    "Ubah bobot kriteria SAW untuk jalur seleksi $jalur",
                    $bobot_lama,
                    $bobot_baru
                );
            }

            $status = $berhasil ? "sukses" : "gagal";
            $jalur_enc = urlencode($jalur);

            // ✅ Menggunakan JavaScript untuk redirect agar terhindar dari error "headers already sent"
            echo "<script>window.location.href='bobot_saw.php?jalur=$jalur_enc&pesan=$status';</script>";
            exit;
        }
    }
}
?>