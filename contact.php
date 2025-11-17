<?php
session_start();

// Panggil Controller Kontak
require_once 'controllers/ContactController.php';

$controller = new ContactController();
$controller->index();
?>