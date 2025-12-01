<?php
require_once __DIR__ . '/../models/GuruModel.php'; 

class DetailGuruController {
    // Tetapkan 10 guru per halaman untuk pagination
    private $guru_per_halaman = 10; 

    public function index() {
        $guruModel = new GuruModel();
        
        // 1. Ambil parameter Halaman dan Keyword Pencarian
        $keyword = isset($_GET['cari']) ? trim($_GET['cari']) : null;
        $halaman_aktif = isset($_GET['halaman']) ? intval($_GET['halaman']) : 1;
        
        // Pastikan halaman aktif minimal 1
        if ($halaman_aktif < 1) {
            $halaman_aktif = 1;
        }

        // 2. Hitung Total Data dan Total Halaman (Perlu fungsi countAllGuru di GuruModel.php)
        $total_guru = $guruModel->countAllGuru($keyword); 
        $total_halaman = ceil($total_guru / $this->guru_per_halaman);
        
        // Jika halaman aktif melebihi total halaman, kembalikan ke halaman terakhir
        if ($halaman_aktif > $total_halaman && $total_halaman > 0) {
            $halaman_aktif = $total_halaman;
        }
        
        // 3. Hitung Offset dan Ambil Data
        $offset = ($halaman_aktif - 1) * $this->guru_per_halaman;
        
        // Panggil fungsi Model untuk mengambil data per halaman
        $data_guru = $guruModel->getGuruByPage($this->guru_per_halaman, $offset, $keyword);
        
        // 4. Siapkan Variabel untuk View
        $title = "Direktori Lengkap Guru dan Staf - SMA Frater Don Bosco Bjm"; 
        $current_keyword = $keyword;
        
        // Data Pagination yang akan dikirim ke View
        $data_pagination = [
            'total_halaman' => $total_halaman,
            'halaman_aktif' => $halaman_aktif
        ];

        require_once __DIR__ . '/../views/template/header.php';
        // Menggunakan views/detail_guru.php sesuai permintaan Anda
        require_once __DIR__ . '/../views/detail_guru.php'; 
        require_once __DIR__ . '/../views/template/footer.php';
    }
}