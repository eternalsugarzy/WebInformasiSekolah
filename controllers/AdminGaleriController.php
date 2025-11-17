<?php
require_once __DIR__ . '/../models/GaleriModel.php';

class AdminGaleriController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function index() {
        $model = new GaleriModel();
        $data_galeri = $model->getAllGaleri();
        
        $title = "Kelola Galeri Sekolah";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/galeri_index.php';
    }

    public function tambah() {
        $title = "Tambah Album Galeri";
        require_once '../views/admin/galeri_tambah.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
            $tgl = $_POST['tanggal'];
            $tipe = $_POST['tipe']; // Foto atau Video

            // Upload File
            $nama_file = "";
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                $target_dir = "uploads/galeri/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                $nama_file = time() . '_' . rand(100, 999) . '.' . $ext;
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $nama_file);
            }

            $sql = "INSERT INTO galeri_media (judul_album, deskripsi, tanggal_event, file_path, tipe_media) 
                    VALUES ('$judul', '$deskripsi', '$tgl', '$nama_file', '$tipe')";
            
            mysqli_query($koneksi, $sql);
            header("Location: galeri.php");
        }
    }

    public function hapus($id) {
        $model = new GaleriModel();
        $galeri = $model->getGaleriById($id);

        // Hapus file fisik
        if ($galeri && !empty($galeri['file_path'])) {
            $path = "uploads/galeri/" . $galeri['file_path'];
            if (file_exists($path)) unlink($path);
        }

        $model->hapusGaleri($id);
        header("Location: galeri.php");
    }

    // --- EDIT: Tampilkan Form ---
    public function edit($id) {
        $model = new GaleriModel();
        $galeri = $model->getGaleriById($id);
        
        if (!$galeri) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Galeri";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/galeri_edit.php';
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $id = $_POST['id_album'];
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
            $tgl = $_POST['tanggal'];
            $tipe = $_POST['tipe'];

            // Cek Upload File Baru
            $nama_file = null;
            if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                // 1. Upload File Baru
                $target_dir = "uploads/galeri/";
                $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                $nama_file = time() . '_' . rand(100, 999) . '.' . $ext;
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $nama_file);

                // 2. Hapus File Lama
                $model = new GaleriModel();
                $dataLama = $model->getGaleriById($id);
                if ($dataLama && !empty($dataLama['file_path'])) {
                    $pathLama = "uploads/galeri/" . $dataLama['file_path'];
                    if (file_exists($pathLama)) {
                        unlink($pathLama);
                    }
                }
            }

            // Simpan Update
            $model = new GaleriModel();
            $model->updateGaleri($id, $judul, $deskripsi, $tgl, $tipe, $nama_file);
            
            header("Location: galeri.php");
        }
    }
}
?>