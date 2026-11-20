<?php
session_start();
require_once '../controllers/AdminPrestasiController.php';

$controller = new AdminPrestasiController();
$aksi = $_GET['aksi'] ?? 'index';

switch ($aksi) {
    case 'tambah':
        $controller->form();
        break;
    case 'edit':
        $controller->form(intval($_GET['id'] ?? 0));
        break;
    case 'simpan':
        $controller->simpan();
        break;
    case 'update':
        $controller->update();
        break;
    case 'verifikasi':
        $controller->verifikasi();
        break;
    case 'hapus':
        $controller->hapus();
        break;
    default:
        $controller->index();
        break;
}
