<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Galeri Media</li>
                </ul>
                <h1 class="white-text">Dokumentasi Kegiatan Sekolah</h1>
            </div>
        </div>
    </div>
</div>

<div id="gallery" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row">
                    
                    <?php 
                    // Cek apakah variabel $data_album sudah diinisialisasi oleh Controller
                    if (isset($data_album) && count($data_album) > 0) { 
                        foreach ($data_album as $album) {
                            // Tentukan path gambar
                            $path_media = "admin/uploads/galeri/" . $album['file_path'];
                            
                            // Jika media tidak ditemukan, gunakan placeholder
                            if(empty($album['file_path']) || !file_exists($path_media)) {
                                $path_media = "./img/placeholder-galeri.jpg"; 
                            }
                    ?>
                    
                    <div class="col-md-4 mb-4">
                        <div class="single-album">
                            <div class="album-media">
                                <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>">
                                    <img src="<?php echo $path_media; ?>" alt="<?php echo htmlspecialchars($album['judul_album']); ?>" style="height: 250px; object-fit: cover; width: 100%;">
                                </a>
                            </div>
                            <div class="album-content">
                                <ul class="album-meta">
                                    <li><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($album['tanggal_event'])); ?></li>
                                    <li><i class="fa fa-tag"></i> <?php echo htmlspecialchars($album['tipe_media']); ?></li>
                                </ul>
                                <h3><a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>"><?php echo htmlspecialchars($album['judul_album']); ?></a></h3>
                                <p><?php echo htmlspecialchars(substr($album['deskripsi'] ?? 'Tidak ada deskripsi', 0, 80)); ?>...</p>
                                <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>" class="album-more">Lihat Album</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php 
                        } 
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Galeri media belum tersedia.</h3></div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>