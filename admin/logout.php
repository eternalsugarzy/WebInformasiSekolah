<?php
session_start();

// Kita panggil Controller Login untuk menangani proses logout
// (Naik satu level '../' untuk keluar dari folder admin)
require_once '../controllers/LoginController.php';

$controller = new LoginController();
$controller->logout();
?>