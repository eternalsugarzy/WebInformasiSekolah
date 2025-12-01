<?php
// Load header template
include_once __DIR__ . '/template/header.php';
?>

<style>
    /* ===== FIX TOMBOL KEMBALI DETAIL PENGUMUMAN ===== */
.blog-share a.main-button {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;

    padding: 12px 28px !important;
    border-radius: 50px !important;
    background: linear-gradient(135deg, #0808e8, #3b5bff) !important;
    color: #fff !important;

    font-weight: 700 !important;
    font-size: 15px !important;
    text-decoration: none !important;

    white-space: nowrap !important;  /* ANTI TEKS TURUN BARIS */

    width: auto !important;
    height: auto !important;
    line-height: normal !important;

    gap: 10px !important;
}

/* Ikon panah (left arrow) */
.blog-share a.main-button::before {
    font-family: 'FontAwesome';
    content: "\f060";     
    margin-right: 6px;
}

/* Matiin panah bawaan template (yang bikin kacau posisinya) */
.blog-share a.main-button::after {
    content: none !important;
}

/* Pastikan <a> tidak pakai display:block dari CSS global */
.blog-share a {
    display: inline-flex !important;
}

</style>

<link rel="stylesheet" href="css/pengumuman.css">

<div class="hero-area section" style="height: 22vh; min-height: 210px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>

    <div class="container">
        <div class="row" style="margin-top:20px;">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree" style="font-size:13px;">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="pengumuman.php">Pengumuman</a></li>
                    <li>Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="pengumuman-detail section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <?php if (!empty($pengumuman)): ?>

                    <!-- Judul -->
                    <h1 class="judul-berita">
                        <?= htmlspecialchars($pengumuman['judul']); ?>
                    </h1>

                    <!-- Meta -->
                    <div class="blog-meta" style="margin-bottom:18px;">
                        <span class="blog-meta-author">
                            Oleh: <strong><?= htmlspecialchars($pengumuman['penulis'] ?? 'Admin'); ?></strong>
                        </span>

                        <div class="pull-right">
                            <span>
                                <i class="fa fa-calendar"></i>
                                <?= date('d F Y', strtotime($pengumuman['tanggal_penting'])); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Gambar -->
                    <?php
                        $img = (!empty($pengumuman['gambar']))
                            ? "admin/uploads/pengumuman/" . $pengumuman['gambar']
                            : "";
                        if ($img && file_exists($img)):
                    ?>
                        <div class="blog-img" style="margin-bottom:25px;">
                            <img src="<?= $img ?>" style="width:100%; height:420px; object-fit:cover;">
                        </div>
                    <?php endif; ?>

                    <!-- Isi -->
                    <div class="blog-content">
                        <p><?= nl2br(htmlspecialchars($pengumuman['isi_pengumuman'])); ?></p>
                    </div>

                    <!-- Tombol kembali -->
                    <div class="blog-share">
                         <a href="pengumuman.php" class="main-button">Kembali ke Pengumuman</a>
                    </div>


                <?php else: ?>

                    <div style="padding:40px; text-align:center;">
                        <h3>Pengumuman tidak ditemukan.</h3>
                        <a href="pengumuman.php" class="main-button icon-button">
                            Kembali ke Pengumuman
                        </a>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php
// Load footer template
include_once __DIR__ . '/template/footer.php';
?>
