<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Rincian Perhitungan SAW</h4>
            <hr>
            <p>Laporan ini menampilkan matriks keputusan (nilai asli), hasil normalisasi, nilai terbobot, hingga nilai akhir (Vi) dan peringkat untuk setiap pendaftar PPDB. Berguna sebagai dokumen transparansi jika ada wali murid yang menanyakan dasar penentuan kelulusan.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Pastikan proses seleksi SAW sudah dijalankan di menu <b>Proses Seleksi SAW</b> agar nilai akhir &amp; peringkat yang tercetak adalah data terbaru.
            </div>

            <a href="cetak_saw.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-file-pdf-o"></i> Cetak Rincian Perhitungan SAW
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>