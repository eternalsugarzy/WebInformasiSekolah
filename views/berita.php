<style>
    /* ======================================= */
/* 1. Styling Umum Kartu (Shadow & Radius) */
/* ======================================= */

.single-blog {
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

.single-blog:hover {
    transform: translateY(-5px); /* Efek mengangkat saat hover */
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
}

.blog-img img {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

/* ======================================= */
/* 2. Flexbox untuk Equal Height */
/* ======================================= */

/* Mengaktifkan Flexbox pada baris di dalam section #blog */
#blog .row {
    display: flex;
    flex-wrap: wrap;
}

/* Memastikan setiap kolom mengambil tinggi penuh */
#blog .col-md-4 {
    display: flex;
}

/* ======================================= */
/* 3. Styling Konten & Tombol Bottom-Aligned */
/* ======================================= */

.blog-content {
    padding: 15px 20px 20px 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* --- PERBAIKAN WARNA IKON META --- */
.blog-meta i {
    color: #007bff; /* GANTI WARNA IKON MENJADI BIRU */
    margin-right: 5px;
}
/* ---------------------------------- */


.blog-content p {
    flex-grow: 1;
    margin-top: 5px;
    margin-bottom: 15px;
}

.single-blog a.blog-more {
    margin-top: auto;
    color: #007bff;
    font-weight: 600;
    text-decoration: none;
    padding-top: 10px;
    display: block;
}

.single-blog a.blog-more:after {
    font-family: 'FontAwesome';
    content: "\f061";
    margin-left: 8px;
    font-size: 0.9em;
}

.single-blog h3 a {
    color: #333;
    transition: color 0.3s ease;
    text-decoration: none;
}

.single-blog h3 a:hover {
    color: #007bff;
    /* text-decoration: underline; */ /* Opsional jika ingin ada garis bawah saat hover */
}
</style>


<div class="hero-area section" style="height: 40vh; min-height: 300px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background1.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Kabar Sekolah Terbaru</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Arsip Berita</li>
                </ul>
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
                            if (empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                                $path_gambar = "./img/course01.jpg";
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="single-blog">
                                    <div class="blog-img">
                                        <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>">
                                            <img src="<?php echo $path_gambar; ?>" alt=""
                                                style="height: 200px; object-fit: cover; width: 100%;">
                                        </a>
                                    </div>

                                    <div class="blog-content">
                                        <ul class="blog-meta">
                                            <li><i class="fa fa-user"></i>
                                                <?php echo htmlspecialchars($b['penulis'] ?? 'Admin'); ?></li>
                                            <li><i class="fa fa-clock-o"></i>
                                                <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?></li>
                                            <li><i class="fa fa-folder"></i> <?php echo htmlspecialchars($b['kategori']); ?>
                                            </li>
                                        </ul>

                                        <h3><a
                                                href="detail_berita.php?id=<?php echo $b['id_berita']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a>
                                        </h3>

                                        <p style="flex-grow: 1;">
                                            <?php echo htmlspecialchars(substr($b['konten_lengkap'], 0, 100)); ?>...</p>

                                        <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="blog-more">Baca
                                            Selengkapnya</a>
                                    </div>
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