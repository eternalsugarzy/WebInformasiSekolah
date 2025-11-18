<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>
<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Arsip Pengumuman Sekolah</h4>
            <hr>
            <p>Cetak daftar seluruh pengumuman (Aktif & Arsip) sebagai laporan administrasi.</p>
            <a href="cetak_pengumuman.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Arsip Pengumuman
            </a>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>