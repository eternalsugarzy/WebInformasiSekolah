<?php
require_once '../models/SawModel.php';

class AdminBobotController {
    private $model;

    public function __construct() {
        $this->model = new SawModel();
    }

    public function index() {
        $data_kriteria = $this->model->getKriteria();
        $total_bobot = array_sum(array_column($data_kriteria, 'bobot'));
        $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : "";

        // Panggil View
        require_once '../views/admin/bobot_saw.php';
    }

    public function update() {
        if (isset($_POST['update_bobot'])) {
            $id_kriterias = $_POST['id_kriteria'];
            $bobots = $_POST['bobot'];

            $berhasil = true;
            for ($i = 0; $i < count($id_kriterias); $i++) {
                if (!$this->model->updateBobotKriteria($id_kriterias[$i], $bobots[$i])) {
                    $berhasil = false;
                }
            }
            $status = $berhasil ? "sukses" : "gagal";
            header("Location: bobot_saw.php?pesan=$status");
        }
    }
}
?>