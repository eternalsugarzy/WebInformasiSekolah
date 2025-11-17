<?php
session_start();

// Panggil Controller Login
// Kita perlu naik satu level ('../') dari folder 'admin' untuk masuk ke 'controllers'
require_once '../controllers/LoginController.php';

$controller = new LoginController();
$controller->index();
?>