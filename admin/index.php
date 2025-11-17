<?php
session_start();

// Panggil Dashboard Controller
// (Naik satu level dari folder admin ke controllers)
require_once '../controllers/DashboardController.php';

$controller = new DashboardController();
$controller->index();
?>