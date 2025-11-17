<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Arsip Berita</li>
                </ul>
                <h1 class="white-text">Kabar Sekolah Terbaru</h1>
            </div>
        </div>
    </div>
</div>

<div id="blog" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row">
                    
                    <?php if (isset($data_berita) && count($data_berita) > 0) { 
                        foreach ($data_berita as $b) {
                            $path_gambar = "admin/uploads/berita/" . $b['gambar_utama'];
                            if(empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                                $path_gambar = "./img/course01.jpg";
                            }
                    ?>
                    <div class="col-md-4">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>">
                                    <img src="<?php echo $path_gambar; ?>" alt="" style="height: 200px; object-fit: cover; width: 100%;">
                                </a>
                            </div>
                            <ul class="blog-meta">
                                <li><i class="fa fa-user"></i> <?php echo htmlspecialchars($b['penulis'] ?? 'Admin'); ?></li>
                                <li><i class="fa fa-clock-o"></i> <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?></li>
                                <li><i class="fa fa-folder"></i> <?php echo htmlspecialchars($b['kategori']); ?></li>
                            </ul>
                            <h3><a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a></h3>
                            <p><?php echo htmlspecialchars(substr($b['konten_lengkap'], 0, 100)); ?>...</p>
                            <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="blog-more">Baca Selengkapnya</a>
                        </div>
                    </div>
                    <?php 
                        } 
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Belum ada berita yang dipublikasikan.</h3></div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>