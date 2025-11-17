<?php
require_once __DIR__ . '/../models/PengumumanModel.php';

class AdminPengumumanController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function index() {
        $model = new PengumumanModel();
        $data_pengumuman = $model->getAllPengumuman();
        
        $title = "Kelola Pengumuman";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/pengumuman_index.php';
    }

    public function tambah() {
        $title = "Tambah Pengumuman";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/pengumuman_tambah.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi; // Ambil koneksi global

            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tanggal = $_POST['tanggal'];
            $status = $_POST['status'];

            $sql = "INSERT INTO pengumuman (judul, isi_pengumuman, tanggal_penting, status) 
                    VALUES ('$judul', '$isi', '$tanggal', '$status')";
            
            if(mysqli_query($koneksi, $sql)){
                header("Location: pengumuman.php");
            } else {
                echo "Gagal menyimpan: " . mysqli_error($koneksi);
            }
        }
    }

    public function hapus($id) {
        $model = new PengumumanModel();
        $model->hapusPengumuman($id);
        header("Location: pengumuman.php");
    }

    // --- EDIT: Tampilkan Form ---
    public function edit($id) {
        $model = new PengumumanModel();
        $pengumuman = $model->getPengumumanById($id);
        
        if (!$pengumuman) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Pengumuman";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/pengumuman_edit.php';
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $id = $_POST['id_pengumuman'];
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tanggal = $_POST['tanggal'];
            $status = $_POST['status'];

            $model = new PengumumanModel();
            $model->updatePengumuman($id, $judul, $isi, $tanggal, $status);
            
            header("Location: pengumuman.php");
        }
    }
}
?>