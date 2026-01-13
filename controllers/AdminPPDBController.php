<?php
require_once __DIR__ . '/../models/PPDBModel.php';

class AdminPPDBController {

    public function __construct() {
        // Cek Login Session
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    // ==========================================================
    // BAGIAN 1: KELOLA INFO PPDB (TEXT & JADWAL)
    // ==========================================================

    public function index() {
        $model = new PPDBModel();
        // Pastikan method getAllPPDBInfo() atau getAllPPDB() ada di model
        // Saya sesuaikan dengan nama umum di model sebelumnya
        if(method_exists($model, 'getAllPPDBInfo')) {
            $data_ppdb = $model->getAllPPDBInfo();
        } else {
            $data_ppdb = $model->getAllPPDB(); 
        }
        
        $title = "Kelola Info PPDB";
        // Cek variable session agar tidak error undefined
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';

        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/ppdb_index.php'; // View lama (Info)
        require_once '../views/admin/template/footer.php';
    }

    public function tambah() {
        $title = "Tambah Info PPDB";
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';
        
        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/ppdb_tambah.php';
        require_once '../views/admin/template/footer.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi; // Mengambil koneksi dari config global

            $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_akhir = $_POST['tgl_akhir'];
            $link = mysqli_real_escape_string($koneksi, $_POST['link']);

            // Idealnya query ini dipindah ke Model, tapi saya biarkan agar jalan dulu
            $sql = "INSERT INTO info_ppdb (jenis_informasi, isi_detail, tanggal_mulai, tanggal_akhir, tautan_formulir) 
                    VALUES ('$jenis', '$isi', '$tgl_mulai', '$tgl_akhir', '$link')";
            
            if(mysqli_query($koneksi, $sql)) {
                echo "<script>alert('Info Berhasil Ditambahkan'); window.location='ppdb.php';</script>";
            } else {
                echo "Gagal menyimpan: " . mysqli_error($koneksi);
            }
        }
    }

    public function edit($id) {
        $model = new PPDBModel();
        
        // Cek method di model (sesuaikan dengan yang ada di model Anda)
        if(method_exists($model, 'getPPDBById')) {
            $ppdb = $model->getPPDBById($id);
        } else {
            // Fallback jika nama method beda
            $ppdb = $model->getOnePPDB($id);
        }
        
        if (!$ppdb) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Info PPDB";
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';
        
        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/ppdb_edit.php';
        require_once '../views/admin/template/footer.php';
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $id_info = $_POST['id_info'];
            $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_akhir = $_POST['tgl_akhir'];
            $link = mysqli_real_escape_string($koneksi, $_POST['link']);

            $model = new PPDBModel();
            // Pastikan method ini ada di Model Anda
            $model->updatePPDB($id_info, $jenis, $isi, $tgl_mulai, $tgl_akhir, $link);
            
            echo "<script>alert('Info Berhasil Diupdate'); window.location='ppdb.php';</script>";
        }
    }

    public function hapus($id) {
        $model = new PPDBModel();
        $model->hapusPPDB($id);
        echo "<script>alert('Data Berhasil Dihapus'); window.location='ppdb.php';</script>";
    }


    // ==========================================================
    // BAGIAN 2: KELOLA DATA PENDAFTAR (SISWA BARU)
    // ==========================================================
    // Bagian inilah yang menyebabkan Error "Undefined Method" sebelumnya

    public function indexPendaftar() {
        $ppdbModel = new PPDBModel();
        
        // 1. Tangkap Filter dari URL (GET)
        $filters = [
            'provinsi'  => isset($_GET['provinsi']) ? $_GET['provinsi'] : '',
            'kabupaten' => isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '',
            'keyword'   => isset($_GET['q']) ? $_GET['q'] : ''
        ];

        // 2. Ambil Data dengan Filter
        $data_pendaftar = $ppdbModel->getAllPendaftar($filters); 
        
        // 3. Ambil Data untuk Dropdown Filter
        $list_provinsi = $ppdbModel->getListProvinsi();
        $list_kabupaten = $ppdbModel->getListKabupaten();

        $title = "Data Pendaftar PPDB";
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';
        
        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/pendaftar_ppdb.php'; 
        require_once '../views/admin/template/footer.php';
    }

    public function detailPendaftar($id) {
        $ppdbModel = new PPDBModel();
        $siswa = $ppdbModel->getPendaftarById($id); 
        
        // Setup variabel agar dikenali di View
        $aksi = 'detail'; 

        $title = "Detail Pendaftar: " . (isset($siswa['nama_lengkap']) ? $siswa['nama_lengkap'] : 'Siswa');
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';
        
        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/pendaftar_ppdb.php'; 
        require_once '../views/admin/template/footer.php';
    }

    public function updateStatusPendaftar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ppdbModel = new PPDBModel();
            $id = $_POST['id_pendaftar'];
            $status = $_POST['status_seleksi'];
            
            if ($ppdbModel->updateStatus($id, $status)) {
                echo "<script>alert('Status berhasil diubah!'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
            } else {
                echo "<script>alert('Gagal mengubah status'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
            }
        }
    }

    public function hapusPendaftar($id) {
        $ppdbModel = new PPDBModel();
        if ($ppdbModel->hapusPendaftar($id)) {
            echo "<script>alert('Data pendaftar berhasil dihapus'); window.location='pendaftar_ppdb.php';</script>";
        }
    }

    // --- FITUR TAMBAH DATA MANUAL (ADMIN) ---

    public function tambahPendaftar() {
        $title = "Tambah Pendaftar Baru";
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Admin';
        $aksi = 'tambah'; // Penanda untuk View

        require_once '../views/admin/template/header.php';
        require_once '../views/admin/template/sidebar.php';
        require_once '../views/admin/pendaftar_ppdb.php'; // Kita pakai view yang sama
        require_once '../views/admin/template/footer.php';
    }

    public function simpanPendaftar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ppdbModel = new PPDBModel();
            
            // Logika Upload Foto
            $foto_name = "";
            if (isset($_FILES['foto_siswa']) && $_FILES['foto_siswa']['error'] == 0) {
                // Folder upload harus ada di admin/uploads/peserta/
                $target_dir = "../admin/uploads/peserta/";
                
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $file_ext = strtolower(pathinfo($_FILES["foto_siswa"]["name"], PATHINFO_EXTENSION));
                // Nama file: NAMA_NISN.jpg
                $clean_nama = preg_replace('/[^A-Za-z0-9]/', '', $_POST['nama_lengkap']);
                $new_name = $clean_nama . "_" . $_POST['nisn'] . "." . $file_ext;
                $target_file = $target_dir . $new_name;

                $allowed = array('jpg', 'jpeg', 'png');
                if (in_array($file_ext, $allowed)) {
                    if (move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file)) {
                        $foto_name = $new_name;
                    }
                }
            }

            // Masukkan nama file ke array data
            $_POST['foto_siswa'] = $foto_name;

            // Panggil Model (Method tambahPendaftar yang sama dengan frontend)
            if ($ppdbModel->tambahPendaftar($_POST)) {
                echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='pendaftar_ppdb.php';</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data.'); window.location='pendaftar_ppdb.php?aksi=tambah';</script>";
            }
        }
    }
}
?>