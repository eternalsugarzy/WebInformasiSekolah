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
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_POST['id_album']);
        break;
    case 'hapus':
        $controller->hapus($_GET['id']);
        break;
    // [BARU] Hapus Foto Satuan dari halaman Edit
    case 'hapus_foto':
        $controller->hapus_foto($_GET['id_foto'], $_GET['id_album']);
        break;
    default:
        $controller->index();
        break;
}
?>