<style>
    /* 1. Styling Judul Section */
    .search-section-title {
        font-size: 22px;
        font-weight: 700;
        color: #333;
        border-left: 5px solid #FF6700; /* Garis Oranye */
        padding-left: 15px;
        margin-bottom: 25px;
        margin-top: 10px;
    }

    /* 2. Styling Kartu Guru (Lebih Rapi & Personal) */
    .guru-search-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        padding: 25px 15px;
        text-align: center;
        border: 1px solid #eee;
        transition: 0.3s;
        height: 100%;
        margin-bottom: 30px;
    }
    .guru-search-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        border-color: #FF6700;
    }
    .guru-img-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto 15px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #f4f6f9;
    }
    .guru-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .guru-name {
        font-size: 16px;
        font-weight: 700;
        color: #2B2D42;
        margin-bottom: 5px;
        display: block;
    }
    .guru-role {
        font-size: 13px;
        color: #FF6700;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 5px;
        display: block;
    }
    .guru-mapel {
        font-size: 12px;
        color: #777;
    }

    /* 3. Styling List Berita (Horizontal: Gambar Kiri, Teks Kanan) */
    .news-search-item {
        background: #fff;
        display: flex;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        border: 1px solid #eee;
        transition: 0.3s;
    }
    .news-search-item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .news-img {
        width: 220px;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }
    .news-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
    }
    .news-content {
        padding: 20px;
        flex-grow: 1;
    }
    .news-title {
        font-size: 18px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 10px;
    }
    .news-title a { color: #333; text-decoration: none; }
    .news-title a:hover { color: #FF6700; }
    
    /* 4. Styling Galeri (Grid Kecil) */
    .gallery-search-item {
        position: relative;
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 20px;
        height: 180px;
    }
    .gallery-search-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }
    .gallery-search-item:hover img { transform: scale(1.1); }
    .gallery-caption {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        background: rgba(0,0,0,0.7);
        color: #fff;
        padding: 8px;
        font-size: 12px;
        text-align: center;
    }

    /* 5. Styling Pengumuman & PPDB */
    .info-search-box {
        background: #fff;
        border-left: 4px solid #374050; /* Warna gelap */
        padding: 15px 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .info-search-box h4 { margin-top: 0; font-size: 16px; font-weight: 700; }
    .info-search-box.ppdb { border-left-color: #2ecc71; } /* Warna hijau utk PPDB */

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .news-search-item { flex-direction: column; }
        .news-img { width: 100%; height: 200px; }
    }
</style>

<div class="hero-area section" style="height: 30vh; min-height: 250px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Pencarian</li>
                </ul>
                <h1 class="white-text">Hasil Pencarian: "<?php echo htmlspecialchars($keyword); ?>"</h1>
            </div>
        </div>
    </div>
</div>

<div class="section" style="background-color: #f9f9f9;">
    <div class="container">
        
        <?php if (empty($keyword)): ?>
            <div class="alert alert-warning text-center">Silakan masukkan kata kunci pencarian pada kolom di atas.</div>
        
        <?php else: ?>
            <?php 
            $total_hasil = count($hasil['berita']) + count($hasil['pengumuman']) + count($hasil['guru']) + count($hasil['galeri']) + count($hasil['ppdb']);
            if ($total_hasil == 0) {
                echo "<div class='alert alert-danger text-center' style='padding:30px;'>
                        <h4><i class='fa fa-search'></i> Tidak Ditemukan</h4>
                        <p>Maaf, kami tidak menemukan data yang cocok dengan kata kunci <b>'$keyword'</b>.</p>
                      </div>";
            }
            ?>

            <?php if (count($hasil['guru']) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="search-section-title">Data Guru & Staf</h3>
                </div>
                
                <?php foreach ($hasil['guru'] as $g): 
                    // Cek Foto
                    $path_foto = "admin/uploads/guru/" . $g['foto'];
                    if (empty($g['foto']) || !file_exists($path_foto)) {
                        $path_foto = "./img/course01.jpg"; // Gambar Default
                    }
                ?>
                <div class="col-md-3 col-sm-6">
                    <div class="guru-search-card">
                        <div class="guru-img-wrapper">
                            <img src="<?php echo $path_foto; ?>" alt="<?php echo htmlspecialchars($g['nama_lengkap']); ?>">
                        </div>
                        <span class="guru-name"><?php echo htmlspecialchars($g['nama_lengkap']); ?></span>
                        <span class="guru-role"><?php echo htmlspecialchars($g['jabatan']); ?></span>
                        <?php if(!empty($g['bidang_studi'])): ?>
                            <span class="guru-mapel"><i class="fa fa-book"></i> <?php echo htmlspecialchars($g['bidang_studi']); ?></span>
                        <?php endif; ?>
                        
                        <div style="margin-top: 15px;">
                            <a href="guru.php" class="btn btn-xs btn-default">Lihat Profil</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <hr>
            <?php endif; ?>


            <?php if (count($hasil['berita']) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="search-section-title">Berita & Artikel</h3>
                </div>
                
                <div class="col-md-10 col-md-offset-1">
                    <?php foreach ($hasil['berita'] as $b): 
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama'];
                        if (empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg";
                        }
                    ?>
                    <div class="news-search-item">
                        <div class="news-img">
                            <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                        </div>
                        <div class="news-content">
                            <span class="label label-warning" style="margin-bottom: 5px; display:inline-block;">
                                <?php echo htmlspecialchars($b['kategori']); ?>
                            </span>
                            <h4 class="news-title">
                                <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>">
                                    <?php echo htmlspecialchars($b['judul']); ?>
                                </a>
                            </h4>
                            <p style="font-size: 13px; color: #666;">
                                <?php echo substr(strip_tags($b['konten_lengkap']), 0, 120); ?>...
                            </p>
                            <small class="text-muted">
                                <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?>
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <hr>
            <?php endif; ?>


            <?php if (count($hasil['galeri']) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="search-section-title">Galeri Foto</h3>
                </div>
                <?php foreach ($hasil['galeri'] as $gl): 
                     $path_cover = "admin/uploads/galeri/" . $gl['cover_foto'];
                     if (empty($gl['cover_foto']) || !file_exists($path_cover)) {
                         $path_cover = "./img/course01.jpg";
                     }
                ?>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="detail_galeri.php?id=<?php echo $gl['id_album']; ?>">
                        <div class="gallery-search-item">
                            <img src="<?php echo $path_cover; ?>" alt="Galeri">
                            <div class="gallery-caption">
                                <?php echo htmlspecialchars($gl['judul_album']); ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <hr>
            <?php endif; ?>


            <?php if (count($hasil['pengumuman']) > 0 || count($hasil['ppdb']) > 0): ?>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="search-section-title">Informasi Lainnya</h3>
                </div>
                
                <div class="col-md-6">
                    <?php foreach ($hasil['pengumuman'] as $p): ?>
                    <div class="info-search-box">
                        <h4><i class="fa fa-bullhorn" style="color: #374050;"></i> <?php echo $p['judul']; ?></h4>
                        <p><?php echo substr($p['isi_pengumuman'], 0, 80); ?>...</p>
                        <a href="pengumuman.php" class="text-primary" style="font-size:12px;">Selengkapnya &rarr;</a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-6">
                    <?php foreach ($hasil['ppdb'] as $pd): ?>
                    <div class="info-search-box ppdb">
                        <h4><i class="fa fa-graduation-cap" style="color: #2ecc71;"></i> <?php echo $pd['jenis_informasi']; ?></h4>
                        <p>Info terkait pendaftaran siswa baru.</p>
                        <a href="ppdb.php" class="text-success" style="font-size:12px;">Lihat Detail &rarr;</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        <?php endif; ?>
        
    </div>
</div>