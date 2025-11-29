<style>
/* ====================== */
/* DETAIL BERITA SEAMLESS */
/* ====================== */

/* Hilangkan semua efek card */
.single-blog {
    background: transparent;     /* TANPA background */
    padding: 0;                   /* TANPA padding besar */
    border-radius: 0;             /* TANPA radius */
    box-shadow: none;             /* TANPA shadow */
}

/* ====================== */
/* GAMBAR UTAMA */
/* ====================== */
.blog-img {
    margin-bottom: 25px;
    border-radius: 0;             /* TANPA radius */
    overflow: hidden;
}

.blog-img img {
    width: 100%;
    height: 420px;
    object-fit: cover;
}

/* ====================== */
/* META DATA */
/* ====================== */
.blog-meta {
    padding: 15px 0;
    border-bottom: 1px solid #ddd;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.blog-meta span {
    color: #555;
    font-size: 14px;
}

.blog-meta i {
    color: #FF6700;
    margin-right: 6px;
}

.blog-meta-author {
    font-weight: 700;
    color: #001f3f;
}

/* ====================== */
/* ISI BERITA */
/* ====================== */
.blog-content p {
    font-size: 16px;
    line-height: 1.9;
    color: #333;
    margin-bottom: 22px;
    text-align: justify;
}

/* ====================== */
/* TOMBOL KEMBALI */
/* ====================== */
.blog-share a.main-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: linear-gradient(135deg, #0808e8, #3b5bff);
    color: #fff !important;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    font-size: 15px;

    white-space: nowrap;     /* MENCEGAH TEKS TURUN */
    width: auto !important; 
    height: auto !important;
    line-height: normal;
}

.blog-share a.main-button::before {
    font-family: 'FontAwesome';
    content: "\f060";
    margin-right: 6px;
}

.blog-share a.main-button::after {
    content: none !important;
}


/* ====================== */
/* HERO SEAMLESS */
/* ====================== */
.hero-area {
    border-radius: 0;     /* Hilangkan lengkungan bawah */
}

.judul-berita {
    font-size: 30px;
    font-weight: 800;
    color: #001f3f;
    margin: 20px 0 15px;
    line-height: 1.35;
}

</style>


<div class="hero-area section" style="height: 22vh; min-height: 210px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>

    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-10 col-md-offset-1 text-center">

                <ul class="hero-area-tree" style="font-size: 13px;">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Berita</li>
                    <li><?php echo htmlspecialchars($berita['kategori']); ?></li>
                </ul>

                <!-- JUDUL DIHAPUS DARI HERO -->
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
    if (empty($berita['gambar_utama']) || !file_exists($path_gambar)) {
        $path_gambar = "./img/course01.jpg";
    }
    ?>
    <img src="<?php echo $path_gambar; ?>" 
         alt="<?php echo htmlspecialchars($berita['judul']); ?>">
</div>

<!-- JUDUL PINDAH KE SINI -->
<h1 class="judul-berita">
    <?php echo htmlspecialchars($berita['judul']); ?>
</h1>


                    <div class="blog-meta">
                        <span class="blog-meta-author">Oleh:
                            **<?php echo htmlspecialchars($berita['penulis'] ?? 'Admin'); ?>**</span>
                        <div class="pull-right">
                            <span><i class="fa fa-calendar"></i>
                                <?php echo date('d M Y', strtotime($berita['tanggal_publikasi'])); ?></span>
                            <span style="margin-left: 15px;"><i class="fa fa-folder"></i>
                                <?php echo htmlspecialchars($berita['kategori']); ?></span>
                        </div>
                    </div>

                    <div class="blog-content">
                        <p><?php echo nl2br(htmlspecialchars($berita['konten_lengkap'])); ?></p>
                    </div>

                    <div class="blog-share">
                        <a href="berita.php" class="main-button icon-button" style="background-color: #0808e8ff;">Kembali ke Arsip Berita</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>