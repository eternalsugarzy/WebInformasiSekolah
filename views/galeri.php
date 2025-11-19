<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Dokumentasi Kegiatan Sekolah</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Galeri Media</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .single-album {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
        margin-bottom: 30px;
        border: 1px solid #eee;
    }
    .single-album:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .album-media {
        position: relative;
        overflow: hidden;
    }
    .album-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        opacity: 0;
        transition: 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .single-album:hover .album-overlay { opacity: 1; }
    .album-icon {
        color: #fff;
        font-size: 30px;
        border: 2px solid #fff;
        border-radius: 50%;
        width: 50px; height: 50px;
        line-height: 46px;
        text-align: center;
    }
    .album-details {
        padding: 20px;
        text-align: center;
    }
    .album-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
        display: block;
    }
    .album-count {
        font-size: 12px;
        color: #FF6700;
        font-weight: 600;
        text-transform: uppercase;
        background: #fff0e6;
        padding: 3px 10px;
        border-radius: 20px;
    }
    .album-date {
        font-size: 12px;
        color: #888;
        display: block;
        margin-top: 5px;
    }
</style>

<div id="gallery" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row">

                    <?php
                    if (isset($data_album) && count($data_album) > 0) {
                        foreach ($data_album as $album) {
                            // Ambil cover dari alias query
                            $cover = $album['cover_foto'];
                            $jumlah = $album['jumlah_foto'];
                            
                            $path_media = "admin/uploads/galeri/" . $cover;

                            // Jika media tidak ditemukan, gunakan placeholder
                            if (empty($cover) || !file_exists($path_media)) {
                                $path_media = "./img/course01.jpg"; // Gambar default
                            }
                    ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="single-album">
                            <div class="album-media">
                                <img src="<?php echo $path_media; ?>" alt="<?php echo htmlspecialchars($album['judul_album']); ?>" style="height: 240px; object-fit: cover; width: 100%;">
                                
                                <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>" class="album-overlay">
                                    <i class="fa fa-search-plus album-icon"></i>
                                </a>
                            </div>
                            
                            <div class="album-details">
                                <span class="album-count"><?php echo $jumlah; ?> Foto</span>
                                <h4 style="margin: 15px 0 5px;">
                                    <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>" class="album-title">
                                        <?php echo htmlspecialchars($album['judul_album']); ?>
                                    </a>
                                </h4>
                                <span class="album-date"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($album['tanggal_event'])); ?></span>
                            </div>
                        </div>
                    </div>

                    <?php
                        }
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Belum ada album dokumentasi.</h3></div>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>