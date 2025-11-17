<?php
session_start();

require_once '../controllers/AdminGaleriController.php';

$controller = new AdminGaleriController();

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
        $controller->update($_POST['id_album']);
        break;
    case 'hapus':
        $controller->hapus($_GET['id']);
        break;
    default:
        $controller->index();
        break;
}
?>