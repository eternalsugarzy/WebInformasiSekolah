<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-bar-chart"></i> Laporan Statistik Nilai Rata-Rata Pendaftar</h4>
            <hr>
            <p>Laporan ini menampilkan rata-rata nilai per kriteria (Raport, Tes, Prestasi, Jarak Rumah), sebaran nilai akhir SAW, dan tren rata-rata nilai dari tahun ke tahun dalam bentuk grafik. Berguna untuk membantu pihak sekolah mengevaluasi kualitas input siswa baru dari tahun ke tahun.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Data yang ditampilkan diambil dari nilai pendaftar yang sudah diinput di menu <b>Input Nilai SAW</b>.
            </div>

            <a href="statistik_nilai.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-bar-chart"></i> Lihat Laporan Statistik Nilai
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>