<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>
<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Inventaris Dokumentasi</h4>
            <hr>
            <p>Cetak laporan daftar kegiatan yang telah didokumentasikan (Album Foto).</p>
            <a href="cetak_galeri.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-image-o"></i> Cetak Laporan Galeri
            </a>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>