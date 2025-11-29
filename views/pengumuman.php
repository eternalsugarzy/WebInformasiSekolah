<link rel="stylesheet" href="css/pengumuman.css">


<!-- HERO AREA -->
<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay"
         style="background-image:url(./img/page-background2.jpg)"></div>

    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">

                <img src="./img/logo2.png"
                     alt="Logo SMA Frater Don Bosco Bjm"
                     class="logo-header-berita"
                     style="max-height:130px;">

                <h1 class="white-text">Papan Informasi Sekolah</h1>

                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Pengumuman</li>
                </ul>

            </div>
        </div>
    </div>
</div>


<!-- HALAMAN PENGUMUMAN -->
<div class="pengumuman-page">
    <div class="container">
        <div class="pengumuman-wrap">

            <!-- SIDEBAR KIRI -->
            <aside class="sidebar">

                <div class="sidebar-box">
                    <h3>Pencarian</h3>
                    <form method="GET" action="">
                        <div class="search-box">
                            <input type="text"
                                   name="q"
                                   placeholder="Cari pengumuman..."
                                   value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
                            <button type="submit">Cari</button>
                        </div>
                    </form>
                </div>

            </aside>

            <!-- CARD PENGUMUMAN -->
            <div class="pengumuman-content">

                <?php if (isset($data_pengumuman) && count($data_pengumuman) > 0): ?>
                    <?php foreach ($data_pengumuman as $p): ?>

                        <div class="single-announcement">

                            <ul class="pengumuman-meta">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <?= date('d F Y', strtotime($p['tanggal_penting'])); ?>
                                </li>
                                <li>
                                    <i class="fa fa-bullhorn"></i>
                                    Aktif
                                </li>
                            </ul>

                            <h3><?= htmlspecialchars($p['judul']); ?></h3>

                            <p><?= nl2br(htmlspecialchars(substr($p['isi_pengumuman'], 0, 150))); ?>...</p>

                        </div>

                    <?php endforeach; ?>
                <?php else: ?>

                    <div>
                        <h3>Tidak ada pengumuman aktif saat ini.</h3>
                    </div>

                <?php endif; ?>

            </div>

        </div>
    </div>
</div>
