<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';

// Kotak laporan: semua laporan tampil sekaligus, tersusun 2 kolom kiri-kanan
$kotak = 'padding: 15px; border: 1px solid #eee; border-radius: 4px; margin-bottom: 15px;';
$judul_grup = 'margin: 10px 0 12px; padding-bottom: 6px; border-bottom: 2px solid #FF6700; font-weight: 700;';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">

            <h4 class="mb-4"><i class="fa fa-print"></i> Pengaturan Filter Laporan</h4>

            <!-- Laporan PPDB & Seleksi SAW -->
            <h5 style="<?= $judul_grup; ?>">Laporan PPDB &amp; Seleksi SAW</h5>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_penerimaan.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_jalur.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_rekap_ppdb.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_tren_tahun.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_saw.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_statistik_nilai.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_histori_saw.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_ppdb.php'; ?></div>
            </div>

            <!-- Laporan Akademik -->
            <h5 style="<?= $judul_grup; ?>">Laporan Akademik</h5>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_prestasi.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_guru.php'; ?></div>
            </div>

            <!-- Laporan Informasi Sekolah -->
            <h5 style="<?= $judul_grup; ?>">Laporan Informasi Sekolah</h5>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_berita.php'; ?></div>
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_pengumuman.php'; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6" style="<?= $kotak; ?>"><?php require_once 'laporan_galeri.php'; ?></div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>
