<?php
require_once __DIR__ . '/../models/GelombangModel.php';

// Kelola gelombang pendaftaran PPDB (nama + rentang tanggal). Setiap perubahan
// otomatis memetakan ulang pendaftar ke gelombang sesuai tanggal daftarnya.
class AdminGelombangController {
    private $model;

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
        $this->model = new GelombangModel();
    }

    public function index() {
        $daftar_gelombang = $this->model->getAll();
        $gelombang_aktif = $this->model->getGelombangAktif();
        $edit = null;
        if (isset($_GET['edit'])) {
            $edit = $this->model->getById($_GET['edit']);
        }
        $pesan = $_GET['pesan'] ?? '';
        $info_bentrok = $_GET['bentrok'] ?? '';

        $title = "Gelombang Pendaftaran PPDB";
        $nama_admin = $_SESSION['admin_nama'] ?? '';
        require_once '../views/admin/gelombang.php';
    }

    // Validasi & simpan (tambah bila id kosong, update bila ada id)
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $id    = !empty($_POST['id_gelombang']) ? intval($_POST['id_gelombang']) : null;
        $nama  = trim($_POST['nama_gelombang'] ?? '');
        $mulai = $_POST['tanggal_mulai'] ?? '';
        $akhir = $_POST['tanggal_akhir'] ?? '';
        $ket   = trim($_POST['keterangan'] ?? '');

        $valid_tgl = function ($t) {
            $d = DateTime::createFromFormat('Y-m-d', $t);
            return $d && $d->format('Y-m-d') === $t;
        };

        $kembali = 'gelombang.php' . ($id ? '?edit=' . $id . '&' : '?');

        if ($nama === '' || !$valid_tgl($mulai) || !$valid_tgl($akhir)) {
            header("Location: {$kembali}pesan=tidak_valid");
            exit;
        }
        if ($akhir < $mulai) {
            header("Location: {$kembali}pesan=tanggal_terbalik");
            exit;
        }

        // Rentang tanggal tidak boleh bertabrakan, karena pendaftar dipetakan ke
        // gelombang berdasarkan tanggal daftar (harus tepat satu gelombang).
        $bentrok = $this->model->cariBentrok($mulai, $akhir, $id);
        if ($bentrok) {
            $info = urlencode($bentrok['nama_gelombang'] . ' (' . date('d/m/Y', strtotime($bentrok['tanggal_mulai'])) . ' - ' . date('d/m/Y', strtotime($bentrok['tanggal_akhir'])) . ')');
            header("Location: {$kembali}pesan=bentrok&bentrok=$info");
            exit;
        }

        $ok = $id
            ? $this->model->update($id, $nama, $mulai, $akhir, $ket)
            : $this->model->tambah($nama, $mulai, $akhir, $ket);

        header("Location: gelombang.php?pesan=" . ($ok ? 'sukses' : 'gagal'));
        exit;
    }

    public function hapus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        $ok = $this->model->hapus($_POST['id_gelombang'] ?? 0);
        header("Location: gelombang.php?pesan=" . ($ok ? 'terhapus' : 'gagal'));
        exit;
    }
}
