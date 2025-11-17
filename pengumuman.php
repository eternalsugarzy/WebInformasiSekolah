<?php
session_start();

// Panggil Controller Pengumuman
require_once 'controllers/PengumumanController.php';

$controller = new PengumumanController();
$controller->index();
?>