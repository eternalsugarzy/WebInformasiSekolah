<?php
session_start();
require_once 'controllers/PencarianController.php';
$controller = new PencarianController();
$controller->index();
?>