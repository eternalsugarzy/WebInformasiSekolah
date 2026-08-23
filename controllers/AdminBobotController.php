<?php
require_once '../models/SawModel.php';

class AdminBobotController {
    private $model;

    public function __construct() {
        $this->model = new SawModel();
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

            $berhasil = true;
            for ($i = 0; $i < count($id_kriterias); $i++) {
                if (!$this->model->updateBobotJalur($jalur, $id_kriterias[$i], $bobots[$i])) {
                    $berhasil = false;
                }
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