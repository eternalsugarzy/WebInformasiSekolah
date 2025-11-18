<style>
    /* ======================================= */
    /* Styling Umum Kartu Album */
    /* ======================================= */

    /* Mengaktifkan Flexbox pada baris di dalam section #gallery (untuk Equal Height) */
    #gallery .row {
        display: flex;
        flex-wrap: wrap;
    }

    /* Memastikan setiap kolom mengambil tinggi penuh */
    #gallery .col-md-4 {
        display: flex;
    }

    .single-album {
        /* Base styling untuk kartu */
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;

        /* KRUSIAL: Equal Height (Karena tidak ada konten, ini akan mengikuti tinggi gambar) */
        height: 100%; 
        display: block; /* Hanya blok karena tidak ada konten teks */
    }

    .single-album:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
    }

    /* ======================================= */
    /* Styling Gambar dan Overlay (Fokus Visual) */
    /* ======================================= */

    .album-media {
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
        width: 100%;
        /* Karena height diatur di tag <img>, kita hanya memastikan overflow tersembunyi */
    }

    .album-media img {
        /* Styling dari HTML: height: 250px; object-fit: cover; width: 100%; */
        transition: transform 0.5s ease;
        filter: brightness(0.95);
        border-radius: 8px; /* Sudut gambar sesuai dengan kartu */
    }

    .single-album:hover .album-media img {
        transform: scale(1.05); /* Zoom in saat hover */
        filter: brightness(1.0);
    }

    /* Overlay Ikon */
    .album-overlay-icon {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 123, 255, 0.6); /* Overlay Biru Transparan */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0; /* Awalnya tersembunyi */
        transition: opacity 0.3s ease;
    }

    .single-album:hover .album-overlay-icon {
        opacity: 1; /* Muncul saat hover */
    }

    .album-overlay-icon i {
        color: white;
        font-size: 36px;
        border: 3px solid white;
        border-radius: 50%;
        padding: 10px;
    }
</style>


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
                            if (empty($album['file_path']) || !file_exists($path_media)) {
                                $path_media = "./img/placeholder-galeri.jpg";
                            }
                            ?>

                            <div class="col-md-4 mb-4">
                                <div class="single-album">
                                    <div class="album-media">
                                        <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>">

                                            <img src="<?php echo $path_media; ?>"
                                                alt="<?php echo htmlspecialchars($album['judul_album']); ?>"
                                                style="height: 250px; object-fit: cover; width: 100%;">

                                            <div class="album-overlay-icon">
                                                <i class="fa fa-search-plus"></i>
                                            </div>

                                        </a>
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