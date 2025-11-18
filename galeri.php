<?php
session_start();

// Panggil Controller Galeri
require_once 'controllers/GaleriController.php';

$controller = new GaleriController(); // <-- Baris 7 (tempat error terjadi)
$controller->index();
?>