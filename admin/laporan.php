<?php
session_start();
require_once '../controllers/AdminLaporanController.php';

$controller = new AdminLaporanController();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

switch ($aksi) {
    case 'guru':
        $controller->pageGuru();
        break;
    case 'berita':
        $controller->pageBerita();
        break;
    case 'ppdb':
        $controller->pagePPDB();
        break;
    // [TAMBAHAN BARU]
    case 'pengumuman':
        $controller->pagePengumuman();
        break;
    case 'galeri':
        $controller->pageGaleri();
        break;
    // [AKHIR TAMBAHAN]
    default:
        header("Location: index.php");
        break;
}
?>