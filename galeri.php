<?php
session_start();

// Panggil Controller Galeri
require_once 'controllers/GaleriController.php';

$controller = new GaleriController();
$controller->index();
?>