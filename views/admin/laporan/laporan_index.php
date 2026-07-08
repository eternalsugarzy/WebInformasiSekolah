<?php 
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            
            <h4 class="mb-4"><i class="fa fa-print"></i> Pengaturan Filter Laporan</h4>
            
            <ul class="nav nav-pills mb-3" id="laporanTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="berita-tab" data-toggle="pill" href="#tabBerita" role="tab">
                        Laporan Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="guru-tab" data-toggle="pill" href="#tabGuru" role="tab">
                        Laporan Guru
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ppdb-tab" data-toggle="pill" href="#tabPPDB" role="tab">
                        Laporan PPDB
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pengumuman-tab" data-toggle="pill" href="#tabPengumuman" role="tab">
                        Laporan Pengumuman
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" id="galeri-tab" data-toggle="pill" href="#tabGaleri" role="tab">
                        Laporan Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="saw-tab" data-toggle="pill" href="#tabSaw" role="tab">
                        Laporan SAW
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="statnilai-tab" data-toggle="pill" href="#tabStatNilai" role="tab">
                        Statistik Nilai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="jalur-tab" data-toggle="pill" href="#tabJalur" role="tab">
                        Rekap Jalur Seleksi
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="laporanTabsContent">
                
                <div class="tab-pane fade" id="tabBerita" role="tabpanel">
                    <?php 
                    require_once 'laporan_berita.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabGuru" role="tabpanel">
                    <?php 
                    require_once 'laporan_guru.php';
                    ?>
                </div>
                
                <div class="tab-pane fade" id="tabPPDB" role="tabpanel">
                    <?php 
                    require_once 'laporan_ppdb.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabPengumuman" role="tabpanel">
                    <?php 
                    require_once 'laporan_pengumuman.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabGaleri" role="tabpanel">
                    <?php 
                    // Karena galeri mungkin tidak perlu filter tanggal, Anda bisa meletakkan tombol cetak langsung di sini.
                    require_once 'laporan_galeri.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabSaw" role="tabpanel">
                    <?php 
                    require_once 'laporan_saw.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabStatNilai" role="tabpanel">
                    <?php 
                    require_once 'laporan_statistik_nilai.php';
                    ?>
                </div>

                <div class="tab-pane fade" id="tabJalur" role="tabpanel">
                    <?php 
                    require_once 'laporan_jalur.php';
                    ?>
                </div>
            </div>

                <div class="tab-pane fade" id="tabStatNilai" role="tabpanel">
                    <?php 
                    require_once 'laporan_statistik_nilai.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>