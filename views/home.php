<style>
    /* Menggunakan warna Biru Gelap (#0808e8ff) dan Biru Terang (#007bff) sebagai aksen */

    /* ======================================= */
    /* Styling Kartu Pengumuman (Home Section) */
    /* ======================================= */

    .feature {
        display: flex;
        align-items: flex-start;

        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 15px;

        /* 🎯 PERUBAHAN: Garis kiri menggunakan warna Biru Gelap (#0808e8ff) */
        border-left: 4px solid #0808e8ff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .feature:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    /* ======================================= */
    /* Styling Ikon */
    /* ======================================= */

    .feature-icon {
        flex-shrink: 0;
        font-size: 24px;
        /* 🎯 PERUBAHAN: Warna ikon menggunakan Biru Terang (#007bff) */
        color: #007bff;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        margin-right: 15px;
        border-radius: 50%;
        /* 🎯 PERUBAHAN: Latar belakang ikon lebih terang */
        background-color: #e6f7ff;
    }

    /* ======================================= */
    /* Styling Konten Teks */
    /* ======================================= */

    .feature-content {
        flex-grow: 1;
    }

    .feature-content h4 {
        margin-top: 0;
        margin-bottom: 5px;
        font-size: 16px;
        color: #333;
        /* 🎯 OPSIONAL: Teks judul pengumuman saat hover menjadi Biru Gelap */
        transition: color 0.3s ease;
    }

    .feature:hover .feature-content h4 {
        color: #0808e8ff;
        /* Warna judul berubah saat kursor diarahkan ke kartu */
    }

    .feature-content p {
        margin-bottom: 5px;
        font-size: 14px;
        color: #555;
    }

    .feature-content small {
        color: #888;
        font-style: italic;
    }

    /* ======================================= */
    /* Styling Gambar Pengumuman (Kolom kanan) */
    /* ======================================= */
    .about-img {
        /* Padding untuk memberi ruang jika foto menyentuh tepi container */
        padding: 10px;
    }

    .about-img img {
        width: 70% !important;
        /* Foto mengisi penuh kolom */
        height: auto !important;
        /* Biarkan tinggi menyesuaikan (responsive) */
        max-height: 400px;
        /* Batasi tinggi maksimum agar tidak terlalu besar */
       margin-left: 70px;
    }

    .bg-image.overlay:after {
    content:"";
    /* ... kode posisi ... */
    background-image: -webkit-gradient(linear, left top, left bottom, from(#374050), to(#798696));
    /* ... */
    opacity: 0.7; /* Ini yang membuatnya memudar dan gelap */
}
</style>

<div id="home" class="hero-area" style="height: 40vh; min-height: 550px;">
        <div class="bg-image bg-parallax" style="background-image:url(./img/page-background-sekolah.jpg)"></div>
    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="white-text">Selamat Datang di Website Resmi SMA Frater Don Bosco Banjarmasin</h1>
                    <p class="lead white-text">Mewujudkan Generasi Unggul, Berkarakter dan Bergaya Saing Global.</p>
                    <a class="main-button icon-button" href="berita.php" style="background-color: #0808e8ff;">Lihat Info
                        Terbaru!</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="about" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-header">
                    <h2>Pengumuman Penting</h2>
                    <p class="lead">Informasi terbaru dari sekolah yang wajib diketahui.</p>
                </div>

                <?php
                if (isset($data_pengumuman) && count($data_pengumuman) > 0) {
                    foreach ($data_pengumuman as $p) {
                        ?>
                        <div class="feature">
                            <i class="feature-icon fa fa-bullhorn"></i>

                            <div class="feature-content">
                                <h4><?php echo htmlspecialchars($p['judul']); ?></h4>
                                <p><?php echo htmlspecialchars(substr($p['isi_pengumuman'], 0, 100)); ?>...</p>
                                <span class="text-muted"><small>Tgl Penting:
                                        <?php echo date('d M Y', strtotime($p['tanggal_penting'])); ?></small></span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Belum ada pengumuman aktif saat ini.</p>";
                }
                ?>

                <div style="margin-top: 20px;">
                    <a href="pengumuman.php" class="main-button icon-button" style="background-color: #0808e8ff;">Lihat
                        Semua Pengumuman <i class="fa fa-arrow-right"></i></a>
                </div>

            </div>
            <div class="col-md-6">
                <div class="about-img">
                    <img src="./img/megaphone2.png" alt="Gambar Pengumuman">
                </div>
            </div>
        </div>
    </div>
</div>


<div id="courses" class="section">
    <div class="container">
        <div class="row">
            <div class="section-header text-center">
                <h2>Berita & Kegiatan Terbaru</h2>
                <p class="lead">Ikuti perkembangan terbaru dan prestasi siswa-siswi SMA Frater Don Bosco.</p>
            </div>
        </div>

        <div id="courses-wrapper">
            <div class="row">
                <?php
                if (isset($data_berita) && count($data_berita) > 0) {
                    foreach ($data_berita as $b) {
                        // Cek path gambar
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama'];
                        if (empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg";
                        }
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="course-img">
                                    <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                                    <i class="course-link-icon fa fa-search"></i>
                                </a>

                                <a class="course-title"
                                    href="detail_berita.php?id=<?php echo $b['id_berita']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a>

                                <div class="course-details">
                                    <span class="course-category"><?php echo htmlspecialchars($b['kategori']); ?></span>
                                    <span class="course-price course-free"><i class="fa fa-calendar"></i>
                                        <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='col-md-12 text-center'><p>Belum ada berita yang dipublikasikan.</p></div>";
                }
                ?>
            </div>
        </div>

        <div class="row">
            <div class="center-btn">
                <a class="main-button icon-button" href="berita.php" style="background-color: #0808e8ff;">Lihat Semua
                    Berita</a>
            </div>
        </div>
    </div>
</div>