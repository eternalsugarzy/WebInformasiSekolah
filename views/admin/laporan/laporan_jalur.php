<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Rekapitulasi Pendaftar per Jalur Seleksi</h4>
            <hr>
            <p>Laporan ini merangkum jumlah pendaftar PPDB berdasarkan jalur seleksi (Zonasi, Afirmasi, Prestasi), dipecah per status seleksi (Menunggu, Diterima, Cadangan, Ditolak). Berguna untuk melihat distribusi calon siswa antar jalur.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Laporan menampilkan data tahun ajaran berjalan (<?php echo date('Y'); ?>).
            </div>

            <a href="cetak_jalur.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Laporan Rekap Jalur Seleksi
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>