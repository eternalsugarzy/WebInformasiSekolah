<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Berita</li>
                    <li><?php echo htmlspecialchars($berita['kategori']); ?></li>
                </ul>
                <h1 class="white-text"><?php echo htmlspecialchars($berita['judul']); ?></h1>
            </div>
        </div>
    </div>
</div>

<div id="blog" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="single-blog">
                    <div class="blog-img">
                        <?php 
                            $path_gambar = "admin/uploads/berita/" . $berita['gambar_utama'];
                            if(empty($berita['gambar_utama']) || !file_exists($path_gambar)) {
                                $path_gambar = "./img/course01.jpg"; 
                            }
                        ?>
                        <img src="<?php echo $path_gambar; ?>" alt="" style="width:100%; height:auto;">
                    </div>
                    <div class="blog-meta">
                        <span class="blog-meta-author">Oleh: <?php echo htmlspecialchars($berita['penulis'] ?? 'Admin'); ?></span>
                        <div class="pull-right">
                            <span><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($berita['tanggal_publikasi'])); ?></span>
                            <span style="margin-left: 10px;"><i class="fa fa-folder"></i> <?php echo htmlspecialchars($berita['kategori']); ?></span>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="blog-content">
                        <p><?php echo nl2br(htmlspecialchars($berita['konten_lengkap'])); ?></p>
                    </div>

                    <hr>
                    
                    <div class="blog-share">
                        <a href="index.php" class="main-button icon-button">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>