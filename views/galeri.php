<style>
    /* ======================================= */
    /* CSS PAGINATION */
    /* ======================================= */
    .post-pagination { margin-top: 40px; text-align: center; }
    .post-pagination .pages { display: inline-block; padding-left: 0; margin: 20px 0; }
    .post-pagination .pages li { display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #EBEBEB; margin: 0 5px; transition: 0.2s all; }
    .post-pagination .pages li a { display: block; color: #374050; text-decoration: none; }
    .post-pagination .pages li:hover, .post-pagination .pages li.active { background-color: #FF6700; color: #FFF; }
    .post-pagination .pages li:hover a, .post-pagination .pages li.active a { color: #FFF; }

    /* ======================================= */
    /* GALERI CARD SEAMLESS & KONSISTEN */
    /* ======================================= */
    
    /* Baris Fleksibel untuk Tinggi Seragam */
    .flex-row {
        display: flex;
        flex-wrap: wrap;
    }

    .single-album {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        top: 0;
        display: flex;
        flex-direction: column;
        width: 100%;
        height: calc(100% - 30px); /* Menyesuaikan tinggi dengan kolom */
    }

    .single-album:hover {
        top: -8px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }

    /* Bagian Media / Gambar */
    .album-media {
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }

    .album-media img {
        transition: transform 0.6s ease;
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .single-album:hover .album-media img {
        transform: scale(1.1);
    }

    /* Overlay Klik Luas */
    .album-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 102, 0, 0); /* Oranye transparan */
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 2;
        text-decoration: none !important;
    }

    .single-album:hover .album-overlay {
        opacity: 1;
    }

    .album-icon {
        color: #fff;
        font-size: 40px;
        transform: translateY(20px);
        transition: all 0.4s ease;
    }

    .single-album:hover .album-icon {
        transform: translateY(0);
    }

    /* Bagian Detail Teks */
    .album-details {
        padding: 20px;
        flex-grow: 1; /* Mengisi sisa ruang agar footer card sejajar */
        display: flex;
        flex-direction: column;
    }

    .album-count {
        background: #FF6700;
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Wrapper Judul agar Tinggi Tetap Konsisten */
    .album-title-wrapper {
        min-height: 50px; 
        margin: 15px 0 10px;
        display: flex;
        align-items: flex-start;
    }

    .album-title {
        color: #374050;
        font-weight: 700;
        font-size: 17px;
        line-height: 1.4;
        text-decoration: none !important;
        /* Truncate text jika lebih dari 2 baris */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }

    .single-album:hover .album-title {
        color: #FF6700;
    }

    .album-date {
        margin-top: auto; /* Memaksa tanggal berada di paling bawah */
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
        font-size: 13px;
        color: #888;
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" alt="Logo" class="logo-header-berita" style="max-height: 130px;"> 
                <h1 class="white-text">Dokumentasi Kegiatan Sekolah</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Galeri Media</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="gallery" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row flex-row">

                    <?php
                    if (isset($data_album) && count($data_album) > 0) {
                        foreach ($data_album as $album) {
                            $path_media = "admin/uploads/galeri/" . $album['cover_foto'];
                            if (empty($album['cover_foto']) || !file_exists($path_media)) {
                                $path_media = "./img/course01.jpg";
                            }
                            $url_detail = "detail_galeri.php?id=" . $album['id_album'];
                        ?>

                        <div class="col-md-4 col-sm-6" style="display: flex;">
                            <div class="single-album">
                                <div class="album-media">
                                    <img src="<?php echo $path_media; ?>" alt="Cover Album">
                                    
                                    <a href="<?php echo $url_detail; ?>" class="album-overlay">
                                        <i class="fa fa-search-plus album-icon"></i>
                                    </a>
                                </div>
                                
                                <div class="album-details">
                                    <div>
                                        <span class="album-count"><?php echo $album['jumlah_foto']; ?> Foto</span>
                                    </div>

                                    <div class="album-title-wrapper">
                                        <h4 style="margin: 0;">
                                            <a href="<?php echo $url_detail; ?>" class="album-title">
                                                <?php echo htmlspecialchars($album['judul_album']); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    
                                    <div class="album-date">
                                        <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($album['tanggal_event'])); ?>
                                    </div>
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
        
        <?php if (isset($total_pages) && $total_pages > 1): ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="post-pagination">
                    <ul class="pages">
                        <?php 
                        if ($page > 1) {
                            echo '<li><a href="?page=' . ($page - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active = ($i == $page) ? 'active' : '';
                            echo '<li class="' . $active . '"><a href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($page < $total_pages) {
                            echo '<li><a href="?page=' . ($page + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>