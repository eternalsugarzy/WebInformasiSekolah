<?php
require_once __DIR__ . '/../models/GuruModel.php';

class AdminGuruController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function index() {
        $model = new GuruModel();
        $data_guru = $model->getAllGuru();
        
        $title = "Kelola Data Guru";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/guru_index.php';
    }

    public function tambah() {
        $title = "Tambah Guru Baru";
        require_once '../views/admin/guru_tambah.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $nip = $_POST['nip'];
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $jabatan = $_POST['jabatan'];
            $mapel = $_POST['mapel'];
            $email = $_POST['email'];

            // Upload Foto
            $nama_foto = "";
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $target_dir = "uploads/guru/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
                $nama_foto = time() . '_' . rand(100, 999) . '.' . $ext;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $nama_foto);
            }

            $sql = "INSERT INTO guru_staf (nip, nama_lengkap, jabatan, bidang_studi, email, foto) 
                    VALUES ('$nip', '$nama', '$jabatan', '$mapel', '$email', '$nama_foto')";
            
            if(mysqli_query($koneksi, $sql)) {
                header("Location: guru.php");
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        }
    }

    public function hapus($id) {
        $model = new GuruModel();
        $guru = $model->getGuruById($id);

        // Hapus file foto fisik
        if ($guru && !empty($guru['foto'])) {
            $path = "uploads/guru/" . $guru['foto'];
            if (file_exists($path)) unlink($path);
        }

        // Hapus data DB
        global $koneksi;
        mysqli_query($koneksi, "DELETE FROM guru_staf WHERE id_guru = $id");
        header("Location: guru.php");
    }

    // --- EDIT: Tampilkan Form ---
    public function edit($id) {
        $model = new GuruModel();
        $guru = $model->getGuruById($id);
        
        if (!$guru) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Guru";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/guru_edit.php';
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $id = $_POST['id_guru'];
            $nip = $_POST['nip'];
            $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
            $jabatan = $_POST['jabatan'];
            $mapel = $_POST['mapel'];
            $email = $_POST['email'];

            // Cek Upload Foto Baru
            $nama_foto = null;
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                // 1. Upload Foto Baru
                $target_dir = "uploads/guru/";
                $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
                $nama_foto = time() . '_' . rand(100, 999) . '.' . $ext;
                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $nama_foto);

                // 2. Hapus Foto Lama
                $model = new GuruModel();
                $dataLama = $model->getGuruById($id);
                if ($dataLama && !empty($dataLama['foto'])) {
                    $pathLama = "uploads/guru/" . $dataLama['foto'];
                    if (file_exists($pathLama)) {
                        unlink($pathLama);
                    }
                }
            }

            // Simpan Update
            $model = new GuruModel();
            $model->updateGuru($id, $nip, $nama, $jabatan, $mapel, $email, $nama_foto);
            
            header("Location: guru.php");
        }
    }
}
?>