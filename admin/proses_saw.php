<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

require_once '../controllers/AdminSawController.php';
$controller = new AdminSawController();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// 1. Logika (Jalankan aksi sebelum template dimuat untuk menghindari error header)
if ($aksi == 'jalankan') {
    $controller->jalankan();
    exit;
}

// 2. Tampilan (Template)
$title = "Proses Seleksi SAW";
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <?php 
        // 3. Tampilkan View
        $controller->index(); 
        ?>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>