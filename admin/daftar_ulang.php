<?php
session_start();
require_once '../controllers/AdminDaftarUlangController.php';
$controller = new AdminDaftarUlangController();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

if ($aksi == 'update') {
    $controller->update();
} elseif ($aksi == 'promosi') {
    $controller->promosiCadangan();
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
