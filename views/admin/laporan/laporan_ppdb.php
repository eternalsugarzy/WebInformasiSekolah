<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Informasi PPDB</h4>
            <hr>
            <p>Halaman ini digunakan untuk mencetak Brosur/Lembar Informasi PPDB yang sedang aktif.</p>
            
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Dokumen ini berisi jadwal, persyaratan, dan alur pendaftaran yang telah diinput.
            </div>

            <a href="cetak_ppdb.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Brosur PPDB
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>