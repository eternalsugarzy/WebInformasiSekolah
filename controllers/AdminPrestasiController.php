<?php
require_once __DIR__ . '/../models/PrestasiModel.php';

// Kelola Prestasi Siswa: CRUD + unggah bukti sertifikat + verifikasi.
class AdminPrestasiController {
    private $model;
    const UPLOAD_DIR = 'uploads/prestasi/';
    const MAX_SIZE = 2097152; // 2 MB
    const EXT_OK = ['jpg', 'jpeg', 'png', 'pdf'];

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
        $this->model = new PrestasiModel();
    }

    public function index() {
        $filters = [
            'tahun'   => $_GET['tahun'] ?? '',
            'jenis'   => $_GET['jenis'] ?? '',
            'tingkat' => $_GET['tingkat'] ?? '',
            'kelas'   => $_GET['kelas'] ?? '',
            'status'  => $_GET['status'] ?? '',
            'q'       => trim($_GET['q'] ?? ''),
        ];
        $data_prestasi = $this->model->getAll($filters);
        $ringkasan = $this->model->getRingkasan($filters);
        $daftar_tahun = $this->model->getDaftarTahun();
        $pesan = $_GET['pesan'] ?? '';

        $title = "Kelola Prestasi Siswa";
        $nama_admin = $_SESSION['admin_nama'] ?? '';
        require_once '../views/admin/prestasi_index.php';
    }

    public function form($id = null) {
        $prestasi = $id ? $this->model->getById($id) : null;
        if ($id && !$prestasi) {
            header("Location: prestasi.php?pesan=tidak_ditemukan");
            exit;
        }
        $siswa_aktif = $this->model->getSiswaAktif();
        // Saat edit, siswa pemilik prestasi tetap tampil walau statusnya kini tidak aktif lagi
        if ($prestasi && !in_array($prestasi['id_pendaftar'], array_column($siswa_aktif, 'id_pendaftar'))) {
            $siswa_aktif[] = [
                'id_pendaftar' => $prestasi['id_pendaftar'],
                'nama_lengkap' => $prestasi['nama_lengkap'],
                'nisn'         => $prestasi['nisn'],
                'angkatan'     => '-',
            ];
        }
        $pesan = $_GET['pesan'] ?? '';

        $title = $prestasi ? "Edit Prestasi Siswa" : "Tambah Prestasi Siswa";
        $nama_admin = $_SESSION['admin_nama'] ?? '';
        require_once '../views/admin/prestasi_form.php';
    }

    // Ambil & validasi input form. Mengembalikan [data, kode_error|null]
    private function ambilInput($id_pendaftar_lama = null) {
        $d = [
            'id_pendaftar'       => intval($_POST['id_pendaftar'] ?? 0),
            'kelas'              => $_POST['kelas'] ?? '',
            'nama_prestasi'      => trim($_POST['nama_prestasi'] ?? ''),
            'jenis'              => $_POST['jenis'] ?? '',
            'tingkat'            => $_POST['tingkat'] ?? '',
            'peringkat'          => trim($_POST['peringkat'] ?? ''),
            'penyelenggara'      => trim($_POST['penyelenggara'] ?? ''),
            'tahun'              => intval($_POST['tahun'] ?? 0),
            'status_verifikasi'  => $_POST['status_verifikasi'] ?? 'Menunggu',
            'catatan_verifikasi' => trim($_POST['catatan_verifikasi'] ?? ''),
            'bukti_sertifikat'   => null,
        ];

        $tahun_maks = (int) date('Y');
        $siswa_sama = $id_pendaftar_lama !== null && $d['id_pendaftar'] === (int) $id_pendaftar_lama;
        if (!$siswa_sama && !$this->model->isSiswaAktif($d['id_pendaftar'])) return [$d, 'siswa_tidak_valid'];
        if ($d['nama_prestasi'] === '' || $d['peringkat'] === '' || $d['penyelenggara'] === '') return [$d, 'tidak_lengkap'];
        if (!in_array($d['kelas'], PrestasiModel::KELAS, true)
            || !in_array($d['jenis'], PrestasiModel::JENIS, true)
            || !in_array($d['tingkat'], PrestasiModel::TINGKAT, true)
            || !in_array($d['status_verifikasi'], PrestasiModel::STATUS, true)) return [$d, 'tidak_lengkap'];
        if ($d['tahun'] < 2000 || $d['tahun'] > $tahun_maks) return [$d, 'tahun_tidak_valid'];

        return [$d, null];
    }

    // Upload sertifikat (opsional). Mengembalikan [nama_file|null, kode_error|null]
    private function uploadSertifikat() {
        if (!isset($_FILES['bukti_sertifikat']) || $_FILES['bukti_sertifikat']['error'] === UPLOAD_ERR_NO_FILE) {
            return [null, null];
        }
        $f = $_FILES['bukti_sertifikat'];
        if ($f['error'] !== UPLOAD_ERR_OK) return [null, 'upload_gagal'];
        if ($f['size'] > self::MAX_SIZE) return [null, 'file_besar'];

        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::EXT_OK, true)) return [null, 'file_tidak_valid'];

        // Cek isi file sebenarnya, bukan hanya ekstensi
        $mime = function_exists('mime_content_type') ? mime_content_type($f['tmp_name']) : '';
        $mime_ok = ['image/jpeg', 'image/png', 'application/pdf'];
        if ($mime !== '' && !in_array($mime, $mime_ok, true)) return [null, 'file_tidak_valid'];

        if (!file_exists(self::UPLOAD_DIR)) mkdir(self::UPLOAD_DIR, 0755, true);
        $nama = 'sertifikat_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        if (!move_uploaded_file($f['tmp_name'], self::UPLOAD_DIR . $nama)) return [null, 'upload_gagal'];

        return [$nama, null];
    }

    private function hapusFile($nama) {
        if (!empty($nama)) {
            $path = self::UPLOAD_DIR . basename($nama);
            if (file_exists($path)) unlink($path);
        }
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        list($d, $err) = $this->ambilInput();
        if ($err) { header("Location: prestasi.php?aksi=tambah&pesan=$err"); exit; }

        list($file, $err) = $this->uploadSertifikat();
        if ($err) { header("Location: prestasi.php?aksi=tambah&pesan=$err"); exit; }
        $d['bukti_sertifikat'] = $file;

        $ok = $this->model->tambah($d);
        if (!$ok) $this->hapusFile($file);
        header("Location: prestasi.php?pesan=" . ($ok ? 'tersimpan' : 'gagal'));
        exit;
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $id = intval($_POST['id_prestasi'] ?? 0);
        $lama = $this->model->getById($id);
        if (!$lama) { header("Location: prestasi.php?pesan=tidak_ditemukan"); exit; }

        list($d, $err) = $this->ambilInput($lama['id_pendaftar']);
        if ($err) { header("Location: prestasi.php?aksi=edit&id=$id&pesan=$err"); exit; }

        list($file, $err) = $this->uploadSertifikat();
        if ($err) { header("Location: prestasi.php?aksi=edit&id=$id&pesan=$err"); exit; }
        $d['bukti_sertifikat'] = $file; // null = tidak diganti

        $ok = $this->model->update($id, $d);
        if ($ok && $file) {
            $this->hapusFile($lama['bukti_sertifikat']); // sertifikat lama diganti
        } elseif (!$ok) {
            $this->hapusFile($file);
        }
        header("Location: prestasi.php?pesan=" . ($ok ? 'diperbarui' : 'gagal'));
        exit;
    }

    // Verifikasi cepat dari tabel daftar (Terverifikasi / Ditolak / kembali Menunggu)
    public function verifikasi() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        $ok = $this->model->verifikasi(
            $_POST['id_prestasi'] ?? 0,
            $_POST['status_verifikasi'] ?? '',
            trim($_POST['catatan_verifikasi'] ?? '')
        );
        $kembali = $_POST['kembali'] ?? '';
        $qs = (strpos($kembali, 'prestasi.php') === 0) ? $kembali : 'prestasi.php';
        $qs .= (strpos($qs, '?') === false ? '?' : '&') . 'pesan=' . ($ok ? 'diverifikasi' : 'gagal');
        header("Location: $qs");
        exit;
    }

    public function hapus() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        $id = intval($_POST['id_prestasi'] ?? 0);
        $lama = $this->model->getById($id);
        $ok = $lama && $this->model->hapus($id);
        if ($ok) $this->hapusFile($lama['bukti_sertifikat']);
        header("Location: prestasi.php?pesan=" . ($ok ? 'terhapus' : 'gagal'));
        exit;
    }
}
