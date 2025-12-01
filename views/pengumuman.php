<?php
// pengumuman.php
// Pastikan server-side men-setup $data_pengumuman (array), $total_page, $page jika ada pagination
?>

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
                                   value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8') : '' ?>">
                            <button type="submit">Cari</button>
                        </div>
                    </form>
                </div>

            </aside>

            <!-- CARD PENGUMUMAN -->
            <div class="pengumuman-content">

                <?php if (isset($data_pengumuman) && count($data_pengumuman) > 0): ?>
                    <?php foreach ($data_pengumuman as $p):
                        // sanitasi & persiapan
                        $id = isset($p['id_pengumuman']) ? $p['id_pengumuman'] : ($p['id'] ?? null);
                        $detail_url = 'detail_pengumuman.php?id=' . urlencode($id);
                        $judul = htmlspecialchars($p['judul'] ?? '—', ENT_QUOTES, 'UTF-8');
                        $tanggal = isset($p['tanggal_penting']) ? date('d F Y', strtotime($p['tanggal_penting'])) : '-';
                        $excerpt = substr(strip_tags($p['isi_pengumuman'] ?? ''), 0, 150);
                        $excerpt = htmlspecialchars($excerpt, ENT_QUOTES, 'UTF-8');
                        // optional gambar ringkas (jika ada)
                        $thumb = (!empty($p['gambar'])) ? "admin/uploads/pengumuman/" . htmlspecialchars($p['gambar'], ENT_QUOTES, 'UTF-8') : '';
                        if ($thumb && !file_exists($thumb)) $thumb = '';
                    ?>
                        <div class="single-announcement" 
                             data-href="<?php echo $detail_url; ?>"
                             role="link"
                             tabindex="0"
                             aria-label="Buka pengumuman: <?php echo $judul; ?>">

                            <ul class="pengumuman-meta">
                                <li><i class="fa fa-calendar"></i> <?php echo $tanggal; ?></li>
                                <li><i class="fa fa-bullhorn"></i> Aktif</li>
                            </ul>

                            <h3><?php echo $judul; ?></h3>

                            <?php if ($thumb): ?>
                                <div class="pengumuman-thumb" style="margin-bottom:12px;">
                                    <img src="<?php echo $thumb; ?>" alt="<?php echo $judul; ?>" style="max-width:100%; height:auto; border-radius:6px;">
                                </div>
                            <?php endif; ?>

                            <p><?php echo nl2br($excerpt); ?>...</p>

                            <p>
                                <a href="<?php echo $detail_url; ?>">Baca selengkapnya &rarr;</a>
                            </p>

                        </div>
                    <?php endforeach; ?>

                <?php else: ?>

                    <div>
                        <h3>Tidak ada pengumuman aktif saat ini.</h3>
                    </div>

                <?php endif; ?>

                <!-- optional pagination jika ada -->
                <?php if (!empty($total_page) && $total_page > 1): ?>
                    <div class="pagination-wrap" style="margin-top:24px;">
                        <?php for ($i = 1; $i <= $total_page; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

<!-- ======= Script: buat card bisa diklik (tanpa mengganggu link di dalamnya) ======= -->
<script>
(function () {
    var cards = document.querySelectorAll('.single-announcement');
    if (!cards || cards.length === 0) return;

    cards.forEach(function(card) {
        card.style.cursor = 'pointer';

        card.addEventListener('click', function(e) {
            // jangan override jika klik pada anchor internal
            if (e.target.closest('a')) return;

            var href = card.getAttribute('data-href');
            if (!href) return;

            if (e.button === 1 || e.ctrlKey || e.metaKey) {
                window.open(href, '_blank');
                return;
            }
            window.location.href = href;
        });

        // keyboard: Enter or Space untuk buka
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                if (document.activeElement && document.activeElement.closest && document.activeElement.closest('a')) {
                    return;
                }
                e.preventDefault();
                var href = card.getAttribute('data-href');
                if (href) window.location.href = href;
            }
        });

        // fokus style class opsional
        card.addEventListener('focus', function(){ card.classList.add('ann-focus'); });
        card.addEventListener('blur', function(){ card.classList.remove('ann-focus'); });
    });
})();
</script>

<style>
/* Fokus visual jika CSS tema belum menyediakannya */
.single-announcement:focus,
.single-announcement.ann-focus {
    outline: 3px solid rgba(8,8,232,0.12);
    outline-offset: 4px;
}
</style>
