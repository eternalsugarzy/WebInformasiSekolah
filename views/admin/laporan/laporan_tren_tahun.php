<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-line-chart"></i> Laporan Tren PPDB Antar Tahun</h4>
            <hr>
            <p>Laporan ini merangkum perkembangan jumlah pendaftar PPDB dari tahun ke tahun, dipecah berdasarkan hasil seleksi (Diterima, Cadangan, Ditolak). Berguna untuk melihat tren minat pendaftar dan daya tampung sekolah antar tahun ajaran.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Laporan menampilkan seluruh tahun ajaran yang tercatat di sistem, dari yang paling lama sampai paling baru.
            </div>

            <a href="cetak_tren_tahun.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Laporan Tren Antar Tahun
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
