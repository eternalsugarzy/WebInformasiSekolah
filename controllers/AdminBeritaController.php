<?php
require_once __DIR__ . '/../models/BeritaModel.php';

class AdminBeritaController {

    public function __construct() {
        // Cek Login
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    // Halaman Daftar Berita
    public function index() {
        $beritaModel = new BeritaModel();
        $data_berita = $beritaModel->getAllBerita();
        
        $title = "Kelola Berita - Admin";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/berita_index.php';
    }

    // Halaman Form Tambah
    public function tambah() {
        $title = "Tambah Berita Baru";
        require_once '../views/admin/berita_tambah.php';
    }

    // Proses Simpan Data (Create)
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul = $_POST['judul'];
            $kategori = $_POST['kategori'];
            $konten = $_POST['konten'];
            $tanggal = $_POST['tanggal'] . ' ' . date('H:i:s'); // Tambah jam sekarang
            $penulis = $_SESSION['admin_nama'];
            
            // Proses Upload Gambar
            $nama_gambar = "";
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "uploads/berita/";
                
                // Pastikan folder ada
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
                // Rename gambar agar unik (time + random number)
                $nama_gambar = time() . '_' . rand(100, 999) . '.' . $file_extension;
                $target_file = $target_dir . $nama_gambar;

                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            }

            // Simpan ke Database via Model
            // (Kita akses DB manual disini agar cepat, idealnya di Model)
            global $koneksi;
            $judul = mysqli_real_escape_string($koneksi, $judul);
            $konten = mysqli_real_escape_string($koneksi, $konten);

            $sql = "INSERT INTO berita_artikel (judul, konten_lengkap, tanggal_publikasi, penulis, kategori, gambar_utama) 
                    VALUES ('$judul', '$konten', '$tanggal', '$penulis', '$kategori', '$nama_gambar')";
            
            mysqli_query($koneksi, $sql);

            // Redirect ke halaman daftar
            header("Location: berita.php");
        }
    }

    // Hapus Berita
    public function hapus($id) {
        $beritaModel = new BeritaModel();
        $berita = $beritaModel->getBeritaById($id);
        
        // Hapus File Gambar
        if ($berita && !empty($berita['gambar_utama'])) {
            $path = "uploads/berita/" . $berita['gambar_utama'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Hapus Data DB
        global $koneksi;
        $sql = "DELETE FROM berita_artikel WHERE id_berita = $id";
        mysqli_query($koneksi, $sql);

        header("Location: berita.php");
    }
    
    public function edit($id) { echo "Fitur Edit (Next Step)"; }
    public function update($id) {}
}
?>