<?php
session_start();

// Panggil Controller
require_once '../controllers/AdminPPDBController.php';

// Inisialisasi Controller
$controller = new AdminPPDBController();

// Tentukan Aksi
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

switch ($aksi) {
    case 'tambah': // [BARU] Tampilkan Form Tambah
        $controller->tambahPendaftar();
        break;

    case 'simpan': // [BARU] Proses Simpan Data
        $controller->simpanPendaftar();
        break;

    case 'hapus':
        $controller->hapusPendaftar($_GET['id']);
        break;
        
    case 'update_status':
        $controller->updateStatusPendaftar();
        break;

    case 'detail':
        $controller->detailPendaftar($_GET['id']);
        break;

    default: // 'index'
        $controller->indexPendaftar();
        break;
}
?>