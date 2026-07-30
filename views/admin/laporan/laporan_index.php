<?php 
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            
            <h4 class="mb-4"><i class="fa fa-print"></i> Pengaturan Filter Laporan</h4>

            <div class="row">
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_berita.php'; ?></div>
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_guru.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_ppdb.php'; ?></div>
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_pengumuman.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_galeri.php'; ?></div>
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_saw.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_statistik_nilai.php'; ?></div>
                <div class="col-md-6" style="padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;"><?php require_once 'laporan_jalur.php'; ?></div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>