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

    // --- READ: Menampilkan Halaman Daftar Berita ---
    public function index() {
        $beritaModel = new BeritaModel();
        $data_berita = $beritaModel->getAllBerita();
        
        $title = "Kelola Berita - Admin";
        $nama_admin = $_SESSION['admin_nama']; // Untuk ditampilkan di header

        require_once '../views/admin/berita_index.php';
    }

    // --- CREATE: Menampilkan Form Tambah ---
    public function tambah() {
        $title = "Tambah Berita Baru";
        require_once '../views/admin/berita_tambah.php';
    }

    // --- CREATE: Proses Simpan Data Baru ---
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi; // Mengambil koneksi database global

            // Ambil & Amankan Input
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $kategori = $_POST['kategori'];
            $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
            $tanggal = $_POST['tanggal'] . ' ' . date('H:i:s'); // Tambahkan jam saat ini
            $penulis = $_SESSION['admin_nama']; // Penulis otomatis sesuai akun login
            
            // Proses Upload Gambar
            $nama_gambar = ""; // Default kosong jika tidak ada gambar
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                $target_dir = "uploads/berita/";
                
                // Buat folder jika belum ada
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
                // Rename file agar unik (timestamp + angka acak)
                $nama_gambar = time() . '_' . rand(100, 999) . '.' . $file_extension;
                $target_file = $target_dir . $nama_gambar;

                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            }

            // Simpan ke Database
            $sql = "INSERT INTO berita_artikel (judul, konten_lengkap, tanggal_publikasi, penulis, kategori, gambar_utama) 
                    VALUES ('$judul', '$konten', '$tanggal', '$penulis', '$kategori', '$nama_gambar')";
            
            if (mysqli_query($koneksi, $sql)) {
                header("Location: berita.php"); // Sukses, kembali ke daftar
            } else {
                echo "Gagal menyimpan: " . mysqli_error($koneksi);
            }
        }
    }

    // --- UPDATE: Menampilkan Form Edit ---
    public function edit($id) {
        $beritaModel = new BeritaModel();
        $berita = $beritaModel->getBeritaById($id); // Ambil data lama berdasarkan ID

        if (!$berita) {
            echo "Data tidak ditemukan!";
            exit;
        }

        $title = "Edit Berita";
        require_once '../views/admin/berita_edit.php';
    }

    // --- UPDATE: Proses Simpan Perubahan ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;
            
            // Ambil data dari form edit
            $id = $_POST['id_berita']; 
            $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
            $kategori = $_POST['kategori'];
            $konten = mysqli_real_escape_string($koneksi, $_POST['konten']);
            
            // Siapkan variabel gambar (default null artinya tidak ganti gambar)
            $nama_gambar = null;
            
            // Cek apakah ada file gambar baru yang diupload?
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
                // 1. Upload gambar baru
                $target_dir = "uploads/berita/";
                $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
                $nama_gambar = time() . '_' . rand(100, 999) . '.' . $file_extension;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_dir . $nama_gambar);

                // 2. Hapus gambar lama (agar server tidak penuh)
                $beritaModel = new BeritaModel();
                $dataLama = $beritaModel->getBeritaById($id);
                if ($dataLama && !empty($dataLama['gambar_utama'])) {
                    $pathLama = "uploads/berita/" . $dataLama['gambar_utama'];
                    if (file_exists($pathLama)) {
                        unlink($pathLama);
                    }
                }
            }

            // Panggil Model untuk melakukan UPDATE di database
            $beritaModel = new BeritaModel();
            $beritaModel->updateBerita($id, $judul, $konten, $kategori, $nama_gambar);

            // Kembali ke halaman daftar berita
            header("Location: berita.php");
        }
    }

    // --- DELETE: Menghapus Berita ---
    public function hapus($id) {
        $beritaModel = new BeritaModel();
        
        // 1. Ambil data dulu untuk mendapatkan nama filenya
        $berita = $beritaModel->getBeritaById($id);
        
        // 2. Hapus File Gambar Fisik (jika ada)
        if ($berita && !empty($berita['gambar_utama'])) {
            $path = "uploads/berita/" . $berita['gambar_utama'];
            if (file_exists($path)) {
                unlink($path); // Hapus file dari folder
            }
        }

        // 3. Hapus Data dari Database
        global $koneksi;
        $sql = "DELETE FROM berita_artikel WHERE id_berita = $id";
        mysqli_query($koneksi, $sql);

        header("Location: berita.php");
    }
}
?>