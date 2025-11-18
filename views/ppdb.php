<style>
    /* ======================================= */
/* Styling Umum Kartu PPDB */
/* ======================================= */

.ppdb-card {
    background-color: #ffffff;
    border-radius: 10px;
    margin-bottom: 35px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.ppdb-header {
    background-color: #f8f9fa; /* Latar belakang abu-abu muda untuk header */
    padding: 15px 25px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ppdb-header h3 {
    font-size: 1.4em;
    color: #333;
    font-weight: 700;
    margin: 0;
    flex-grow: 1;
}

.ppdb-body {
    padding: 25px;
}

/* ======================================= */
/* Styling Status/Badge */
/* ======================================= */

/* Base Badge Style */
.badge {
    padding: 8px 12px;
    border-radius: 5px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.85em;
    white-space: nowrap; /* Mencegah status melompat baris */
}

/* Warna Status */
.badge-success { /* SEDANG BERLANGSUNG */
    background-color: #28a745; 
    color: white;
}

.badge-warning { /* AKAN DATANG */
    background-color: #ffc107;
    color: #343a40;
}

.badge-secondary { /* SUDAH BERAKHIR */
    background-color: #6c757d;
    color: white;
}

.badge-danger { /* TIDAK TERSEDIA */
    background-color: #dc3545;
    color: white;
}

/* ======================================= */
/* Styling Konten & Tombol Daftar */
/* ======================================= */

.ppdb-body p.text-info {
    font-weight: 600;
    color: #007bff; /* Warna Biru untuk periode */
    border-bottom: 1px dashed #eee;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.ppdb-body .detail-isi {
    line-height: 1.6;
    color: #555;
    margin-bottom: 20px;
}
</style>


<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Penerimaan Peserta Didik Baru (PPDB)</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>PPDB</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="ppdb-info" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="section-header text-center">
                    <h2>SMA Frater Don Bosco Bjm Tahun Ajaran Terbaru</h2>
                </div>

                <?php 
                if (isset($data_ppdb) && count($data_ppdb) > 0) { 
                    foreach ($data_ppdb as $info) {
                        // Cek apakah ada tanggal dan buat status periode
                        $tgl_mulai = strtotime($info['tanggal_mulai'] ?? '1970-01-01');
                        $tgl_akhir = strtotime($info['tanggal_akhir'] ?? '1970-01-01');
                        $today = time();
                        
                        $status_periode = "Tidak Tersedia";
                        $badge_class = "danger";
                        
                        if ($tgl_mulai > 0 && $tgl_akhir > 0) {
                            if ($today >= $tgl_mulai && $today <= $tgl_akhir) {
                                $status_periode = "SEDANG BERLANGSUNG";
                                $badge_class = "success";
                            } elseif ($today < $tgl_mulai) {
                                $status_periode = "AKAN DATANG";
                                $badge_class = "warning";
                            } else {
                                $status_periode = "SUDAH BERAKHIR";
                                $badge_class = "secondary";
                            }
                        }
                ?>
                
                <div class="ppdb-card mb-4">
                    <div class="ppdb-header">
                        <h3><?php echo htmlspecialchars($info['jenis_informasi']); ?></h3>
                        <span class="badge badge-<?php echo $badge_class; ?>"><?php echo $status_periode; ?></span>
                    </div>
                    
                    <div class="ppdb-body">
                        <?php if ($tgl_mulai > 0 && $tgl_akhir > 0): ?>
                        <p class="text-info">
                            <i class="fa fa-calendar"></i> Periode: **<?php echo date('d F Y', $tgl_mulai); ?>** hingga **<?php echo date('d F Y', $tgl_akhir); ?>**
                        </p>
                        <?php endif; ?>
                        
                        <div class="detail-isi">
                            <?php echo nl2br(htmlspecialchars($info['isi_detail'])); ?>
                        </div>
                        
                        <?php if (!empty($info['tautan_formulir']) && $badge_class == 'success'): ?>
                            <a href="<?php echo htmlspecialchars($info['tautan_formulir']); ?>" target="_blank" class="main-button icon-button" style="background-color: #ff8c00; color: white;">
                                Daftar Sekarang <i class="fa fa-arrow-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <?php 
                    } 
                } else {
                    echo "<div class='col-md-12 text-center'><h3>Informasi PPDB belum diumumkan. Silakan cek berkala.</h3></div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>