<?php
// detail_galeri.php
// Pastikan $album dan $fotos sudah di-set sebelum include file ini
?>
<style>
/* ====================== */
/* DETAIL GALERI SEAMLESS + LIGHTBOX */
/* ====================== */

/* Basic seamless styles (dipertahankan dari versi sebelumnya) */
.hero-area { border-radius: 0; height: 40vh; min-height: 350px; position: relative; }
.hero-area .bg-image { position: absolute; inset: 0; background-size: cover; background-position: center; }
.hero-area .container { position: relative; z-index: 2; }
.hero-area .hero-area-tree { color: rgba(255,255,255,0.95); margin-top: 20px; list-style: none; padding: 0; display: inline-flex; gap: 8px; font-size: 13px; }
.hero-area .hero-area-tree li a { color: rgba(255,255,255,0.95); text-decoration: none; }
.hero-area .col-md-10 { padding-top: 100px; }

.single-blog { background: transparent; padding: 0; border-radius: 0; box-shadow: none; }
.blog-img { margin-bottom: 25px; border-radius: 0; overflow: hidden; }
.blog-img img { width: 100%; height: 420px; object-fit: cover; }

.judul-berita { font-size: 30px; font-weight: 800; color: #001f3f; margin: 20px 0 15px; line-height: 1.35; }
.blog-meta { padding: 15px 0; border-bottom: 1px solid #ddd; margin-bottom: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; }
.blog-meta span { color: #555; font-size: 14px; }
.blog-meta i { color: #FF6700; margin-right: 6px; }
.blog-meta-author { font-weight: 700; color: #001f3f; }
.blog-content p { font-size: 16px; line-height: 1.9; color: #333; margin-bottom: 22px; text-align: justify; }

.gallery-grid-item { margin-bottom: 20px; border-radius: 8px; overflow: hidden; position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.06); cursor: pointer; border: 1px solid #eee; background: #fff; }
.gallery-grid-item img { width: 100%; height: 180px; object-fit: cover; transition: transform 0.4s ease; }
.gallery-grid-item:hover img { transform: scale(1.06); }

/* tombol kembali */
.blog-share a.main-button { display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: linear-gradient(135deg, #0808e8, #3b5bff); color: #fff !important; padding: 12px 28px; border-radius: 50px; font-weight: 700; text-decoration: none; font-size: 15px; white-space: nowrap; width: auto !important; height: auto !important; line-height: normal; }
.blog-share a.main-button::before { font-family: 'FontAwesome'; content: "\f060"; margin-right: 6px; }
.blog-share a.main-button::after { content: none !important; }

/* ====================== */
/* LIGHTBOX / MODAL CSS */
/* ====================== */
#lightboxModal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0,0,0,0.85);
    align-items: center;
    justify-content: center;
    padding: 20px;
}

#lightboxModal.open { display: flex; }

.lightbox-inner {
    max-width: 1100px;
    width: 100%;
    max-height: 90vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

/* area gambar */
.lightbox-image-wrap {
    width: 100%;
    flex: 1 1 auto;
    display: flex;
    align-items: center;
    justify-content: center;
}
.lightbox-image-wrap img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 6px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
}

/* caption */
.lightbox-caption {
    margin-top: 12px;
    color: #fff;
    font-size: 15px;
    text-align: center;
    max-width: 100%;
}

/* controls */
.lightbox-control {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    background: rgba(0,0,0,0.35);
    border: none;
    padding: 12px 14px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
}
.lightbox-control:focus { outline: 2px solid rgba(255,255,255,0.2); }

/* prev/next positions */
.lightbox-prev { left: 12px; }
.lightbox-next { right: 12px; }

/* top bar (Close + Kembali) */
.lightbox-topbar {
    position: absolute;
    top: 16px;
    left: 16px;
    right: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none; /* allow button-specific pointer-events */
}
.lightbox-topbar .left, .lightbox-topbar .right { pointer-events: auto; display: flex; gap: 8px; align-items: center; }

/* style tombol Kembali & Close */
.lb-btn {
    background: rgba(255,255,255,0.08);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.08);
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
}
.lb-icon-btn {
    background: rgba(0,0,0,0.45);
    color: #fff;
    border: none;
    padding: 8px 10px;
    border-radius: 6px;
    cursor: pointer;
}

/* small screens */
@media (max-width: 767px) {
    .blog-img img { height: 220px; }
    .gallery-grid-item img { height: 140px; }
    .lightbox-control { padding: 8px 10px; font-size: 18px; }
    .lightbox-caption { font-size: 13px; }
}
</style>

<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li>Detail</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="media-detail" class="section" style="margin-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="single-blog">
                    <div class="blog-img">
                        <?php
                        $cover_path = "";
                        if (!empty($album['gambar_cover'])) {
                            $cover_path = "admin/uploads/galeri/" . $album['gambar_cover'];
                            if (!file_exists($cover_path)) $cover_path = "";
                        }
                        if (empty($cover_path) && isset($fotos) && count($fotos) > 0) {
                            $maybe = "admin/uploads/galeri/" . $fotos[0]['file_foto'];
                            if (file_exists($maybe)) $cover_path = $maybe;
                        }
                        if (empty($cover_path)) $cover_path = "./img/placeholder-galeri.jpg";
                        ?>
                        <img src="<?php echo $cover_path; ?>" alt="<?php echo htmlspecialchars($album['judul_album'] ?? 'Detail Album'); ?>">
                    </div>

                    <h1 class="judul-berita"><?php echo htmlspecialchars($album['judul_album'] ?? 'Detail Album'); ?></h1>

                    <div class="blog-meta">
                        <span class="blog-meta-author">Oleh:
                            <strong><?php echo htmlspecialchars($album['penanggung_jawab'] ?? ($album['penulis'] ?? 'Admin')); ?></strong>
                        </span>
                        <div class="pull-right">
                            <span><i class="fa fa-calendar"></i>
                                <?php
                                $tgl = $album['tanggal_event'] ?? null;
                                if ($tgl && $tgl !== '1970-01-01') {
                                    echo date('d M Y', strtotime($tgl));
                                } else {
                                    echo '-';
                                }
                                ?>
                            </span>
                            <span style="margin-left: 15px;"><i class="fa fa-photo"></i>
                                <?php echo isset($fotos) ? count($fotos) . ' Foto' : '0 Foto'; ?></span>
                        </div>
                    </div>

                    <div class="blog-content">
                        <p><?php echo nl2br(htmlspecialchars($album['deskripsi'] ?? 'Tidak ada deskripsi tersedia.')); ?></p>
                    </div>

                    <hr>

                    <h4 style="margin-bottom: 20px; color: #333;">Dokumentasi Foto:</h4>

                    <div class="row" id="galleryGrid">
                        <?php
                        $lightbox_images = [];
                        if (isset($fotos) && count($fotos) > 0) {
                            foreach ($fotos as $f) {
                                $path = "admin/uploads/galeri/" . $f['file_foto'];
                                if (!file_exists($path)) $path = "./img/placeholder-galeri.jpg";
                                $caption = isset($f['keterangan']) ? $f['keterangan'] : '';
                                // for JS array
                                $lightbox_images[] = [
                                    'src' => $path,
                                    'caption' => $caption
                                ];
                                ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="gallery-grid-item">
                                        <!-- data-index akan dipakai JS untuk membuka image dengan index -->
                                        <a href="<?php echo $path; ?>" class="gallery-link" data-index="<?php echo count($lightbox_images)-1; ?>" title="<?php echo htmlspecialchars($caption); ?>">
                                            <img src="<?php echo $path; ?>" alt="<?php echo htmlspecialchars($caption ?: 'Foto Dokumentasi'); ?>">
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<div class='col-md-12'><div class='alert alert-warning'>Belum ada foto di album ini.</div></div>";
                        }
                        ?>
                    </div>

                    <div class="blog-share" style="margin-top: 20px;">
                        <a href="galeri.php" class="main-button icon-button">Kembali ke Arsip Galeri</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- LIGHTBOX MODAL -->
<div id="lightboxModal" aria-hidden="true" role="dialog" aria-label="Lightbox Foto">
    <div class="lightbox-inner" role="document">
        <div class="lightbox-topbar">
            <div class="left">
                <button class="lb-btn" id="lbBackBtn" title="Kembali ke galeri">Kembali</button>
            </div>
            <div class="right">
                <button class="lb-icon-btn" id="lbCloseBtn" aria-label="Tutup (Esc)">&times;</button>
            </div>
        </div>

        <div class="lightbox-image-wrap">
            <button class="lightbox-control lightbox-prev" id="lbPrevBtn" aria-label="Foto sebelumnya" title="Sebelumnya">&#10094;</button>
            <img id="lightboxImage" src="" alt="Foto galeri">
            <button class="lightbox-control lightbox-next" id="lbNextBtn" aria-label="Foto selanjutnya" title="Selanjutnya">&#10095;</button>
        </div>

        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<script>
/* ========== Lightbox JS ========== */
(function() {
    // Build image array from PHP-generated JS object
    var images = <?php echo json_encode($lightbox_images, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

    var modal = document.getElementById('lightboxModal');
    var imgEl = document.getElementById('lightboxImage');
    var captionEl = document.getElementById('lightboxCaption');
    var currentIndex = 0;

    var galleryLinks = document.querySelectorAll('.gallery-link');

    function openModal(index) {
        if (!images || images.length === 0) return;
        currentIndex = (index + images.length) % images.length;
        var item = images[currentIndex];
        // set image and caption
        imgEl.src = item.src;
        imgEl.alt = item.caption || ('Foto ' + (currentIndex + 1));
        captionEl.textContent = item.caption || ('Foto ' + (currentIndex + 1) + ' dari ' + images.length);
        // show modal
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        // focus for accessibility
        document.getElementById('lbCloseBtn').focus();
        // preload neighbor
        preloadImage((currentIndex + 1) % images.length);
        preloadImage((currentIndex - 1 + images.length) % images.length);
    }

    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        imgEl.src = '';
        captionEl.textContent = '';
    }

    function showNext() {
        openModal(currentIndex + 1);
    }

    function showPrev() {
        openModal(currentIndex - 1);
    }

    function preloadImage(i) {
        var p = new Image();
        p.src = images[i].src;
    }

    // attach click handlers to thumbnails
    galleryLinks.forEach(function(a) {
        a.addEventListener('click', function(e) {
            e.preventDefault();
            var idx = parseInt(this.getAttribute('data-index'), 10);
            if (isNaN(idx)) idx = 0;
            openModal(idx);
        });
    });

    // controls
    document.getElementById('lbCloseBtn').addEventListener('click', function() {
        closeModal();
    });
    document.getElementById('lbBackBtn').addEventListener('click', function() {
        // tombol Kembali: close modal (kamu bisa ubah agar menuju page sebelumnya jika mau)
        closeModal();
        // scroll ke grid (mengembalikan fokus ke galeri)
        var grid = document.getElementById('galleryGrid');
        if (grid) {
            grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // fokuskan thumbnail pertama
            var firstLink = grid.querySelector('.gallery-link');
            if (firstLink) firstLink.focus();
        }
    });
    document.getElementById('lbNextBtn').addEventListener('click', function() { showNext(); });
    document.getElementById('lbPrevBtn').addEventListener('click', function() { showPrev(); });

    // keyboard support
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('open')) {
            if (e.key === 'ArrowRight') { e.preventDefault(); showNext(); }
            else if (e.key === 'ArrowLeft') { e.preventDefault(); showPrev(); }
            else if (e.key === 'Escape') { e.preventDefault(); closeModal(); }
        }
    });

    // click outside image closes modal
    modal.addEventListener('click', function(e) {
        // jika klik elemen modal (background) bukan child inner
        if (e.target === modal) {
            closeModal();
        }
    });

    // Touch swipe (simple)
    var touchStartX = null;
    var touchEndX = null;
    var threshold = 40; // minimal swipe jarak px

    imgEl.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, {passive:true});
    imgEl.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        if (touchStartX !== null) {
            var diff = touchStartX - touchEndX;
            if (Math.abs(diff) > threshold) {
                if (diff > 0) showNext(); else showPrev();
            }
        }
        touchStartX = null;
        touchEndX = null;
    }, {passive:true});
})();
</script>

<?php
// footer include seperti sebelumnya
include_once __DIR__ . '/template/footer.php';
?>
