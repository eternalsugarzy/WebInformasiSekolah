<style>
 /* --- 1. CSS UNTUK BAGIAN BERITA (NEWS) --- */
    
    /* Warna latar belakang area berita (Disamakan dengan foto referensi: Biru Gelap) */
    #courses {
        background-color: #001f3f; /* Biru Gelap (Navy) seperti referensi */
        padding-top: 80px;
        padding-bottom: 80px;
    }

    /* [PENTING] Memaksa Container menjadi LEBAR (Wide) */
    #courses .container {
        width: 95% !important;    /* Mengambil 95% lebar layar */
        max-width: 1600px;        /* Batas maksimal agar tidak terlalu pecah di layar raksasa */
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Desain Kartu Berita */
    .course {
        background: #ffffff;       
        border-radius: 4px;        /* Sudut sedikit melengkung */
        overflow: hidden;          
        box-shadow: 0 5px 15px rgba(0,0,0,0.2); 
        transition: transform 0.3s ease; 
        border: none;              
        margin-bottom: 30px;       
        height: 100%;              
        display: flex;             
        flex-direction: column;    
    }

    .course:hover {
        transform: translateY(-5px); 
    }

    /* Desain Gambar Berita (LEBIH BESAR & TINGGI) */
    .course-img img {
        width: 100%;               
        height: 300px;             /* Tinggi foto diperbesar agar proporsional dengan lebarnya */
        object-fit: cover;         
    }

    /* Area teks */
    .course-details {
        padding: 25px;             /* Padding diperbesar */
        flex-grow: 1;              
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Kategori (Tanggal/Bulan ala kalender di foto) */
    .course-category {
        color: #FF6700;            
        font-weight: bold;         
        font-size: 12px;           
        text-transform: uppercase; 
        margin-bottom: 10px;
        display: block;
    }

    /* Judul Berita */
    .course-title {
        font-size: 20px;           /* Font judul lebih besar */
        font-weight: 700;          
        margin-bottom: 15px;       
        display: block;
        line-height: 1.4;          
        color: #333;               
        text-decoration: none;     
        text-transform: uppercase; /* Judul huruf besar semua seperti referensi */
    }
    
    .course-title:hover {
        color: #FF6700;            
        text-decoration: none;
    }

    .read-more-btn {
        font-weight: bold;
        color: #333;
        text-transform: uppercase;
        font-size: 12px;
        margin-top: auto;
    }

    /* -------------------------------------------------------
       2. CSS UNTUK BAGIAN PENGUMUMAN (ABOUT SECTION)
       -------------------------------------------------------
    */

    /* Kartu Pengumuman */
    .feature {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #0000cc ; /* Garis oranye di kiri sebagai penanda */
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); /* Bayangan tipis */
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        transition: 0.3s;
    }

    .feature:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1); /* Bayangan menebal saat disentuh */
    }

    /* Ikon Pengumuman (Speaker) */
    .feature-icon {
        font-size: 24px;
        color: #0000cc ;
        margin-right: 15px;
        background: #fff0e6; /* Background oranye sangat muda */
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        border-radius: 50%; /* Membuat ikon jadi bulat */
        flex-shrink: 0;
    }

    /* Judul Pengumuman */
    .feature-content h4 {
        margin: 0 0 5px 0;
        font-weight: 700;
        color: #333;
    }

    /* Teks Isi Pengumuman */
    .feature-content p {
        margin: 0;
        font-size: 14px;
        color: #666;
    }

    /* -------------------------------------------------------
       3. CSS UNTUK LAYOUT & TOMBOL UMUM
       -------------------------------------------------------
    */

  /* Mengatur tinggi Hero Area agar gambar terlihat luas */
    #home.hero-area {
        height: 100vh; /* 80% dari tinggi layar */
        min-height: 600px;
        position: relative;
    }

    /* Judul Besar Sekolah */
    .hero-title {
        font-size: 48px;
        font-weight: 700;
        color: #fff;
        text-transform: uppercase;
        margin-bottom: 30px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.6); /* Bayangan teks agar terbaca jelas */
        letter-spacing: 1px;
    }

    /* Container Form Pencarian (Kapsul Putih) */
    .hero-search-form {
        background: #ffffff;
        padding: 8px;
        border-radius: 50px; /* Membuat bentuk kapsul bulat */
        display: flex;
        width: 100%;
        max-width: 750px; /* Lebar maksimal agar tidak terlalu panjang */
        margin: 0 auto;   /* Posisi tengah */
        box-shadow: 0 10px 25px rgba(0,0,0,0.3); /* Bayangan agar terlihat melayang */
    }

    /* Input Teks (Tempat mengetik) */
    .hero-search-input {
        border: none;
        background: transparent;
        flex-grow: 1;     /* Mengisi sisa ruang kosong */
        padding: 10px 25px;
        font-size: 16px;
        color: #555;
        outline: none;    /* Menghilangkan garis biru saat diklik */
    }

    /* Tombol Cari (Kuning/Oranye) */
    .hero-search-btn {
        background-color: #FFC107; /* Warna Kuning seperti referensi */
        color: #333;               /* Warna teks tombol */
        border: none;
        padding: 10px 40px;
        border-radius: 40px;       /* Sudut membulat */
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .hero-search-btn:hover {
        background-color: #e0a800; /* Warna saat disentuh mouse */
        transform: scale(1.05);    /* Efek membesar sedikit */
    }

    /* Responsif untuk HP */
    @media (max-width: 768px) {
        .hero-title { font-size: 32px; }
        .hero-search-form { width: 90%; }
        .hero-search-btn { padding: 10px 20px; }
    }
</style>

<div id="home" class="hero-area">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background-sekolah2.jpg)"></div>
    
    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    
                    <h1 class="hero-title">SMA FRATER DON BOSCO BANJARMASIN</h1>
                    
                    <form action="berita.php" method="GET" class="hero-search-form">
                        <input type="text" name="cari" class="hero-search-input" placeholder="Apa yang ingin anda cari?">
                        <button type="submit" class="hero-search-btn">Cari</button>
                    </form>

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
                <h2 class="judul-berita" style="color: #fff ">Berita & Kegiatan Terbaru</h2>
                <p class="lead" style="color: #fff" >Ikuti perkembangan terbaru dan prestasi siswa-siswi SMA Frater Don Bosco.</p>
            </div>
        </div>

        <div id="courses-wrapper">
            <div class="row" style="display: flex; flex-wrap: wrap;">
                <?php
                if (isset($data_berita) && count($data_berita) > 0) {
                    foreach ($data_berita as $b) {
                        // Cek path gambar
                        $path_gambar = "admin/uploads/berita/" . $b['gambar_utama'];
                        if (empty($b['gambar_utama']) || !file_exists($path_gambar)) {
                            $path_gambar = "./img/course01.jpg";
                        }
                        ?>
                        
                        <div class="col-md-4 col-sm-6 col-xs-12" style="display: flex;">
                            <div class="course" style="width: 100%;">
                                <a href="detail_berita.php?id=<?php echo $b['id_berita']; ?>" class="course-img">
                                    <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($b['judul']); ?>">
                                    <i class="course-link-icon fa fa-search"></i>
                                </a>

                                <div class="course-details">
                                    <span class="course-category"><?php echo htmlspecialchars($b['kategori']); ?></span>
                                    
                                    <a class="course-title" href="detail_berita.php?id=<?php echo $b['id_berita']; ?>">
                                        <?php echo htmlspecialchars($b['judul']); ?>
                                    </a>

                                    <span class="course-price course-free" style="color: #888; font-size: 13px;">
                                        <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($b['tanggal_publikasi'])); ?>
                                    </span>
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
            <div class="center-btn" style="margin-top: 40px;">
                <a class="main-button icon-button" href="berita.php" style="background-color: #0808e8ff;">Lihat Semua Berita</a>
            </div>
        </div>
    </div>
</div>