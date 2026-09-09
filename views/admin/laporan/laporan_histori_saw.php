<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-history"></i> Histori Perubahan Seleksi SAW</h4>
            <hr>
            <p>Setiap kali bobot kriteria SAW, nilai pendaftar, kuota kelulusan, atau status kelulusan diubah manual (mis. saat sidang kelulusan), sistem mencatat siapa yang mengubah, kapan, dan nilai sebelum &amp; sesudahnya. Gunakan laporan ini untuk menelusuri perubahan tersebut.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Halaman ini menampilkan daftar lengkap di layar (bisa difilter jenis &amp; tanggal), dan bisa langsung dicetak/disimpan sebagai PDF.
            </div>

            <a href="histori_saw.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="fa fa-history"></i> Buka Histori Perubahan Seleksi SAW
            </a>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
