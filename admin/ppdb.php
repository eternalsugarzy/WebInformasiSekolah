<?php
session_start();

require_once '../controllers/AdminPPDBController.php';

$controller = new AdminPPDBController();

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

switch ($aksi) {
    case 'tambah':
        $controller->tambah();
        break;
    case 'simpan':
        $controller->simpan();
        break;
    case 'edit': // [BARU]
        $controller->edit($_GET['id']);
        break;
    case 'update': // [BARU]
        $controller->update($_POST['id_info']);
        break;
    case 'hapus':
        $controller->hapus($_GET['id']);
        break;
    default:
        $controller->index();
        break;
}
?>