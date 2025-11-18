<style>
    /* ======================================= */
/* Styling Kartu Pengumuman (Home Section) */
/* ======================================= */

.feature {
    display: flex; /* Mengaktifkan Flexbox untuk mensejajarkan ikon dan konten */
    align-items: flex-start; /* Sejajarkan konten dengan bagian atas ikon */
    
    background-color: #f8f9fa; /* Latar belakang abu-abu muda */
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 15px; /* Jarak antar item pengumuman */
    
    /* Efek Shadow/Border untuk menonjolkan */
    border-left: 4px solid #ff8c00; /* Garis Oranye di kiri */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.feature:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background-color: #ffffff; /* Berubah menjadi putih saat hover */
}

/* ======================================= */
/* Styling Ikon */
/* ======================================= */

.feature-icon {
    flex-shrink: 0; /* Mencegah ikon menyusut */
    font-size: 24px;
    color: #007bff; /* Warna biru untuk ikon */
    width: 40px; /* Lebar tetap untuk ikon */
    height: 40px;
    text-align: center;
    line-height: 40px;
    margin-right: 15px;
    border-radius: 50%; /* Opsional: Bentuk lingkaran untuk ikon */
    background-color: #e9f5ff; /* Latar belakang ikon biru muda */
}

/* ======================================= */
/* Styling Konten Teks */
/* ======================================= */

.feature-content {
    flex-grow: 1; /* Konten mengisi sisa ruang */
}

.feature-content h4 {
    margin-top: 0;
    margin-bottom: 5px;
    font-size: 16px;
    color: #333;
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
</style>

<div id="home" class="hero-area" style="height: 40vh; min-height: 400px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="white-text">Selamat Datang di Website Resmi SMA Frater Don Bosco Bjm</h1>
                    <p class="lead white-text">Mewujudkan Generasi Unggul, Berkarakter, dan Bergaya Saing Global.</p>
                    <a class="main-button icon-button" href="berita.php">Lihat Info Terbaru!</a>
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
                        <span class="text-muted"><small>Tgl Penting: <?php echo date('d M Y', strtotime($p['tanggal_penting'])); ?></small></span>
                    </div>
                </div>
                <?php
                    } 
                } else {
                    echo "<p>Belum ada pengumuman aktif saat ini.</p>";
                }
                ?>
                
                <div style="margin-top: 20px;">
                    <a href="pengumuman.php" class="main-button icon-button">Lihat Semua Pengumuman <i class="fa fa-arrow-right"></i></a>
                </div>

            </div>
            <div class="col-md-6">
                <div class="about-img" >
                    <img src="./img/megaphone.jpg" alt="Aktivitas Siswa" style="
                        /* KRUSIAL: Mengatur ukuran foto */
                        width: 80%; 
                        height: 50%; 
                        object-fit: cover; /* Memastikan foto mengisi ruang tanpa terdistorsi */
                        display: block;
                        
                    ">
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
                <p class="lead">Ikuti perkembangan terbaru dan prestasi siswa-siswi SMA Maju Jaya.</p>
            </div>
        </div>

        <div id="courses-wrapper">
            <div class="row">
                <?php
                if (isset($data_berita) && count($data_berita) > 0) {
                    foreach ($data_berita as $b) {
                        // Cek path gambar
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama']; 
                        if(empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg"; 
                        }
                ?>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="course">
                        <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="course-img">
                            <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                            <i class="course-link-icon fa fa-search"></i>
                        </a>
                        
                        <a class="course-title" href="detail_berita.php?id=<?php echo $b['id_berita']; ?>"><?php echo htmlspecialchars($b['judul']); ?></a>
                        
                        <div class="course-details">
                            <span class="course-category"><?php echo htmlspecialchars($b['kategori']); ?></span>
                            <span class="course-price course-free"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?></span>
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
                <a class="main-button icon-button" href="berita.php">Lihat Semua Berita</a>
            </div>
        </div>
    </div>
</div>