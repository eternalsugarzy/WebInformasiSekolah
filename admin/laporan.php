<?php
// admin/laporan.php (Router untuk semua aksi laporan)

session_start();

// 1. Perbaiki path ke Controller (Diasumsikan controllers berada di folder 'controllers' di root)
require_once '../controllers/AdminLaporanController.php'; 


$controller = new AdminLaporanController();
$action = $_GET['action'] ?? 'index'; // Ambil aksi dari URL, default ke index

// --- Routing Logic ---
switch ($action) {
    case 'index':
        // Memuat daftar 5 tautan laporan
        $controller->index();
        break;
        
    case 'pageBerita':
        // Memuat form filter laporan berita
        $controller->pageBerita();
        break;
        
    case 'pageGuru':
        // Memuat form filter laporan guru
        $controller->pageGuru();
        break;
        
    case 'pagePPDB':
        $controller->pagePPDB();
        break;
        
    case 'pagePengumuman':
        $controller->pagePengumuman();
        break;
        
    case 'pageGaleri':
        $controller->pageGaleri();
        break;

    case 'pageSaw':
        $controller->pageSaw();
        break;

    case 'pageStatistikNilai':
        $controller->pageStatistikNilai();
        break;

    case 'pageJalur':
        $controller->pageJalur();
        break;
        
    default:
        // Handle 404 atau kembali ke index
        $controller->index();
        break;
}


?>