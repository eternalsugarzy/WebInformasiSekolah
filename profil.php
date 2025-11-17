<?php
session_start();

// Panggil Controller Profil
require_once 'controllers/ProfilController.php';

$controller = new ProfilController();
$controller->index();
?>