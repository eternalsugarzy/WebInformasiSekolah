<?php
session_start();

// Panggil Controller Admin Berita
// (Naik satu level dari folder admin ke controllers)
require_once '../controllers/AdminBeritaController.php';

$controller = new AdminBeritaController();

// Cek parameter 'aksi' di URL (contoh: admin/berita.php?aksi=tambah)
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
        $controller->update($_POST['id_berita']);
        break;
    case 'hapus':
        $controller->hapus($_GET['id']);
        break;
    default:
        $controller->index(); // Tampilkan daftar berita
        break;
}
?>