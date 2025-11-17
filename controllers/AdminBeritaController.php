<?php
require_once __DIR__ . '/../models/BeritaModel.php';

class AdminBeritaController {

    public function __construct() {
        // Cek Login: Hanya admin yang boleh akses
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    // Menampilkan Daftar Berita
    public function index() {
        $beritaModel = new BeritaModel();
        $data_berita = $beritaModel->getAllBerita();
        
        $title = "Kelola Berita - Admin";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/berita_index.php';
    }

    // Menghapus Berita
    public function hapus($id) {
        $beritaModel = new BeritaModel();
        
        // 1. Ambil data dulu untuk tahu nama file gambarnya
        $berita = $beritaModel->getBeritaById($id);
        
        // 2. Hapus file gambar fisik jika ada
        if ($berita && !empty($berita['gambar_utama'])) {
            $path = "../admin/uploads/berita/" . $berita['gambar_utama'];
            if (file_exists($path)) {
                unlink($path); // Hapus file
            }
        }

        // 3. Hapus data dari database
        // (Kita perlu tambah fungsi delete di Model nanti, sementara pakai query manual di sini utk simpel)
        // Tapi sebaiknya di Model. Mari kita buat query langsung disini untuk Model Database.
        // Note: Idealnya tambahkan fungsi delete($id) di BeritaModel.php
        global $koneksi; // Ambil koneksi dari Database.php via Model
        $sql = "DELETE FROM berita_artikel WHERE id_berita = $id";
        $beritaModel->query($sql);

        // Redirect kembali ke daftar
        header("Location: berita.php");
    }
    
    // Fungsi Tambah & Edit akan kita buat di langkah selanjutnya
    public function tambah() {
        echo "Halaman Tambah (Segera Hadir)";
    }
    public function simpan() {}
    public function edit($id) { echo "Halaman Edit (Segera Hadir)"; }
    public function update($id) {}
}
?>