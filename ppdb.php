<?php
session_start();

// Panggil Controller PPDB
require_once 'controllers/PPDBController.php';

$controller = new PPDBController();
$controller->index();
?>