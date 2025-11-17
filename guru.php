<?php
session_start();

// Panggil Controller Guru
require_once 'controllers/GuruController.php';

$controller = new GuruController();
$controller->index();
?>