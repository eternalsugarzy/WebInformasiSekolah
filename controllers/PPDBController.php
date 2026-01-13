<?php
require_once __DIR__ . '/../models/PPDBModel.php'; 

class PPDBController {

    public function index() {
        $ppdbModel = new PPDBModel();
        
        // --- DEFAULT VARIABLES ---
        $title = "Penerimaan Peserta Didik Baru - SMA Frater Don Bosco Bjm";
        
        // Mode default adalah 'cek_status' (Tampilan Pencarian)
        // Jika user klik tombol daftar, mode berubah jadi 'form_daftar'
        $mode = 'cek_status'; 
        
        $hasil_cari = [];
        $keyword = "";
        $success_msg = "";
        $error_msg = "";

        // ============================================================
        // LOGIKA 1: JIKA USER MEMBUKA HALAMAN FORMULIR PENDAFTARAN
        // ============================================================
        if (isset($_GET['halaman']) && $_GET['halaman'] == 'daftar') {
            
            $mode = 'form_daftar'; // Ubah mode ke Formulir
            $title = "Formulir Pendaftaran Siswa Baru";

            // --- SUB-LOGIKA: PROSES SIMPAN DATA (METHOD POST) ---
            // (Kode ini hanya jalan jika user sedang di halaman daftar DAN klik submit)
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // 1. Logika Upload Foto (Dari kode Anda)
                $foto_name = "";
                if (isset($_FILES['foto_siswa']) && $_FILES['foto_siswa']['error'] == 0) {
                    $target_dir = "admin/uploads/peserta/";
                    
                    if (!file_exists($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }

                    $file_ext = strtolower(pathinfo($_FILES["foto_siswa"]["name"], PATHINFO_EXTENSION));
                    // Nama file unik: NAMA_NISN.jpg
                    $clean_nama = preg_replace('/[^A-Za-z0-9]/', '', $_POST['nama_lengkap']);
                    $new_name = $clean_nama . "_" . $_POST['nisn'] . "." . $file_ext;
                    $target_file = $target_dir . $new_name;

                    // Validasi ekstensi
                    $allowed = array('jpg', 'jpeg', 'png');
                    if (in_array($file_ext, $allowed)) {
                        if (move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file)) {
                            $foto_name = $new_name;
                        } else {
                            $error_msg = "Gagal mengupload foto.";
                        }
                    } else {
                        $error_msg = "Format foto harus JPG atau PNG.";
                    }
                }

                // 2. Simpan ke Database
                if (empty($error_msg)) {
                    $_POST['foto_siswa'] = $foto_name;

                    if ($ppdbModel->tambahPendaftar($_POST)) {
                        // Redirect ke halaman utama agar user bisa langsung cek status
                        echo "<script>alert('Selamat! Pendaftaran Berhasil. Silakan Cek Status Anda.'); window.location.href='ppdb.php';</script>";
                        exit;
                    } else {
                        $error_msg = "Gagal menyimpan data ke database.";
                    }
                }
            }
        }

        // ============================================================
        // LOGIKA 2: JIKA USER MELAKUKAN PENCARIAN STATUS (GET 'q')
        // ============================================================
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $keyword = $_GET['q'];
            // Panggil fungsi pencarian di Model
            $hasil_cari = $ppdbModel->cekStatusSiswa($keyword);
        }

        // ============================================================
        // LOAD VIEW
        // ============================================================
        // Variabel $mode, $hasil_cari, $keyword akan dikirim ke view
        require_once __DIR__ . '/../views/template/header.php';
        require_once __DIR__ . '/../views/ppdb.php'; 
        require_once __DIR__ . '/../views/template/footer.php';
    }
}
?>