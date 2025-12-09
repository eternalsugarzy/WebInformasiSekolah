<style>
    /* ... (CSS Anda untuk single-album, album-overlay, dll., tetap sama) ... */
    
    /* ======================================= */
    /* PAGINATION STYLES (Pastikan ini ada di style.css atau di <style>) */
    /* ======================================= */
    .post-pagination {
        margin-top: 40px;
        text-align: center;
    }
    .post-pagination .pages {
        display: inline-block;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
    }
    .post-pagination .pages li {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 50%;
        background-color: #EBEBEB; 
        margin: 0 5px;
        transition: 0.2s all;
    }
    .post-pagination .pages li a {
        display: block;
        color: #374050; 
        text-decoration: none;
        transition: 0.2s color;
    }
    .post-pagination .pages li:hover, .post-pagination .pages li.active {
        background-color: #FF6700; 
        color: #FFF;
    }
    .post-pagination .pages li:hover a, .post-pagination .pages li.active a {
        color: #FFF;
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" 
                     alt="Logo SMA Frater Don Bosco Bjm" 
                     class="logo-header-berita"
                     style="max-height: 130px;"> 
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
        <div class="row" >
            <div id="main" class="col-md-12">
                <div class="row">

                    <?php
                    if (isset($data_album) && count($data_album) > 0) {
                        foreach ($data_album as $album) {
                            $cover = $album['cover_foto'];
                            $jumlah = $album['jumlah_foto'];
                            
                            $path_media = "admin/uploads/galeri/" . $cover;

                            if (empty($cover) || !file_exists($path_media)) {
                                $path_media = "./img/course01.jpg";
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
        
        <?php 
        // Pastikan variabel $total_pages dan $page sudah disiapkan oleh GaleriController.php
        if (isset($total_pages) && $total_pages > 1): ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="post-pagination">
                    <ul class="pages">
                        
                        <?php 
                        // Tombol Previous
                        if ($page > 1) {
                            echo '<li><a href="?page=' . ($page - 1) . '"><i class="fa fa-angle-left"></i></a></li>';
                        } else {
                            // Non-aktifkan tombol jika di halaman 1
                            echo '<li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>';
                        }
                        
                        // Link Halaman
                        for ($i = 1; $i <= $total_pages; $i++) {
                            // Tandai halaman aktif
                            $active_class = ($i == $page) ? 'active' : '';
                            echo '<li class="' . $active_class . '"><a href="?page=' . $i . '">' . $i . '</a></li>';
                        }

                        // Tombol Next
                        if ($page < $total_pages) {
                            echo '<li><a href="?page=' . ($page + 1) . '"><i class="fa fa-angle-right"></i></a></li>';
                        } else {
                            // Non-aktifkan tombol jika di halaman terakhir
                            echo '<li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>
        <?php endif; ?>
        </div>
</div>