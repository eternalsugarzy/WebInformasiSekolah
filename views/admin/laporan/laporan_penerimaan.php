<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-pie-chart"></i> Laporan Penerimaan Peserta Didik Baru</h4>
            <hr>
            <p>Laporan ini merekapitulasi <b>total penerimaan</b> siswa baru: jumlah pendaftar dibanding jumlah diterima dan tidak diterima,
                <b>persentase penerimaan</b> (<i>acceptance rate</i>) per jalur dan per gelombang, <b>sebaran</b> pendaftar berdasarkan jenis kelamin,
                asal sekolah, dan kecamatan, serta <b>perbandingan dengan kuota</b> tiap jalur (terpenuhi atau masih tersisa).</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Bedanya dengan <b>Rekap Jalur Seleksi</b>: Rekap Jalur hanya menghitung jumlah pendaftar per jalur per status.
                Laporan Penerimaan menambahkan persentase penerimaan, pemenuhan kuota, rekap per gelombang, dan sebaran pendaftar.
                Tersedia filter tahun ajaran, jalur, dan gelombang, grafik, serta cetak PDF dan ekspor Excel.
            </div>

            <a href="laporan_penerimaan.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-pie-chart"></i> Buka Laporan Penerimaan
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
