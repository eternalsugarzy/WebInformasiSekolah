<link rel="stylesheet" href="css/home.css">

<div id="home" class="hero-area">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background-sekolah2.jpg)"></div>

    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">

                    <h1 class="hero-title">SMA FRATER DON BOSCO BANJARMASIN</h1>

                    <form action="pencarian.php" method="GET" class="hero-search-form">
                        <input type="text" name="cari" class="hero-search-input"
                            placeholder="Apa yang ingin anda cari?">
                        <button type="submit" class="hero-search-btn">Cari</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="about" class="section">
    <div class="container-fluid">

        <div class="custom-row">

            <div class="col-poster">
                <div class="full-height-card">
                    <div class="poster-card">
                        <?php if (isset($data_posters) && count($data_posters) > 0): ?>
                            <div id="posterCarousel" class="carousel slide" data-ride="carousel" style="height: 100%;">

                                <div class="carousel-inner" style="height: 100%;">
                                    <?php foreach ($data_posters as $key => $p): ?>
                                        <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>" style="height: 100%;">
                                            <img src="admin/uploads/identitas/<?php echo $p['file_poster']; ?>"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <a class="left carousel-control" href="#posterCarousel" data-slide="prev"
                                    style="background: none; display: flex; align-items: center; justify-content: center; width: 15%;">
                                    <i class="fa fa-chevron-left"
                                        style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.8);"></i>
                                </a>

                                <a class="right carousel-control" href="#posterCarousel" data-slide="next"
                                    style="background: none; display: flex; align-items: center; justify-content: center; width: 15%;">
                                    <i class="fa fa-chevron-right"
                                        style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.8);"></i>
                                </a>

                            </div>
                        <?php else: ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-announ">
                <div class="full-height-card">
                    <div class="ann-wrapper">
                        <div class="ann-header">Pengumuman Terbaru</div>
                        <div class="ann-scroll-area">
                            <?php if (isset($data_pengumuman) && count($data_pengumuman) > 0) {
                                foreach ($data_pengumuman as $p) { ?>
                                    <div class="ann-item">
                                        <div class="ann-thumb"><i class="fa fa-bullhorn"></i></div>
                                        <div class="ann-text">
                                            <span class="ann-date"><i class="fa fa-calendar"></i>
                                                <?php echo date('d M Y', strtotime($p['tanggal_penting'])); ?></span>
                                            <h5><a href="pengumuman.php"><?php echo htmlspecialchars($p['judul']); ?></a></h5>
                                        </div>
                                    </div>
                                <?php }
                            } else {
                                echo "<div style='padding:20px; text-align:center'>Belum ada pengumuman.</div>";
                            } ?>
                        </div>
                        <a href="pengumuman.php"
                            style="display:block; padding:15px; text-align:center; background:#eee; color:#001f3f; font-weight:bold; text-decoration:none;">LIHAT
                            SEMUA</a>
                    </div>
                </div>
            </div>

            <div class="col-video">
                <div class="video-section"
                    style="height: 100%; display: flex; flex-direction: column; justify-content: center; padding-left: 15px;">

                    <h3 class="kepsek-title" style="font-size: 26px;">Video Terbaru</h3>

                    <!-- CARD VIDEO DIPERBESAR -->
                    <div class="video-wrapper" style="width: 100%; 
                    height: 420px;   /* Diperbesar dari 320px */
                    padding-bottom: 0; 
                    border-radius: 15px; 
                    overflow: hidden; 
                    box-shadow: 0 18px 45px rgba(0,0,0,0.25);">
                        <?php
                        // Logika Embed Video
                        $url = $data_identitas['link_video'] ?? '';
                        $embed_url = "";

                        if (!empty($url)) {
                            $url = str_replace("watch?v=", "embed/", $url);
                            $url = str_replace("youtu.be/", "youtube.com/embed/", $url);
                            $parts = explode("&", $url);
                            $embed_url = $parts[0];
                        }
                        ?>

                        <?php if (!empty($embed_url)): ?>
                            <iframe src="<?php echo $embed_url; ?>" width="100%" height="100%" frameborder="0"
                                allowfullscreen style="width:100%; height:100%; border-radius:15px;">
                            </iframe>
                        <?php else: ?>
                            <div
                                style="width:100%; height:100%; background:#000; display:flex; align-items:center; justify-content:center; color:#fff;">
                                <p>Video belum tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="kepsek-content" style="margin-top: 25px;">
                        <div style="margin-top: 15px;">
                            <a href="profil.php"
                                style="background-color: #FF6700; color: #fff; padding: 12px 26px; border-radius: 50px; font-weight: bold; font-size: 14px; text-decoration: none; display: inline-block;">
                                TENTANG KAMI &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

</div>
</div>
</div>


<div id="courses" class="section">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2 class="judul-berita" style="color: #fff ">Berita & Kegiatan Terbaru</h2>
                <p class="lead" style="color: #fff">Ikuti perkembangan terbaru dan prestasi siswa-siswi SMA Frater Don
                    Bosco.</p>
            </div>
        </div>

        <div id="courses-wrapper">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <?php
                if (isset($data_berita) && count($data_berita) > 0) {
                    foreach ($data_berita as $b) {
                        // Cek path gambar
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama'];
                        if (empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg";
                        }
                        ?>

                        <div class="col-md-4 col-sm-6 col-xs-12" style="display: flex;">
                            <div class="course" style="width: 100%;">
                                <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="course-img">
                                    <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                                    <i class="course-link-icon fa fa-search"></i>
                                </a>

                                <div class="course-details">
                                    <span class="course-category"><?php echo htmlspecialchars($b['kategori']); ?></span>

                                    <a class="course-title" href="detail_berita.php?id=<?php echo $b['id_berita']; ?>">
                                        <?php echo htmlspecialchars($b['judul']); ?>
                                    </a>

                                    <span class="course-price course-free" style="color: #888; font-size: 13px;">
                                        <i class="fa fa-calendar"></i>
                                        <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='col-md-12 text-center'><p>Belum ada berita yang dipublikasikan.</p></div>";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="center-btn" style="margin-top: 40px;">
                <a class="main-button icon-button" href="berita.php" style="background-color: #0808e8ff;">Lihat Semua
                    Berita</a>
            </div>
        </div>
    </div>
</div>
<div id="cta" class="section">
    <div class="bg-image bg-parallax" style="background-image:url(./img/page-background1.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h2 class="white-text">Pendaftaran Siswa Baru Telah Dibuka!</h2>
                <p class="lead white-text" style="font-weight: 300; opacity: 0.9; margin-bottom: 30px;">
                    Segera daftarkan diri Anda dan jadilah bagian dari keluarga besar SMA Frater Don Bosco Banjarmasin.
                </p>
                <a class="btn-cta" href="ppdb.php">
                    <i class="fa fa-pencil-square-o"></i> LIHAT INFO PPDB
                </a>
            </div>
        </div>
    </div>
</div>

<div id="why-us" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-header">
                    <h2 style="color: #001f3f; text-transform: uppercase; font-weight: 800;">Mengapa Memilih Kami?</h2>
                    <p class="lead">Kami berkomitmen memberikan pendidikan terbaik untuk masa depan.</p>
                    <hr style="width: 60px; border: 2px solid #FF6700; margin: 20px auto;">
                </div>
            </div>
        </div>

        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-sm-6" style="display: flex;">
                <div class="feature-card" style="width: 100%;">
                    <div class="feature-icon-box"><i class="fa fa-trophy"></i></div>
                    <h4>Sekolah Berprestasi</h4>
                    <p>Meraih berbagai kejuaraan tingkat nasional di bidang akademik dan non-akademik.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6" style="display: flex;">
                <div class="feature-card" style="width: 100%;">
                    <div class="feature-icon-box"><i class="fa fa-users"></i></div>
                    <h4>Guru Profesional</h4>
                    <p>Didukung oleh tenaga pengajar lulusan terbaik yang berpengalaman dan berdedikasi.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6" style="display: flex;">
                <div class="feature-card" style="width: 100%;">
                    <div class="feature-icon-box"><i class="fa fa-building"></i></div>
                    <h4>Fasilitas Lengkap</h4>
                    <p>Laboratorium, perpustakaan digital, dan sarana olahraga modern yang memadai.</p>
                </div>
            </div>
        </div>
    </div>
</div>