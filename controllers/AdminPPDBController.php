<?php
require_once __DIR__ . '/../models/PPDBModel.php';

class AdminPPDBController {

    public function __construct() {
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function index() {
        $model = new PPDBModel();
        $data_ppdb = $model->getAllPPDB();
        
        $title = "Kelola Info PPDB";
        $nama_admin = $_SESSION['admin_nama'];

        require_once '../views/admin/ppdb_index.php';
    }

    public function tambah() {
        $title = "Tambah Info PPDB";
        require_once '../views/admin/ppdb_tambah.php';
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_akhir = $_POST['tgl_akhir'];
            $link = mysqli_real_escape_string($koneksi, $_POST['link']);

            $sql = "INSERT INTO info_ppdb (jenis_informasi, isi_detail, tanggal_mulai, tanggal_akhir, tautan_formulir) 
                    VALUES ('$jenis', '$isi', '$tgl_mulai', '$tgl_akhir', '$link')";
            
            if(mysqli_query($koneksi, $sql)) {
                header("Location: ppdb.php");
            } else {
                echo "Gagal menyimpan: " . mysqli_error($koneksi);
            }
        }
    }

    public function hapus($id) {
        $model = new PPDBModel();
        $model->hapusPPDB($id);
        header("Location: ppdb.php");
    }

    // --- EDIT: Tampilkan Form ---
    public function edit($id) {
        $model = new PPDBModel();
        $ppdb = $model->getPPDBById($id);
        
        if (!$ppdb) { echo "Data tidak ditemukan"; exit; }

        $title = "Edit Info PPDB";
        $nama_admin = $_SESSION['admin_nama'];
        require_once '../views/admin/ppdb_edit.php';
    }

    // --- UPDATE: Simpan Perubahan ---
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $koneksi;

            $id = $_POST['id_info'];
            $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
            $isi = mysqli_real_escape_string($koneksi, $_POST['isi']);
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_akhir = $_POST['tgl_akhir'];
            $link = mysqli_real_escape_string($koneksi, $_POST['link']);

            $model = new PPDBModel();
            $model->updatePPDB($id, $jenis, $isi, $tgl_mulai, $tgl_akhir, $link);
            
            header("Location: ppdb.php");
        }
    }
}
?>