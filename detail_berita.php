<?php
session_start();

// Panggil Controller Detail Berita
require_once 'controllers/DetailBeritaController.php';

$controller = new DetailBeritaController();
$controller->index();
?>