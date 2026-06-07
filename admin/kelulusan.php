<?php
session_start();
require_once '../controllers/AdminKelulusanController.php'; // Sesuaikan path-nya
$controller = new AdminKelulusanController();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// Proses simpan kuota
if ($aksi == 'simpan') {
    $controller->prosesSimpan();
}

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