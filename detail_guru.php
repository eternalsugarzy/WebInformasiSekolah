<?php
session_start();

require_once 'Koneksi Database/koneksi.php'; 
require_once 'controllers/DetailGuruController.php';

// Cek ID dari URL. Jika tidak ada ID di URL, gunakan ID 10 (Kepala Sekolah) sebagai default.
$id = $_GET['id'] ?? 10; // MENGGANTI DEFAULT ID DARI 1 KE 10
$_GET['id'] = $id; 

$controller = new DetailGuruController();
$controller->index();
?>