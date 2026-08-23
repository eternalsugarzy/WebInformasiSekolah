<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

require_once '../controllers/AdminNotifikasiController.php';
$controller = new AdminNotifikasiController();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// 1. Logika (jalankan sebelum template dimuat agar redirect header tidak error)
if ($aksi == 'kirim') {
    $controller->kirimSatu();
    exit;
} elseif ($aksi == 'kirim_semua') {
    $controller->kirimSemua();
    exit;
}

// 2. Tampilan (Template)
$title = "Notifikasi Email Kelulusan";
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <?php $controller->index(); ?>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>