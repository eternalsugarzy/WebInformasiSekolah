<?php
session_start();

// 1. Keamanan: Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

// 2. Load Controller
require_once '../controllers/AdminInputNilaiController.php';
$controller = new AdminInputNilaiController();

// 3. Tangkap Aksi
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

/**
 * --- LOGIKA PEMROSESAN (SEBELUM OUTPUT HTML) ---
 * Jika ada aksi yang memproses data, jalankan sekarang 
 * agar header() redirect tidak error karena output HTML belum terkirim.
 */
if ($aksi == 'simpan') {
    $controller->simpan();
    exit; // Berhenti di sini setelah proses simpan dan redirect
}

/**
 * --- TAMPILAN (HANYA DILAKUKAN JIKA TIDAK ADA AKSI SIMPAN) ---
 */
$title = "Input Nilai SAW";
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <?php
        // Jalankan fungsi index untuk menampilkan view input nilai
        $controller->index();
        ?>
    </div>
</div>
<?php 
// Load Footer
require_once '../views/admin/template/footer.php'; 
?>