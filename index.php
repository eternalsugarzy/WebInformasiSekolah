<?php
// index.php (File utama di root folder)

session_start();

// Untuk saat ini, kita hanya punya satu halaman,
// jadi kita panggil HomeController secara langsung.
require_once 'controllers/HomeController.php';

// Membuat objek Controller
$controller = new HomeController();
// Menjalankan fungsi 'index' di dalam Controller
$controller->index();
?>