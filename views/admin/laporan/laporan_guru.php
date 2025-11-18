<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>
<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Data Guru</h4>
            <hr>
            <p>Silakan klik tombol di bawah untuk mencetak seluruh data Guru & Staf pengajar.</p>
            <a href="cetak_guru.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Laporan Guru
            </a>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>