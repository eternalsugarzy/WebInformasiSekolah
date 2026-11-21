<?php
session_start();

require_once 'controllers/PrestasiController.php';

$controller = new PrestasiController();
$controller->index();
