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

        /* KRUSIAL: Equal Height dan Flex Column */
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .single-album:hover {
        transform: translateY(-5px);
        /* Efek mengangkat saat hover */
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
    }

    /* ======================================= */
    /* Styling Gambar dan Konten */
    /* ======================================= */

    .album-media {
        flex-shrink: 0;
        /* Mencegah gambar menyusut */
        overflow: hidden;
    }

    .album-media img {
        transition: transform 0.5s ease;
        filter: brightness(0.95);
    }

    .single-album:hover .album-media img {
        transform: scale(1.05);
        /* Zoom in saat hover */
        filter: brightness(1.0);
    }

    .album-content {
        /* Konten: Mengisi sisa ruang dan menata isinya */
        padding: 15px 20px 20px 20px;
        flex-grow: 1;
        /* KRUSIAL: Membuat konten mengisi ruang yang tersisa */
        display: flex;
        flex-direction: column;
    }

    .album-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 10px 0;
        font-size: 13px;
        color: #888;
    }

    .album-meta li {
        display: inline-block;
        margin-right: 15px;
    }

    .album-meta i {
        color: #ff8c00;
        /* Ikon berwarna oranye */
        margin-right: 5px;
    }

    .single-album h3 a {
        color: #333;
        transition: color 0.3s ease;
    }

    .single-album h3 a:hover {
        color: #007bff;
    }

    .single-album p {
        color: #666;
        margin-top: 5px;
        margin-bottom: 15px;
        flex-grow: 1;
        /* Penting agar paragraf mengisi ruang sisa di tengah */
    }

    .single-album a.album-more {
        /* KRUSIAL: Mendorong tombol ke bawah */
        margin-top: auto;
        display: inline-block;
        color: #007bff;
        font-weight: 600;
        text-decoration: none;
        padding-top: 10px;
    }

    .single-album a.album-more:after {
        font-family: 'FontAwesome';
        content: "\f061";
        /* Ikon panah ke kanan */
        margin-left: 8px;
        font-size: 0.9em;
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 300px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background1.png)"></div>
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
                                        </a>
                                    </div>

                                    <div class="album-content">
                                        <ul class="album-meta">
                                            <li><i class="fa fa-calendar"></i>
                                                <?php echo date('d M Y', strtotime($album['tanggal_event'])); ?></li>
                                            <li><i class="fa fa-tag"></i> <?php echo htmlspecialchars($album['tipe_media']); ?>
                                            </li>
                                        </ul>
                                        <h3><a
                                                href="detail_galeri.php?id=<?php echo $album['id_album']; ?>"><?php echo htmlspecialchars($album['judul_album']); ?></a>
                                        </h3>
                                        <p><?php echo htmlspecialchars(substr($album['deskripsi'] ?? 'Tidak ada deskripsi', 0, 80)); ?>...
                                        </p>
                                        <a href="detail_galeri.php?id=<?php echo $album['id_album']; ?>"
                                            class="album-more">Lihat Album</a>
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