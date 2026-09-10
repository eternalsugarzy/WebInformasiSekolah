<?php
require_once __DIR__ . '/../models/PPDBModel.php';
require_once __DIR__ . '/../models/HistoriSawModel.php';

// Menghubungkan hasil seleksi SAW (status_seleksi = 'Diterima') dengan proses
// penerimaan sesungguhnya: siswa yang lolos seleksi masih perlu konfirmasi daftar
// ulang. Jika mengundurkan diri, kursinya bisa diisi dari Cadangan berikutnya
// (berdasarkan peringkat SAW) tanpa perlu menjalankan ulang proses SAW dari awal.
class AdminDaftarUlangController {
    private $model;
    private $historiModel;

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
        $this->model = new PPDBModel();
        $this->historiModel = new HistoriSawModel();
    }

    public function index() {
        $filters = [
            'status_daftar_ulang' => isset($_GET['status_daftar_ulang']) ? $_GET['status_daftar_ulang'] : '',
            'jalur' => isset($_GET['jalur']) ? $_GET['jalur'] : '',
        ];

        $daftar = $this->model->getPendaftarDaftarUlang($filters);
        $ringkasan = $this->model->getRingkasanDaftarUlang();
        $cadangan_terbaik = $this->model->getCadanganTerbaik();
        $pesan = isset($_GET['pesan']) ? $_GET['pesan'] : '';

        require_once '../views/admin/daftar_ulang.php';
    }

    // Ubah status daftar ulang 1 pendaftar (Daftar Ulang / Mengundurkan Diri / reset ke Belum Konfirmasi)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $id = intval($_POST['id_pendaftar']);
        $status_baru = $_POST['status_daftar_ulang'];
        $catatan = isset($_POST['catatan_daftar_ulang']) ? $_POST['catatan_daftar_ulang'] : '';

        $data_lama = $this->model->getPendaftarById($id);
        $status_lama = $data_lama ? $data_lama['status_daftar_ulang'] : null;
        $nama_siswa = $data_lama ? $data_lama['nama_lengkap'] : ('Pendaftar #' . $id);

        $berhasil = $this->model->updateDaftarUlang($id, $status_baru, $catatan);

        if ($berhasil && $status_lama !== $status_baru) {
            $this->historiModel->catat(
                'Daftar Ulang',
                "Ubah status daftar ulang: $nama_siswa",
                ['Status Daftar Ulang' => $status_lama],
                ['Status Daftar Ulang' => $status_baru]
            );
        }

        $pesan = $berhasil ? 'sukses' : 'gagal';
        header("Location: daftar_ulang.php?pesan=$pesan");
        exit;
    }

    // Promosikan kandidat Cadangan dengan peringkat SAW terbaik menjadi Diterima --
    // dipakai saat ada kursi kosong akibat siswa Diterima mengundurkan diri.
    public function promosiCadangan() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $id = intval($_POST['id_pendaftar']);
        $calon = $this->model->getPendaftarById($id);

        if (!$calon || $calon['status_seleksi'] !== 'Cadangan') {
            header("Location: daftar_ulang.php?pesan=gagal_promosi");
            exit;
        }

        $berhasil = $this->model->promosikanKeDiterima($id);

        if ($berhasil) {
            $this->historiModel->catat(
                'Daftar Ulang',
                "Promosikan Cadangan menjadi Diterima (mengisi kursi kosong): {$calon['nama_lengkap']}",
                ['Status Seleksi' => 'Cadangan'],
                ['Status Seleksi' => 'Diterima']
            );
        }

        $pesan = $berhasil ? 'sukses_promosi' : 'gagal_promosi';
        header("Location: daftar_ulang.php?pesan=$pesan");
        exit;
    }
}
?>
