<?php
class DashboardController {

    public function index() {
        // 1. Cek Sesi Login
        // Jika session 'user_admin' belum ada, berarti belum login
        if (!isset($_SESSION['user_admin'])) {
            header("Location: login.php");
            exit;
        }

        // 2. Siapkan Data untuk View
        $title = "Dashboard Admin - SMA Maju Jaya";
        $nama_admin = $_SESSION['admin_nama'];

        // 3. Panggil View Dashboard
        // Kita akan membuat layout admin yang sedikit berbeda dari frontend
        require_once '../views/admin/dashboard.php';
    }
}
?>