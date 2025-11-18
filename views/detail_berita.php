<style>
/* ======================================= */
/* Styling Kartu Konten Berita */
/* ======================================= */
.single-blog {
    background-color: #ffffff;
    padding: 25px; /* Tambahkan padding di sekitar konten utama */
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Efek card */
    overflow: hidden;
}

/* Styling Gambar Utama */
.blog-img {
    margin-bottom: 20px;
    border-radius: 8px; /* Tambahkan radius pada pembungkus gambar */
    overflow: hidden;
}

/* Styling Meta Data */
.blog-meta {
    padding: 15px 0;
    border-bottom: 1px solid #eee; /* Garis pemisah halus */
    margin-bottom: 20px;
}
.blog-meta span {
    color: #555;
    font-size: 14px;
}
.blog-meta i {
    color: #007bff; /* Ikon Berwarna Biru */
    margin-right: 5px;
}
.blog-meta .blog-meta-author {
    font-weight: 600;
}

/* Styling Konten */
.blog-content p {
    font-size: 1.1em;
    line-height: 1.7;
    color: #333;
    margin-bottom: 20px;
    text-align: justify; /* Opsional: Membuat teks rata kanan-kiri */
}

/* Styling Tombol Kembali */
.blog-share {
    padding-top: 20px;
    padding-bottom: 10px;
    text-align: left; /* Posisikan tombol di kiri */
}

/* Lokasi: css/style.css */

/* 1. Reset Display pada Pembungkus Teks */
.blog-share a.main-button {
    /* Pastikan tombol adalah inline-block atau block */
    display: inline-flex; /* Gunakan inline-flex untuk penataan ikon yang rapi */
    align-items: center; /* Memastikan ikon dan teks sejajar di tengah */
    white-space: nowrap; /* KRUSIAL: Mencegah teks melompat baris secara tidak wajar */
    
    /* Styling Visual */
    background-color: #ff8c00;
    color: white !important;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: 600;
    text-decoration: none;
    line-height: normal; /* Memperbaiki masalah tinggi baris */
    font-size: 16px;
    
    /* Menghapus semua properti yang membatasi lebar */
    width: auto !important; 
    height: auto !important;
}

/* 2. Menambahkan Ikon Panah ke Kiri (Sebelum Teks) */
.blog-share a.main-button::before {
    font-family: 'FontAwesome';
    content: "\f060"; /* Kode ikon panah ke kiri */
    margin-right: 8px;
}

/* 3. Menghapus Ikon Panah ke Kanan (Jika ada bentrokan dari icon-button) */
.blog-share a.main-button::after {
    content: none !important;
}
</style>

<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Berita</li>
                    <li><?php echo htmlspecialchars($berita['kategori']); ?></li>
                </ul>
                <h1 class="white-text"><?php echo htmlspecialchars($berita['judul']); ?></h1>
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
                            if(empty($berita['gambar_utama']) || !file_exists($path_gambar)) {
                                $path_gambar = "./img/course01.jpg"; 
                            }
                        ?>
                        <img src="<?php echo $path_gambar; ?>" alt="<?php echo htmlspecialchars($berita['judul']); ?>" style="width:100%; height:auto;">
                    </div>
                    
                    <div class="blog-meta">
                        <span class="blog-meta-author">Oleh: **<?php echo htmlspecialchars($berita['penulis'] ?? 'Admin'); ?>**</span>
                        <div class="pull-right">
                            <span><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($berita['tanggal_publikasi'])); ?></span>
                            <span style="margin-left: 15px;"><i class="fa fa-folder"></i> <?php echo htmlspecialchars($berita['kategori']); ?></span>
                        </div>
                    </div>
                    
                    <div class="blog-content">
                        <p><?php echo nl2br(htmlspecialchars($berita['konten_lengkap'])); ?></p>
                    </div>

                    <div class="blog-share">
    <a href="berita.php" class="main-button icon-button">Kembali ke Arsip Berita</a>
</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>