<?php
// detail_galeri.php
// Pastikan $album dan $fotos sudah di-set sebelum include file ini
?>
<style>
/* ====================== */
/* DETAIL GALERI SEAMLESS + LIGHTBOX */
/* ====================== */

.hero-area { border-radius: 0; height: 30vh; min-height: 220px; position: relative; }
.hero-area .bg-image { position: absolute; inset: 0; background-size: cover; background-position: center; }
.hero-area .container { position: relative; z-index: 2; }
.hero-area .hero-area-tree { color: rgba(255,255,255,0.95); margin-top: 20px; list-style: none; padding: 0; display: inline-flex; gap: 8px; font-size: 13px; }
.hero-area .hero-area-tree li a { color: rgba(255,255,255,0.95); text-decoration: none; }

.single-blog { background: transparent; padding: 0; border-radius: 0; box-shadow: none; }

/* ====================== */
/* GAMBAR SAMPUL (PROPORSIONAL & DIPERKECIL) */
/* ====================== */
.blog-img { 
    margin: 0 auto 25px auto; 
    border-radius: 8px; 
    overflow: hidden; 
    max-width: 500px; /* Ukuran sampul yang ideal agar tidak terlalu besar */
    display: block;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.blog-img img { 
    width: 100%; 
    height: auto; /* Mengikuti format foto asli */
    display: block; 
    object-fit: contain; 
}

.judul-berita { font-size: 30px; font-weight: 800; color: #001f3f; margin: 20px 0 15px; line-height: 1.35; text-align: center; }
.blog-meta { padding: 15px 0; border-bottom: 1px solid #ddd; margin-bottom: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; }
.blog-meta span { color: #555; font-size: 14px; }
.blog-meta i { color: #FF6700; margin-right: 6px; }
.blog-meta-author { font-weight: 700; color: #001f3f; }
.blog-content p { font-size: 16px; line-height: 1.9; color: #333; margin-bottom: 22px; text-align: justify; }

/* ====================== */
/* GRID DOKUMENTASI (AUTO HEIGHT) */
/* ====================== */
.gallery-grid-item { 
    margin-bottom: 20px; 
    border-radius: 8px; 
    overflow: hidden; 
    position: relative; 
    box-shadow: 0 4px 10px rgba(0,0,0,0.06); 
    cursor: pointer; 
    border: 1px solid #eee; 
    background: #fff;
}
.gallery-grid-item img { 
    width: 100%; 
    height: auto; /* Foto grid tampil utuh sesuai aslinya */
    transition: transform 0.4s ease; 
    display: block;
}
.gallery-grid-item:hover img { transform: scale(1.06); }

/* Tombol Kembali */
.blog-share a.main-button { display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: linear-gradient(135deg, #0808e8, #3b5bff); color: #fff !important; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 15px; white-space: nowrap; }
.blog-share a.main-button::before { font-family: 'FontAwesome'; content: "\f060"; margin-right: 6px; }

/* ====================== */
/* LIGHTBOX / MODAL */
/* ====================== */
#lightboxModal { display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.9); align-items: center; justify-content: center; padding: 20px; }
#lightboxModal.open { display: flex; }
.lightbox-inner { max-width: 1100px; width: 100%; max-height: 90vh; position: relative; display: flex; align-items: center; justify-content: center; flex-direction: column; }
.lightbox-image-wrap img { max-width: 100%; max-height: 80vh; object-fit: contain; border-radius: 4px; }
.lightbox-caption { margin-top: 15px; color: #fff; text-align: center; }
.lightbox-control { position: absolute; top: 50%; transform: translateY(-50%); color: #fff; background: rgba(0,0,0,0.5); border: none; padding: 15px; border-radius: 50%; cursor: pointer; font-size: 24px; }
.lightbox-prev { left: 10px; }
.lightbox-next { right: 10px; }
.lightbox-topbar { position: absolute; top: 20px; right: 20px; z-index: 10; }
.lb-icon-btn { background: #ff4d4d; color: #fff; border: none; padding: 5px 12px; border-radius: 4px; font-size: 20px; cursor: pointer; }

@media (max-width: 767px) {
    .judul-berita { font-size: 24px; }
    .blog-img { max-width: 100%; }
}
</style>

<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Detail Album</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="media-detail" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="single-blog">
                    
                    <div class="blog-img">
                        <?php
                        $cover_path = "";
                        if (!empty($album['gambar_cover'])) {
                            $cover_path = "admin/uploads/galeri/" . $album['gambar_cover'];
                        }
                        if ((empty($cover_path) || !file_exists($cover_path)) && isset($fotos[0])) {
                            $cover_path = "admin/uploads/galeri/" . $fotos[0]['file_foto'];
                        }
                        if (empty($cover_path) || !file_exists($cover_path)) $cover_path = "./img/placeholder-galeri.jpg";
                        ?>
                        <img src="<?php echo $cover_path; ?>" alt="<?php echo htmlspecialchars($album['judul_album']); ?>">
                    </div>

                    <h1 class="judul-berita"><?php echo htmlspecialchars($album['judul_album']); ?></h1>

                    <div class="blog-meta">
                        <span class="blog-meta-author">Penanggung Jawab: <strong><?php echo htmlspecialchars($album['penanggung_jawab'] ?? 'Admin'); ?></strong></span>
                        <div class="pull-right">
                            <span><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($album['tanggal_event'])); ?></span>
                            <span style="margin-left: 15px;"><i class="fa fa-photo"></i> <?php echo count($fotos); ?> Foto</span>
                        </div>
                    </div>

                    <div class="blog-content">
                        <p><?php echo nl2br(htmlspecialchars($album['deskripsi'])); ?></p>
                    </div>

                    <hr>
                    <h4 style="margin-bottom: 25px;"><i class="fa fa-th-large"></i> Dokumentasi Foto</h4>

                    [Image of a responsive photo gallery grid with different image orientations like landscape and portrait]
                    <div class="row" id="galleryGrid" style="display: flex; flex-wrap: wrap;">
                        <?php
                        $lightbox_images = [];
                        if (!empty($fotos)) {
                            foreach ($fotos as $index => $f) {
                                $path = "admin/uploads/galeri/" . $f['file_foto'];
                                if (!file_exists($path)) continue;
                                
                                $caption = htmlspecialchars($f['keterangan'] ?? '');
                                $lightbox_images[] = ['src' => $path, 'caption' => $caption];
                                ?>
                                <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
                                    <div class="gallery-grid-item">
                                        <a href="#" class="gallery-link" data-index="<?php echo count($lightbox_images)-1; ?>">
                                            <img src="<?php echo $path; ?>" alt="<?php echo $caption; ?>">
                                        </a>
                                    </div>
                                    <?php if($caption): ?>
                                        <p class="text-center text-muted" style="font-size: 11px; margin-top: -10px;"><?php echo $caption; ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>

                    <div class="blog-share text-center" style="margin-top: 40px;">
                        <a href="galeri.php" class="main-button">Kembali ke Arsip Galeri</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="lightboxModal">
    <div class="lightbox-topbar">
        <button class="lb-icon-btn" id="lbCloseBtn">&times; Close</button>
    </div>
    <div class="lightbox-inner">
        <div class="lightbox-image-wrap">
            <button class="lightbox-control lightbox-prev" id="lbPrevBtn">&#10094;</button>
            <img id="lightboxImage" src="">
            <button class="lightbox-control lightbox-next" id="lbNextBtn">&#10095;</button>
        </div>
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<script>
(function() {
    var images = <?php echo json_encode($lightbox_images); ?>;
    var modal = document.getElementById('lightboxModal');
    var imgEl = document.getElementById('lightboxImage');
    var captionEl = document.getElementById('lightboxCaption');
    var currentIndex = 0;

    function openModal(index) {
        currentIndex = index;
        imgEl.src = images[currentIndex].src;
        captionEl.textContent = images[currentIndex].caption || "Foto " + (currentIndex + 1);
        modal.classList.add('open');
    }

    function closeModal() { modal.classList.remove('open'); }

    document.querySelectorAll('.gallery-link').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            openModal(parseInt(this.dataset.index));
        });
    });

    document.getElementById('lbCloseBtn').onclick = closeModal;
    document.getElementById('lbNextBtn').onclick = function() { openModal((currentIndex + 1) % images.length); };
    document.getElementById('lbPrevBtn').onclick = function() { openModal((currentIndex - 1 + images.length) % images.length); };
    
    window.onclick = function(e) { if (e.target == modal) closeModal(); };
    document.onkeydown = function(e) {
        if (modal.classList.contains('open')) {
            if (e.key === "Escape") closeModal();
            if (e.key === "ArrowRight") document.getElementById('lbNextBtn').click();
            if (e.key === "ArrowLeft") document.getElementById('lbPrevBtn').click();
        }
    };
})();
</script>

<?php include_once 'template/footer.php'; ?>