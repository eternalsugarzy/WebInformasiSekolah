<?php
session_start();
require_once '../controllers/AdminGelombangController.php';

$controller = new AdminGelombangController();
$aksi = $_GET['aksi'] ?? 'index';

switch ($aksi) {
    case 'simpan':
        $controller->simpan();
        break;
    case 'hapus':
        $controller->hapus();
        break;
    default:
        $controller->index();
        break;
}
