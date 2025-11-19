<?php
session_start();

// Panggil Controller Galeri
require_once 'controllers/GaleriController.php';

$controller = new GaleriController();

// Pastikan ada ID di URL (contoh: detail_galeri.php?id=1)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $controller->detail($_GET['id']);
} else {
    // Jika tidak ada ID, kembalikan ke halaman galeri utama
    header("Location: galeri.php");
    exit;
}
?>