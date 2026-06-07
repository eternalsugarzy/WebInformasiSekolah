<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

// 1. Load Controller
require_once '../controllers/AdminBobotController.php';
$controller = new AdminBobotController();

// 2. Load Template Bagian Atas
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <?php
        // 3. Router Logic (Arahkan aksi ke controller)
        $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

        switch ($aksi) {
            case 'update':
                $controller->update();
                break;
            default:
                $controller->index();
                break;
        }
        ?>
    </div>
</div>

<?php 
// 4. Load Footer
require_once '../views/admin/template/footer.php'; 
?>