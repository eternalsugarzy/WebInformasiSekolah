<div class="hero-area section">
    
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Pengumuman</li>
                </ul>
                <h1 class="white-text">Papan Informasi Sekolah</h1>
            </div>
        </div>
    </div>
</div>

<div id="pengumuman-list" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row">
                    <?php 
                    // Cek apakah variabel $data_pengumuman sudah diinisialisasi oleh Controller
                    if (isset($data_pengumuman) && count($data_pengumuman) > 0) { 
                        foreach ($data_pengumuman as $p) {
                    ?>
                    
                    <div class="col-md-12">
                        <div class="single-announcement">
                            <ul class="pengumuman-meta">
                                <li><i class="fa fa-calendar"></i> **Tanggal Penting:** <?php echo date('d F Y', strtotime($p['tanggal_penting'])); ?></li>
                                <li><i class="fa fa-bullhorn"></i> **Status:** Aktif</li>
                            </ul>
                            <h3><?php echo htmlspecialchars($p['judul']); ?></h3>
                            <div class="pengumuman-content">
                                <p><?php echo nl2br(htmlspecialchars($p['isi_pengumuman'])); ?></p>
                            </div>
                            <hr>
                        </div>
                    </div>
                    
                    <?php 
                        } 
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Tidak ada pengumuman aktif saat ini.</h3></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>