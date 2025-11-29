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

    /* ... CSS .course:hover yang lama ... */
    .course:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    /* [BARU] GANTI WARNA HOVER JADI BIRU */
    
    /* 1. Saat kartu disorot, ubah warna Judul jadi Biru Gelap */
    .course:hover .course-title {
        color: #0d0d81ff !important; /* Menimpa warna oranye */
        transition: color 0.3s ease;
    }

    /* 2. Saat judul itu sendiri disorot */
    .course-title:hover {
        color: #ff8e04ff !important; /* Biru sedikit lebih terang saat diklik */
        text-decoration: none;
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

    /* ============================================== */
    /* MENGUBAH WARNA OVERLAY GAMBAR SAAT HOVER */
    /* ============================================== */

    /* 1. Hilangkan warna oranye bawaan template pada overlay gambar */
    .course-img:after {
        background-color: rgba(158, 158, 176, 0.6) !important; /* Ganti jadi Biru Transparan */
        /* ATAU jika ingin hitam transparan: background-color: rgba(0,0,0,0.5) !important; */
    }

    /* 2. Ubah warna ikon kaca pembesar (search icon) saat hover */
    .course-link-icon {
        color: #ffffff !important; /* Ikon tetap putih */
        z-index: 10; /* Pastikan ikon di atas overlay */
    }
    
    /* 3. Pastikan overlay hanya muncul saat hover */
    .course-img:hover:after {
        opacity: 1;
        visibility: visible;
    }

    /* -------------------------------------------------------
       2. CSS UNTUK BAGIAN PENGUMUMAN (ABOUT SECTION)
       -------------------------------------------------------
    */

  #about {
        background-color: #fff;
        /* Hapus padding atas bawah agar benar-benar full */
        padding: 40px 0; 
    }

    /* 1. CONTAINER FULL (DENGAN JARAK KIRI KANAN) */
    #about .container-fluid {
        /* Beri jarak 40px dari kiri dan kanan */
        padding-left: 40px !important;  
        padding-right: 40px !important; 
        
        width: 100%;
        max-width: 100%;
        overflow-x: hidden; 
    }

    .custom-row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin: 0;
    }

    /* 2. PENGATURAN LEBAR KOLOM (SESUKA HATI) */
    /* Total harus 100% */
    
    /* Poster: Ramping di kiri (20%) */
    .col-poster {
        width: 22%; 
        padding-right: 10px; /* Sedikit jarak ke kanan */
    }

    /* Pengumuman: Sedang (33%) */
    .col-announ {
        width: 33%;
        padding: 0 15px;
    }

    /* Video: Sangat Besar (45%) */
    .col-video {
        width: 45%;
        padding-left: 10px;
    }

    /* --- TINGGI KONTEN DISAMAKAN --- */
    .full-height-card {
        height: 600px; /* Tinggi diperbesar agar video makin lega */
        background: #fff;
        border-radius: 0; /* Hapus radius agar terlihat menyatu */
    }

    /* Poster Styling */
    .poster-card {
        width: 100%;
        height: 100%;
        box-shadow: 5px 0 15px rgba(0,0,0,0.1); /* Shadow ke kanan */
        position: relative;
        z-index: 2; /* Supaya shadow menimpa sebelahnya */
    }

    /* Pengumuman Styling */
    .ann-wrapper {
        border: 1px solid #eee;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .ann-header {
        background: #001f3f;
        color: #fff;
        padding: 20px;
        font-weight: 700;
        font-size: 18px;
        text-transform: uppercase;
    }
    .ann-scroll-area { flex-grow: 1; overflow-y: auto; }
    .ann-item { padding: 20px; border-bottom: 1px solid #eee; display: flex; }
    .ann-thumb { 
        width: 50px; height: 50px; background: #eaf2ff; 
        color: #0056b3; display: flex; align-items: center; 
        justify-content: center; border-radius: 4px; margin-right: 15px; flex-shrink: 0; 
    }
    .ann-text h5 { margin: 0 0 5px; font-weight: 700; font-size: 15px; }
    .ann-text h5 a { color: #333; text-decoration: none; }
    .ann-date { font-size: 12px; color: #888; display: block; margin-bottom: 5px; }

    /* Video Styling */
    .video-container {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .video-frame {
        width: 100%;
        height: 100%; /* Video mengisi penuh area tinggi */
        border-radius: 8px 0 0 8px;
        overflow: hidden;
        box-shadow: -5px 5px 20px rgba(0,0,0,0.1);
    }
    
    /* Responsif untuk HP (Tumpuk ke bawah) */
    @media (max-width: 991px) {
        .col-poster, .col-announ, .col-video {
            width: 100%; /* Jadi 100% di HP */
            margin-bottom: 30px;
            padding: 0 15px;
        }
        .full-height-card { height: auto; }
        .video-frame { height: 300px; }
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
        max-width: 950px; /* Lebar maksimal agar tidak terlalu panjang */
        margin: 0 auto;   /* Posisi tengah */
        box-shadow: 0 10px 25px rgba(0,0,0,0.3); /* Bayangan agar terlihat melayang */
    }

    /* Input Teks (Tempat mengetik) */
    .hero-search-input {
        /* 1. Paksa hilangkan border dan shadow bawaan */
        border: none !important;       
        box-shadow: none !important;   
        
        background: transparent;
        flex-grow: 1;     
        padding: 10px 25px;
        font-size: 16px;
        color: #555;
        
        /* 2. Hilangkan outline saat diklik */
        outline: none !important;    
        
        /* 3. (Solusi Anda) Buat melengkung jg sbg cadangan kalau border tetap muncul */
        border-radius: 50px; 
    }

    /* Tambahan: Pastikan saat diklik (Fokus) kotak tidak muncul lagi */
    .hero-search-input:focus {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
    }

    /* Tombol Cari (Kuning/Oranye) */
    .hero-search-btn {
        background-color: #140a3aff; /* Warna Kuning seperti referensi */
        color: #ffffffff;               /* Warna teks tombol */
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

     /* --- 1. CALL TO ACTION (PPDB) --- */
        #cta {
            position: relative;
            padding: 80px 0;
            background-attachment: fixed !important;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }
        #cta::before {
            content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(0, 31, 63, 0.9), rgba(0, 86, 179, 0.8));
            z-index: 1;
        }
        #cta .container { position: relative; z-index: 2; }
        
        .btn-cta {
            background-color: #FF6700 !important; color: #fff !important;
            padding: 15px 40px; font-size: 16px; font-weight: 700;
            border-radius: 50px; text-decoration: none; display: inline-block;
            margin-top: 20px; transition: 0.3s; border: 2px solid #FF6700;
        }
        .btn-cta:hover {
            background-color: transparent !important; color: #FF6700 !important;
            transform: translateY(-3px);
        }

        /* --- 2. WHY US (KARTU KEUNGGULAN) --- */
        #why-us { padding: 80px 0; background-color: #f8f9fa; }
        
        .feature-card {
            background: #fff; padding: 30px 20px; border-radius: 8px;
            text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s; height: 100%; border-bottom: 4px solid transparent;
            margin-bottom: 30px;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            border-bottom-color: #FF6700;
        }
        .feature-icon-box {
            width: 70px; height: 70px; line-height: 70px;
            background: #eaf2ff; color: #0056b3; border-radius: 50%;
            font-size: 28px; margin: 0 auto 20px auto; transition: 0.3s;
        }
        .feature-card:hover .feature-icon-box { background: #FF6700; color: #fff; }
        .feature-card h4 { font-weight: 700; color: #333; margin-bottom: 15px; }
        .feature-card p { color: #666; font-size: 14px; line-height: 1.6; }
</style>

<div id="home" class="hero-area">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background-sekolah2.jpg)"></div>
    
    <div class="home-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    
                    <h1 class="hero-title">SMA FRATER DON BOSCO BANJARMASIN</h1>
                    
                    <form action="pencarian.php" method="GET" class="hero-search-form">
                        <input type="text" name="cari" class="hero-search-input" placeholder="Apa yang ingin anda cari?">
                        <button type="submit" class="hero-search-btn">Cari</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="about" class="section">
    <div class="container-fluid">
        
        <div class="custom-row">
            
            <div class="col-poster">
                <div class="full-height-card">
                    <div class="poster-card">
                        <?php if(isset($data_posters) && count($data_posters) > 0): ?>
                            <div id="posterCarousel" class="carousel slide" data-ride="carousel" style="height: 100%;">
    
    <div class="carousel-inner" style="height: 100%;">
        <?php foreach($data_posters as $key => $p): ?>
        <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>" style="height: 100%;">
            <img src="admin/uploads/identitas/<?php echo $p['file_poster']; ?>" 
                 style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <?php endforeach; ?>
    </div>
    
    <a class="left carousel-control" href="#posterCarousel" data-slide="prev" 
       style="background: none; display: flex; align-items: center; justify-content: center; width: 15%;">
        <i class="fa fa-chevron-left" style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.8);"></i>
    </a>
    
    <a class="right carousel-control" href="#posterCarousel" data-slide="next" 
       style="background: none; display: flex; align-items: center; justify-content: center; width: 15%;">
        <i class="fa fa-chevron-right" style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.8);"></i>
    </a>

</div>
                        <?php else: ?>
                           <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-announ">
                <div class="full-height-card">
                    <div class="ann-wrapper">
                        <div class="ann-header">Pengumuman Terbaru</div>
                        <div class="ann-scroll-area">
                            <?php if (isset($data_pengumuman) && count($data_pengumuman) > 0) {
                                foreach ($data_pengumuman as $p) { ?>
                            <div class="ann-item">
                                <div class="ann-thumb"><i class="fa fa-bullhorn"></i></div>
                                <div class="ann-text">
                                    <span class="ann-date"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($p['tanggal_penting'])); ?></span>
                                    <h5><a href="pengumuman.php"><?php echo htmlspecialchars($p['judul']); ?></a></h5>
                                </div>
                            </div>
                            <?php } } else { echo "<div style='padding:20px; text-align:center'>Belum ada pengumuman.</div>"; } ?>
                        </div>
                        <a href="pengumuman.php" style="display:block; padding:15px; text-align:center; background:#eee; color:#001f3f; font-weight:bold; text-decoration:none;">LIHAT SEMUA</a>
                    </div>
                </div>
            </div>

            <div class="col-video">
    <div class="video-section" style="height: 100%; display: flex; flex-direction: column; justify-content: center; padding-left: 15px;">
        
        <h3 class="kepsek-title" style="font-size: 26px;">Video Terbaru</h3>
        
        <!-- CARD VIDEO DIPERBESAR -->
        <div class="video-wrapper" 
             style="width: 100%; 
                    height: 420px;   /* Diperbesar dari 320px */
                    padding-bottom: 0; 
                    border-radius: 15px; 
                    overflow: hidden; 
                    box-shadow: 0 18px 45px rgba(0,0,0,0.25);">
            <?php
                // Logika Embed Video
                $url = $data_identitas['link_video'] ?? '';
                $embed_url = "";

                if (!empty($url)) {
                    $url = str_replace("watch?v=", "embed/", $url);
                    $url = str_replace("youtu.be/", "youtube.com/embed/", $url);
                    $parts = explode("&", $url);
                    $embed_url = $parts[0];
                }
            ?>
            
            <?php if(!empty($embed_url)): ?>
                <iframe src="<?php echo $embed_url; ?>" 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        allowfullscreen 
                        style="width:100%; height:100%; border-radius:15px;">
                </iframe>
            <?php else: ?>
                <div style="width:100%; height:100%; background:#000; display:flex; align-items:center; justify-content:center; color:#fff;">
                    <p>Video belum tersedia</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="kepsek-content" style="margin-top: 25px;">
            <p style="font-size: 16px; line-height: 1.6;">
                "<?php echo htmlspecialchars(substr($data_identitas['sambutan_kepsek'] ?? 'Selamat Datang...', 0, 200)); ?>..."
            </p>
            
            <div style="margin-top: 15px;">
                <a href="profil.php" style="background-color: #FF6700; color: #fff; padding: 12px 26px; border-radius: 50px; font-weight: bold; font-size: 14px; text-decoration: none; display: inline-block;">
                    TENTANG KAMI &rarr;
                </a>
            </div>
        </div>
    </div>
</div>


        </div>

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
<div id="cta" class="section">
        <div class="bg-image bg-parallax" style="background-image:url(./img/page-background1.png)"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">Pendaftaran Siswa Baru Telah Dibuka!</h2>
                    <p class="lead white-text" style="font-weight: 300; opacity: 0.9; margin-bottom: 30px;">
                        Segera daftarkan diri Anda dan jadilah bagian dari keluarga besar SMA Frater Don Bosco Banjarmasin.
                    </p>
                    <a class="btn-cta" href="ppdb.php">
                        <i class="fa fa-pencil-square-o"></i> LIHAT INFO PPDB
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="why-us" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-header">
                        <h2 style="color: #001f3f; text-transform: uppercase; font-weight: 800;">Mengapa Memilih Kami?</h2>
                        <p class="lead">Kami berkomitmen memberikan pendidikan terbaik untuk masa depan.</p>
                        <hr style="width: 60px; border: 2px solid #FF6700; margin: 20px auto;">
                    </div>
                </div>
            </div>

            <div class="row" style="display: flex; flex-wrap: wrap;">
                <div class="col-md-4 col-sm-6" style="display: flex;">
                    <div class="feature-card" style="width: 100%;">
                        <div class="feature-icon-box"><i class="fa fa-trophy"></i></div>
                        <h4>Sekolah Berprestasi</h4>
                        <p>Meraih berbagai kejuaraan tingkat nasional di bidang akademik dan non-akademik.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" style="display: flex;">
                    <div class="feature-card" style="width: 100%;">
                        <div class="feature-icon-box"><i class="fa fa-users"></i></div>
                        <h4>Guru Profesional</h4>
                        <p>Didukung oleh tenaga pengajar lulusan terbaik yang berpengalaman dan berdedikasi.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" style="display: flex;">
                    <div class="feature-card" style="width: 100%;">
                        <div class="feature-icon-box"><i class="fa fa-building"></i></div>
                        <h4>Fasilitas Lengkap</h4>
                        <p>Laboratorium, perpustakaan digital, dan sarana olahraga modern yang memadai.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>