<link rel="stylesheet" href="css/berita.css">

<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" 
                     alt="Logo SMA Frater Don Bosco Bjm" 
                     class="logo-header-berita"
                     style="max-height: 130px;"> 
                <h1 class="white-text">Berita Sekolah Kami</h1>
            
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Berita</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="berita-page">
    <div class="container">
        <div class="berita-wrap">

            <!-- ================= SIDEBAR ================= -->
            <div class="sidebar">

                <div class="sidebar-box search-box">
                    <h3>Search</h3>
                    <form method="GET">
                        <input type="text" name="q" placeholder="Cari berita...">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <div class="sidebar-box">
                    <h3>Category</h3>
                    <ul class="category-list">
    <li><a href="berita.php?kategori=Berita Sekolah">Berita Sekolah</a></li>
    <li><a href="berita.php?kategori=Info Sekolah">Info Sekolah</a></li>
    <li><a href="berita.php?kategori=Agenda Sekolah">Agenda Sekolah</a></li>
    <li><a href="berita.php?kategori=Prestasi">Prestasi</a></li>
</ul>

                </div>

                <div class="sidebar-box">
                    <h3>Archives</h3>
                    <ul class="archive-list">
    <li><a href="berita.php?tahun=2017">2017</a></li>
    <li><a href="berita.php?tahun=2019">2019</a></li>
    <li><a href="berita.php?tahun=2022">2022</a></li>
</ul>

                </div>

            </div>

            <!-- ================= KONTEN BERITA ================= -->
            <div class="berita-content">

                <?php if (!empty($data_berita)) : ?>
                    <?php foreach ($data_berita as $row) : 
                        
                        $gambar = !empty($row['gambar_utama']) 
                            ? "admin/uploads/berita/" . $row['gambar_utama'] 
                            : "img/default.jpg";

                        $tanggal = date('d', strtotime($row['tanggal_publikasi']));
                        $bulan   = date('M, Y', strtotime($row['tanggal_publikasi']));
                    ?>

                    <div class="berita-item">

                        <div class="berita-img">
                            <img src="<?= $gambar ?>">
                            <div class="berita-date">
                                <span><?= $tanggal ?></span>
                                <?= $bulan ?>
                            </div>
                        </div>

                        <div class="berita-text">
                            <span class="badge-kategori">
                                 <?= htmlspecialchars($row['kategori']) ?>
                            </span>
                            <h2><?= htmlspecialchars($row['judul']) ?></h2>
                            <p><?= substr(strip_tags($row['konten_lengkap']), 0, 180) ?>...</p>
                            <a href="detail_berita.php?id=<?= $row['id_berita'] ?>">
                                Baca Selengkapnya →
                            </a>
                        </div>

                    </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <p style="text-align:center; padding:40px;">
                        <b>Belum ada berita yang dipublikasikan.</b>
                    </p>
                <?php endif; ?>

            </div>

            <!-- ================= PAGINATION ================= -->
<div class="pagination-wrap">
    <?php for ($i = 1; $i <= $total_page; $i++) : ?>
        <a href="?page=<?= $i ?>" 
           class="<?= ($i == $page) ? 'active' : '' ?>">
           <?= $i ?>
        </a>
    <?php endfor; ?>
</div>


        </div>
    </div>
</div>
