<?php
// berita.php
// Pastikan server-side sudah men-setup $data_berita, $total_page, $page seperti sebelumnya
?>
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


<div class="berita-page" style="padding: 0; margin: 30px;">
    <div class="container">
        <div class="berita-wrap">

            <!-- ================= SIDEBAR ================= -->
            <div class="sidebar">

                <div class="sidebar-box search-box">
                    <h3>Pencarian</h3>
                    <form method="GET">
                        <input type="text" name="q" placeholder="Cari berita...">
                        <button type="submit">Cari</button>
                    </form>
                </div>

                <div class="sidebar-box">
                    <h3>Kategori</h3>
                    <ul class="category-list">
                        <li><a href="berita.php?kategori=Akademik">Akademik</a></li>
                        <li><a href="berita.php?kategori=Pengumuman">Pengumuman</a></li>
                        <li><a href="berita.php?kategori=Kegiatan Sekolah">Kegiatan Sekolah</a></li>
                        <li><a href="berita.php?kategori=Prestasi">Prestasi</a></li>
                    </ul>
                </div>

            </div>

            <!-- ================= KONTEN BERITA ================= -->
            <div class="berita-content">

                <?php if (!empty($data_berita)) : ?>
                    <?php foreach ($data_berita as $row) : 
                        
                        // sanitasi & path gambar
                        $gambar = !empty($row['gambar_utama']) 
                            ? "admin/uploads/berita/" . htmlspecialchars($row['gambar_utama'], ENT_QUOTES, 'UTF-8')
                            : "img/default.jpg";

                        // pastikan file ada (opsional) — jika tak perlu, bisa dihapus cek file_exists untuk performa
                        if (!file_exists($gambar)) {
                            $gambar = "img/default.jpg";
                        }

                        $tanggal = date('d', strtotime($row['tanggal_publikasi']));
                        $bulan   = date('M, Y', strtotime($row['tanggal_publikasi']));
                        $judul_sanit = htmlspecialchars($row['judul'], ENT_QUOTES, 'UTF-8');
                        $kategori_sanit = htmlspecialchars($row['kategori'], ENT_QUOTES, 'UTF-8');
                        $excerpt = substr(strip_tags($row['konten_lengkap']), 0, 180);
                        $excerpt = htmlspecialchars($excerpt, ENT_QUOTES, 'UTF-8');
                        $detail_url = 'detail_berita.php?id=' . urlencode($row['id_berita']);
                    ?>

                    <!-- setiap berita-item sekarang 'clickable' lewat data-href -->
                    <div class="berita-item" 
                         data-href="<?php echo $detail_url; ?>"
                         role="link"
                         tabindex="0"
                         aria-label="Buka berita: <?php echo $judul_sanit; ?>">
                        
                        <div class="berita-img">
                            <img src="<?php echo $gambar ?>" alt="<?php echo $judul_sanit; ?>">
                            <div class="berita-date">
                                <span><?php echo $tanggal ?></span>
                                <?php echo $bulan ?>
                            </div>
                        </div>

                        <div class="berita-text">
                            <span class="badge-kategori">
                                 <?php echo $kategori_sanit; ?>
                            </span>
                            <h2><?php echo $judul_sanit; ?></h2>
                            <p><?php echo $excerpt ?>...</p>
                            <a href="<?php echo $detail_url; ?>">
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
                    <a href="?page=<?php echo $i; ?>" 
                       class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                       <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>


        </div>
    </div>
</div>

<!-- ======= Script: buat card bisa diklik (tanpa mengganggu link di dalamnya) ======= -->
<script>
(function () {
    // Cari semua card berita
    var cards = document.querySelectorAll('.berita-item');

    if (!cards || cards.length === 0) return;

    cards.forEach(function(card) {
        // set gaya pointer
        card.style.cursor = 'pointer';

        // Klik handler
        card.addEventListener('click', function(e) {
            // Jika klik pada link internal (misalnya <a> "Baca Selengkapnya"), jangan override
            if (e.target.closest('a')) return;

            var href = card.getAttribute('data-href');
            if (!href) return;

            // TOMBOL tengah (mouse button 1) atau Ctrl/Cmd => buka new tab
            if (e.button === 1 || e.ctrlKey || e.metaKey) {
                window.open(href, '_blank');
                return;
            }

            // Normal left click => navigasi
            window.location.href = href;
        });

        // Mendukung klik kanan/menahan? (tidak di-handle — gunakan browser default)

        // Keyboard accessibility: Enter untuk membuka
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') { // space juga membuka
                // jika fokus berada pada anchor di dalam, biarkan anchor yang menangani
                if (document.activeElement && document.activeElement.closest && document.activeElement.closest('a')) {
                    return;
                }
                e.preventDefault();
                var href = card.getAttribute('data-href');
                if (href) window.location.href = href;
            }
        });

        // optional: focus style (jika CSS belum punya)
        card.addEventListener('focus', function() {
            card.classList.add('berita-item--focus');
        });
        card.addEventListener('blur', function() {
            card.classList.remove('berita-item--focus');
        });
    });
})();
</script>

<style>
/* tambahan kecil: tampilan fokus bila belum ada di css */
.berita-item:focus,
.berita-item.berita-item--focus {
    outline: 3px solid rgba(8,8,232,0.12);
    outline-offset: 4px;
}
</style>
