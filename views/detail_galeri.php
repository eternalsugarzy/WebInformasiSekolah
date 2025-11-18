<style>
/* ======================================= */
/* Tambahan CSS (Jika belum ada di stylesheet Anda) */
/* ======================================= */

/* Perbaikan Hero Area untuk halaman detail */
.hero-area.section h1.white-text {
    font-size: 32px; 
    margin-top: 5px;
    margin-bottom: 5px;
}
.hero-area .col-md-10 {
    padding-top: 100px; /* Tambahkan padding atas agar konten tidak terlalu ke bawah */
}

/* Styling Media Detail Card */
.media-detail-card {
    background-color: #ffffff; 
    border-radius: 10px; 
    padding: 30px; 
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Shadow Kuat untuk membuat kartu menonjol */
    margin-top: -80px; /* Tarik kartu sedikit ke atas hero area */
    position: relative; 
    z-index: 10; 
}

/* Styling Judul Deskripsi */
.media-detail-card .media-info h2 {
    color: #007bff;
    border-bottom: 2px solid #ff8c00; 
    padding-bottom: 10px;
    margin-bottom: 20px;
}

/* Styling Metadata */
.media-detail-card .list-unstyled i {
    color: #ff8c00; /* Ikon berwarna oranye */
    margin-right: 8px;
}

/* Styling Tombol Kembali */
.main-button.icon-button {
    display: inline-flex; 
    align-items: center; 
    white-space: nowrap; 
    background-color: #ff8c00 !important; 
    color: white !important;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: 600;
    text-decoration: none;
    line-height: normal; 
    font-size: 16px;
    transition: background-color 0.3s ease;
}
.main-button.icon-button:hover {
    background-color: #e57d00 !important;
}
.main-button.icon-button::before {
    font-family: 'FontAwesome';
    content: "\f060"; /* Ikon panah ke kiri */
    margin-right: 8px;
}
</style>

<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="galeri.php">Galeri</a></li>
                    <li><?php echo htmlspecialchars($media_item['tipe_media'] ?? 'Media'); ?></li>
                </ul>
                <h1 class="white-text"><?php echo htmlspecialchars($media_item['judul_album'] ?? 'Detail Media'); ?></h1>
            </div>
        </div>
    </div>
</div>

<div id="media-detail" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <div class="media-detail-card">
                
                <div class="media-container" style="margin-bottom: 30px; border-radius: 8px; overflow: hidden;">
                    <?php 
                    // Tentukan jalur media
                    $path = "admin/uploads/galeri/" . ($media_item['file_path'] ?? '');

                    if (($media_item['tipe_media'] ?? '') === 'Foto'):
                    ?>
                        <img src="<?php echo $path; ?>" alt="<?php echo htmlspecialchars($media_item['judul_album'] ?? 'Foto'); ?>" style="width: 100%; height: auto; display: block; border-radius: 8px;">
                    
                    <?php elseif (($media_item['tipe_media'] ?? '') === 'Video'): 
                        // Jika video, tampilkan sebagai iframe (asumsi path adalah embed link YouTube atau sejenisnya)
                    ?>
                        <div class="embed-responsive embed-responsive-16by9" style="position: relative; display: block; width: 100%; padding: 0; overflow: hidden; height: 0; padding-bottom: 56.25%;">
                            <iframe style="position: absolute; top: 0; bottom: 0; left: 0; width: 100%; height: 100%; border:0;" src="<?php echo $path; ?>" allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">Tipe media tidak dikenali atau file tidak ditemukan.</div>
                    <?php endif; ?>
                </div>

                <div class="media-info">
                    <h2 style="color: #007bff; border-bottom: 2px solid #ff8c00; padding-bottom: 10px; margin-bottom: 20px;">Deskripsi Kegiatan</h2>
                    
                    <p class="lead"><?php echo nl2br(htmlspecialchars($media_item['deskripsi'] ?? 'Tidak ada deskripsi tersedia.')); ?></p>
                    
                    <hr style="margin-top: 30px; margin-bottom: 20px;">
                    
                    <ul class="list-unstyled metadata">
                        <li><i class="fa fa-calendar"></i> **Tanggal Acara:** <?php echo date('d F Y', strtotime($media_item['tanggal_event'] ?? '1970-01-01')); ?></li>
                        <li><i class="fa fa-tag"></i> **Tipe Media:** <?php echo htmlspecialchars($media_item['tipe_media'] ?? 'N/A'); ?></li>
                    </ul>
                </div>
                
                <div style="margin-top: 40px; text-align: left;">
                    <a href="galeri.php" class="main-button icon-button">
                        Kembali ke Arsip Galeri
                    </a>
                </div>

                </div>
                </div>
        </div>
    </div>
</div>