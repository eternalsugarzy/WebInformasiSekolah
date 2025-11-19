<?php
require_once __DIR__ . '/../models/GaleriModel.php';

class AdminGaleriController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php"); exit;
        }
    }

    public function index() {
        $model = new GaleriModel();
        $data_galeri = $model->getAllAlbums(); // Menggunakan fungsi model baru
        
        $title = "Kelola Galeri Sekolah";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/galeri_index.php';
    }

    public function tambah() {
        $title = "Tambah Album Galeri";
        require_once '../views/admin/galeri_tambah.php';
    }

    // --- SIMPAN ALBUM BARU + BANYAK FOTO ---
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $tgl = $_POST['tanggal'];

            $model = new GaleriModel();
            
            // 1. Buat Album (Judul & Deskripsi)
            $id_album = $model->createAlbum($judul, $deskripsi, $tgl);

            if ($id_album) {
                // 2. Proses Upload Banyak File
                // Cek apakah user mengupload foto
                if (isset($_FILES['foto']['name'][0]) && !empty($_FILES['foto']['name'][0])) {
                    $total_files = count($_FILES['foto']['name']);
                    $target_dir = "uploads/galeri/";
                    
                    // Buat folder jika belum ada
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    // Loop upload per file (Maksimal 10)
                    for ($i = 0; $i < $total_files; $i++) {
                        if ($i >= 10) break; 

                        $filename = $_FILES['foto']['name'][$i];
                        $tmp_name = $_FILES['foto']['tmp_name'][$i];
                        
                        // Rename unik
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        $new_name = "album_" . $id_album . "_" . time() . "_" . $i . "." . $ext;
                        
                        if (move_uploaded_file($tmp_name, $target_dir . $new_name)) {
                            // Simpan ke tabel FOTO (galeri_fotos)
                            $model->insertFoto($id_album, $new_name);
                        }
                    }
                }
                header("Location: galeri.php");
            } else {
                echo "Gagal membuat album.";
            }
        }
    }

    // --- HALAMAN EDIT (Menampilkan Album & Daftar Fotonya) ---
    public function edit($id) {
        $model = new GaleriModel();
        $galeri = $model->getAlbumById($id); // Info Album
        $fotos = $model->getFotosByAlbumId($id); // Daftar Foto

        if (!$galeri) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Galeri";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/galeri_edit.php';
    }

    // --- UPDATE ALBUM & TAMBAH FOTO BARU ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_album = $_POST['id_album'];
            $judul = $_POST['judul'];
            $deskripsi = $_POST['deskripsi'];
            $tgl = $_POST['tanggal'];

            $model = new GaleriModel();
            
            // 1. Update Teks Album
            $model->updateGaleri($id_album, $judul, $deskripsi, $tgl, 'Foto');

            // 2. Jika ada Tambah Foto Baru (Multiple)
            if (isset($_FILES['foto']['name'][0]) && !empty($_FILES['foto']['name'][0])) {
                $total_files = count($_FILES['foto']['name']);
                $target_dir = "uploads/galeri/";

                for ($i = 0; $i < $total_files; $i++) {
                    $filename = $_FILES['foto']['name'][$i];
                    $tmp_name = $_FILES['foto']['tmp_name'][$i];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $new_name = "album_" . $id_album . "_" . time() . "_" . $i . "." . $ext;
                    
                    if (move_uploaded_file($tmp_name, $target_dir . $new_name)) {
                        $model->insertFoto($id_album, $new_name);
                    }
                }
            }
            header("Location: galeri.php?aksi=edit&id=$id_album");
        }
    }

    // --- HAPUS SATU FOTO (Fitur di halaman Edit) ---
    public function hapus_foto($id_foto, $id_album) {
        $model = new GaleriModel();
        $filename = $model->deleteFotoById($id_foto);

        // Hapus fisik file
        if ($filename) {
            $path = "uploads/galeri/" . $filename;
            if (file_exists($path)) unlink($path);
        }
        
        header("Location: galeri.php?aksi=edit&id=$id_album");
    }

    // --- HAPUS FULL ALBUM ---
    public function hapus($id) {
        $model = new GaleriModel();
        // 1. Ambil semua foto dulu untuk dihapus fisiknya
        $fotos = $model->getFotosByAlbumId($id);
        
        foreach($fotos as $f) {
            $path = "uploads/galeri/" . $f['file_foto'];
            if (file_exists($path)) unlink($path);
        }

        // 2. Hapus Album dari DB (Otomatis hapus foto di DB jika cascade, atau manual di model)
        $model->hapusGaleri($id);
        header("Location: galeri.php");
    }
}
?>