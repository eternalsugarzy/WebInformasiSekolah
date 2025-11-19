<style>
/* ======================================= */
/* CSS Asli dari Template Anda */
/* ======================================= */

.hero-area.section h1.white-text {
    font-size: 32px; margin-top: 5px; margin-bottom: 5px;
}
.hero-area .col-md-10 { padding-top: 100px; }

.media-detail-card {
    background-color: #ffffff; 
    border-radius: 10px; 
    padding: 30px; 
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); 
    margin-top: -80px; 
    position: relative; 
    z-index: 10; 
}

.media-detail-card .media-info h2 {
    color: #007bff;
    border-bottom: 2px solid #ff8c00; 
    padding-bottom: 10px;
    margin-bottom: 20px;
    font-size: 24px;
}

.media-detail-card .list-unstyled i {
    color: #ff8c00; margin-right: 8px;
}

.main-button.icon-button {
    display: inline-flex; align-items: center; white-space: nowrap; 
    background-color: #ff8c00 !important; color: white !important;
    padding: 10px 20px; border-radius: 5px; font-weight: 600;
    text-decoration: none; font-size: 16px; transition: background-color 0.3s ease;
}
.main-button.icon-button:hover { background-color: #e57d00 !important; }
.main-button.icon-button::before { font-family: 'FontAwesome'; content: "\f060"; margin-right: 8px; }

/* ======================================= */
/* CSS Tambahan untuk Grid Foto (Multiple) */
/* ======================================= */
.gallery-grid-item {
    margin-bottom: 20px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    cursor: pointer;
    border: 1px solid #eee;
}
.gallery-grid-item img {
    width: 100%;
    height: 180px; /* Tinggi seragam agar rapi */
    object-fit: cover;
    transition: transform 0.4s ease;
}
.gallery-grid-item:hover img {
    transform: scale(1.1);
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
                    <li>Detail</li>
                </ul>
                <h1 class="white-text"><?php echo htmlspecialchars($album['judul_album'] ?? 'Detail Album'); ?></h1>
            </div>
        </div>
    </div>
</div>

<div id="media-detail" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <div class="media-detail-card">
                
                    <div class="media-info">
                        <h2>Deskripsi Kegiatan</h2>
                        
                        <p class="lead"><?php echo nl2br(htmlspecialchars($album['deskripsi'] ?? 'Tidak ada deskripsi tersedia.')); ?></p>
                        
                        <hr style="margin-top: 20px; margin-bottom: 20px;">
                        
                        <ul class="list-unstyled metadata">
                            <li><i class="fa fa-calendar"></i> <b>Tanggal Acara:</b> <?php echo date('d F Y', strtotime($album['tanggal_event'] ?? '1970-01-01')); ?></li>
                            <li><i class="fa fa-camera"></i> <b>Total Foto:</b> <?php echo count($fotos); ?> Item</li>
                        </ul>
                    </div>

                    <hr>

                    <h4 style="margin-bottom: 20px; color: #333;">Dokumentasi Foto:</h4>
                    
                    <div class="row">
                        <?php 
                        if (isset($fotos) && count($fotos) > 0) {
                            foreach ($fotos as $f) {
                                // Jalur file fisik
                                $path = "admin/uploads/galeri/" . $f['file_foto'];
                                
                                // Cek file ada atau tidak
                                if (!file_exists($path)) {
                                    $path = "./img/placeholder-galeri.jpg";
                                }
                        ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="gallery-grid-item">
                                <a href="<?php echo $path; ?>" target="_blank" title="Klik untuk memperbesar">
                                    <img src="<?php echo $path; ?>" alt="Foto Dokumentasi">
                                </a>
                            </div>
                        </div>
                        <?php 
                            } // End foreach
                        } else {
                            echo "<div class='col-md-12'><div class='alert alert-warning'>Belum ada foto di album ini.</div></div>";
                        }
                        ?>
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