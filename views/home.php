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
        color: #0808e8ff !important; /* Menimpa warna oranye */
        transition: color 0.3s ease;
    }

    /* 2. Saat judul itu sendiri disorot */
    .course-title:hover {
        color: #0056b3 !important; /* Biru sedikit lebih terang saat diklik */
        text-decoration: none;
    }

    /* 3. (Opsional) Ubah warna Kategori (Tanggal/Label) jadi Biru juga saat hover */
    .course:hover .course-category {
        color: #0808e8ff !important;
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
        background-color: rgba(8, 8, 232, 0.6) !important; /* Ganti jadi Biru Transparan */
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
        background-color: #ffffff;
        padding-top: 60px;
        padding-bottom: 60px;
    }

    /* Container Lebar (Sesuai Permintaan) */
    #about .container {
        width: 95% !important;
        max-width: 1600px;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* --- KOLOM 1: POSTER (KIRI) --- */
    .poster-card {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        height: 100%;
        text-align: center;
        background: #000; /* Background hitam kalau gambar loading */
    }
    .poster-card img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Memenuhi kotak */
        display: block;
        min-height: 450px; /* Tinggi minimal agar terlihat gagah */
    }

    /* --- KOLOM 2: LIST PENGUMUMAN (TENGAH) --- */
    /* Header Biru Tua seperti di foto */
    .ann-header {
        background-color: #001f3f; /* Biru Navy Gelap */
        color: #fff;
        padding: 15px 20px;
        border-radius: 4px 4px 0 0; /* Sudut atas melengkung */
        margin-bottom: 0;
        font-weight: 700;
        font-size: 18px;
    }

    /* Container List */
    .ann-list-container {
        border: 1px solid #eee;
        border-top: none;
        padding: 0;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* Item List */
    .ann-item {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: 0.2s;
        align-items: flex-start;
    }
    .ann-item:hover {
        background-color: #f4f9ff; /* Biru sangat muda saat hover */
        border-left: 3px solid #001f3f;
    }
    .ann-item:last-child { border-bottom: none; }

    /* Gambar Kecil di list (Opsional / Placeholder Icon) */
    .ann-thumb {
        width: 60px;
        height: 60px;
        background: #e6f0ff;
        color: #001f3f;
        flex-shrink: 0;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-size: 24px;
    }

    /* Teks Pengumuman */
    .ann-text h5 {
        margin: 0 0 5px 0;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.4;
        text-transform: uppercase;
    }
    .ann-text h5 a { color: #333; text-decoration: none; }
    .ann-text h5 a:hover { color: #001f3f; }
    
    .ann-date {
        font-size: 12px;
        color: #888;
        margin-bottom: 8px;
        display: block;
    }

    .ann-read-more {
        font-size: 11px;
        font-weight: 700;
        color: #001f3f;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 1px;
    }
    .ann-read-more:hover { text-decoration: underline; }

    /* --- KOLOM 3: VIDEO & SAMBUTAN (KANAN) --- */
    .kepsek-title {
        font-size: 18px;
        font-weight: 700;
        color: #001f3f;
        margin-bottom: 15px;
    }
    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* Rasio 16:9 */
        height: 0;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .video-wrapper iframe {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;
    }
    .kepsek-content p { font-size: 14px; color: #555; line-height: 1.6; font-style: italic; }
    .kepsek-content strong { color: #333; }

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
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-4">
                <div class="poster-card" style="position: relative; height: 600px; width: 100%; overflow: hidden; border-radius: 8px;">
                    
                    <?php if(isset($data_posters) && count($data_posters) > 0): ?>
                        
                        <div id="posterCarousel" class="carousel slide" data-ride="carousel" style="height: 100%;">
                            
                            <ol class="carousel-indicators" style="bottom: 10px;">
                                <?php foreach($data_posters as $key => $p): ?>
                                    <li data-target="#posterCarousel" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : ''; ?>"></li>
                                <?php endforeach; ?>
                            </ol>

                            <div class="carousel-inner" style="height: 100%;">
                                <?php foreach($data_posters as $key => $p): ?>
                                <div class="item <?php echo ($key == 0) ? 'active' : ''; ?>" style="height: 100%;">
                                    <img src="admin/uploads/identitas/<?php echo $p['file_poster']; ?>" 
                                         alt="Poster Sekolah" 
                                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <a class="left carousel-control" href="#posterCarousel" data-slide="prev" 
                               style="background: none; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-chevron-left" style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.5);"></i>
                            </a>
                            <a class="right carousel-control" href="#posterCarousel" data-slide="next" 
                               style="background: none; display: flex; align-items: center; justify-content: center;">
                                <i class="fa fa-chevron-right" style="font-size: 30px; color: #fff; text-shadow: 0 2px 5px rgba(0,0,0,0.5);"></i>
                            </a>
                        </div>

                    <?php else: ?>
                        <img src="./img/poster-sekolah.jpg" onerror="this.src='./img/about.png'" alt="Poster Default" 
                             style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="ann-header">Pengumuman</div>
                
                <div class="ann-list-container">
                    <?php
                    // Ambil 3 atau 4 pengumuman terbaru
                    if (isset($data_pengumuman) && count($data_pengumuman) > 0) {
                        foreach ($data_pengumuman as $p) {
                    ?>
                    <div class="ann-item">
                        <div class="ann-thumb">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                        <div class="ann-text">
                            <h5><a href="pengumuman.php"><?php echo htmlspecialchars($p['judul']); ?></a></h5>
                            <span class="ann-date"><?php echo date('d F Y', strtotime($p['tanggal_penting'])); ?></span>
                            <a href="pengumuman.php" class="ann-read-more">READ MORE &raquo;</a>
                        </div>
                    </div>
                    <?php
                        } 
                    } else {
                        echo "<div style='padding:30px; text-align:center; color:#777;'>Belum ada pengumuman terbaru.</div>";
                    }
                    ?>
                    
                    <a href="pengumuman.php" style="display:block; padding:15px; text-align:center; background:#f9f9f9; color:#001f3f; font-weight:bold; text-decoration:none; border-top:1px solid #eee;">
                        LIHAT SEMUA PENGUMUMAN
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <h3 class="kepsek-title">Sambutan Kepala Sekolah</h3>
                
                <div class="video-wrapper">
                    <iframe src="https://www.youtube.com/embed/AWyrBXIUE7M" allowfullscreen></iframe>
                </div>

                <div class="kepsek-content">
                    <p>"<?php echo htmlspecialchars(substr($data_identitas['sambutan_kepsek'] ?? 'Selamat Datang...', 0, 150)); ?>..."</p>
                    <br>
                    <strong>Assalamu'alaikum Wr. Wb.</strong>
                    <br><br>
                    <a href="profil.php" style="color:#FF6700; font-weight:bold; font-size:12px; text-decoration:none;">READ MORE &raquo;</a>
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