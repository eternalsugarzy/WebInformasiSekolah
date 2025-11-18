<?php
session_start();

// Panggil Koneksi Database
require_once 'Koneksi Database/koneksi.php'; 

// PERBAIKAN KRUSIAL DI BARIS INI:
// Hapus forward slash (/) di awal 'controllers/...'
// Dari: __DIR__ . '/controllers/DetailGaleriController.php'
// Menjadi:
require_once __DIR__ . '/controllers/DetailGaleriController.php'; 

$controller = new DetailGaleriController();
$controller->index();
?>