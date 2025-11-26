<?php
require_once __DIR__ . '/../models/IdentitasModel.php';

class AdminIdentitasController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php"); exit;
        }
    }

    public function index() {
        $model = new IdentitasModel();
        $data = $model->getIdentitas();
        
        // [TAMBAHAN] Ambil data poster
        $posters = $model->getAllPosters();
        
        $title = "Pengaturan Identitas Sekolah";
        $nama_admin = $_SESSION['admin_nama'];
        
        require_once '../views/admin/identitas_form.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $sejarah = mysqli_real_escape_string($koneksi, $_POST['sejarah']);
            $visi = mysqli_real_escape_string($koneksi, $_POST['visi']);
            $misi = mysqli_real_escape_string($koneksi, $_POST['misi']);
            $fasilitas = mysqli_real_escape_string($koneksi, $_POST['fasilitas']);

            // Upload Poster
            $nama_poster = null;
            if (isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {
                $target_dir = "uploads/identitas/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                $ext = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
                $nama_poster = "poster_" . time() . '.' . $ext;
                move_uploaded_file($_FILES["poster"]["tmp_name"], $target_dir . $nama_poster);
            }

            $model = new IdentitasModel();
            $model->updateIdentitas($sejarah, $visi, $misi, $fasilitas, $nama_poster);
            
            // Redirect agar data ter-refresh
            echo "<script>alert('Profil Berhasil Diupdate!'); window.location='identitas.php';</script>";
        }
    }

    // --- FUNGSI BARU: UPLOAD POSTER SLIDER ---
   public function upload_poster() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {
                
                $target_dir = "uploads/identitas/";
                if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

                $ext = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
                $nama_poster = "slider_" . time() . rand(100,999) . '.' . $ext;
                
                if(move_uploaded_file($_FILES["poster"]["tmp_name"], $target_dir . $nama_poster)) {
                    $model = new IdentitasModel();
                    $model->insertPoster($nama_poster);
                }
            }
            
            // [PERBAIKAN] Ganti header() dengan Script ini:
            echo "<script>window.location='identitas.php?tab=poster';</script>";
            exit;
        }
    }

    // --- FUNGSI BARU: HAPUS POSTER ---
    public function hapus_poster($id) {
        $model = new IdentitasModel();
        $data = $model->getPosterById($id);

        // Hapus file fisik
        if ($data && !empty($data['file_poster'])) {
            $path = "uploads/identitas/" . $data['file_poster'];
            if (file_exists($path)) unlink($path);
        }

        $model->deletePoster($id);
        
        // [PERBAIKAN] Ganti header() dengan Script ini:
        echo "<script>window.location='identitas.php?tab=poster';</script>";
        exit;
    }
}
?>