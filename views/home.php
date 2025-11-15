<div id="home" class="hero-area">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/home-background.jpg)"></div>
    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="white-text">Selamat Datang di Website Resmi SMA Maju Jaya</h1>
                    <p class="lead white-text">Mewujudkan Generasi Unggul, Berkarakter, dan Berdaya Saing Global.</p>
                    <a class="main-button icon-button" href="#courses">Lihat Info Terbaru!</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-header">
                    <h2>Pengumuman Penting</h2>
                    <p class="lead">Informasi terbaru dari sekolah yang wajib diketahui.</p>
                </div>

                <?php
                // Data diambil dari Controller, View hanya menampilkan
                if (count($data_pengumuman) > 0) {
                    foreach ($data_pengumuman as $p) {
                ?>
                <div class="feature">
                    <i class="feature-icon fa fa-bullhorn"></i>
                    <div class="feature-content">
                        <h4><?php echo htmlspecialchars($p['judul']); ?></h4>
                        <p><?php echo htmlspecialchars(substr($p['isi_pengumuman'], 0, 100)); ?>...</p>
                        <span class="text-muted"><small>Tgl: <?php echo date('d M Y', strtotime($p['tanggal_penting'])); ?></small></span>
                    </div>
                </div>
                <?php
                    } // Akhir foreach
                } else {
                    echo "<p>Belum ada pengumuman aktif saat ini.</p>";
                }
                ?>

            </div>
            <div class="col-md-6">
                <div class="about-img">
                    <img src="./img/about.png" alt="Gedung Sekolah">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="courses" class="section">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2>Berita & Kegiatan Terbaru</h2>
                <p class="lead">Ikuti perkembangan terbaru dan prestasi siswa-siswi SMA Maju Jaya.</p>
            </div>
        </div>

        <div id="courses-wrapper">
            <div class="row">
                <?php
                // Data diambil dari Controller, View hanya menampilkan
                if (count($data_berita) > 0) {
                    foreach ($data_berita as $b) {
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama']; 
                        if(empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg"; 
                        }
                ?>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="course">
                        <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="course-img">
                            <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                            <i class="course-link-icon fa fa-search"></i>
                        </a>
                        <a class="course-title" href="detail_berita.php?id=<?php echo $b['id_berita']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a>
                        <div class="course-details">
                            <span class="course-category"><?php echo htmlspecialchars($b['kategori']); ?></span>
                            <span class="course-price course-free"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?></span>
                        </div>
                    </div>
                </div>
                <?php
                    } // Akhir foreach
                } else {
                    echo "<div class='col-md-12 text-center'><p>Belum ada berita yang dipublikasikan.</p></div>";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="center-btn">
                <a class="main-button icon-button" href="berita.php">Lihat Semua Berita</a>
            </div>
        </div>
    </div>
</div>