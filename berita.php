<?php
session_start();

// Panggil Controller Berita
require_once 'controllers/BeritaController.php';

$controller = new BeritaController();
$controller->index();
?>