<style>
    /* 1. Section Styling */
    #about-school {
        background-color: #f4f6f9; /* Background abu muda agar konten putih menonjol */
        padding-top: 80px;
        padding-bottom: 80px;
    }

    /* 2. Typography Header */
    .profile-section-title {
        font-size: 28px;
        font-weight: 700;
        color: #2B2D42;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 15px;
    }
    .profile-section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background-color: #FF6700; /* Garis oranye di bawah judul */
        border-radius: 2px;
    }
    .text-center .profile-section-title:after {
        left: 50%;
        transform: translateX(-50%);
    }

    /* 3. Card Style (Kotak Putih) */
    .profile-card {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); /* Bayangan lembut */
        margin-bottom: 40px;
        border-top: 4px solid transparent;
        transition: transform 0.3s ease;
    }
    .profile-card:hover {
        transform: translateY(-5px);
        border-top-color: #FF6700;
    }

    /* 4. Sejarah Text */
    .history-text {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        text-align: justify;
    }

    /* 5. Visi Misi Styling */
    .visi-box {
        background-color: #fff5eb; /* Latar oranye sangat muda */
        border-left: 5px solid #FF6700;
        padding: 20px;
        font-style: italic;
        font-size: 18px;
        color: #333;
        border-radius: 0 8px 8px 0;
        margin-bottom: 20px;
    }
    .misi-list {
        list-style: none;
        padding: 0;
    }
    .misi-list li {
        position: relative;
        padding-left: 30px;
        margin-bottom: 15px;
        font-size: 15px;
        color: #444;
        line-height: 1.6;
    }
    .misi-list li:before {
        content: '\f00c'; /* FontAwesome Check */
        font-family: 'FontAwesome';
        position: absolute;
        left: 0;
        top: 2px;
        color: #2ecc71; /* Warna hijau */
        font-size: 16px;
    }

    /* 6. Fasilitas Grid */
    .facility-item {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        transition: 0.3s;
    }
    .facility-item:hover {
        background: #001f3f;
        border-color: #001f3f;
        color: #fff;
        transform: translateX(5px);
    }
    .facility-icon {
        width: 40px;
        height: 40px;
        background: #f0f0f0;
        color: #333;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 18px;
        transition: 0.3s;
    }
    .facility-item:hover .facility-icon {
        background: #FF6700;
        color: #fff;
    }
    .facility-name {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
    }

    /* 7. Guru Card (Mirip Berita tapi Portrait) */
    .guru-card {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
        margin-bottom: 30px;
        text-align: center;
        border-bottom: 3px solid transparent;
    }
    .guru-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-bottom-color: #FF6700;
    }
    .guru-img-box {
        height: 280px;
        overflow: hidden;
        position: relative;
    }
    .guru-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s;
    }
    .guru-card:hover .guru-img-box img {
        transform: scale(1.1);
    }
    .guru-info {
        padding: 20px;
    }
    .guru-role {
        display: inline-block;
        background: #eef2f5;
        color: #FF6700;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    .guru-name {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin: 0 0 5px;
    }
    .guru-mapel {
        font-size: 13px;
        color: #777;
    }
</style>

<div class="hero-area section" style="height: 50vh; min-height: 400px;">
    
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Profil</li>
                </ul>
                <h1 class="white-text">Tentang Sekolah Kami</h1>
                <p class="white-text lead" style="font-weight: 300;">Mengenal lebih dekat sejarah, visi, misi, dan tenaga pendidik.</p>
            </div>
        </div>
    </div>
</div>

<div id="about-school">
    <div class="container">
        
        <div class="profile-card">
            <div class="row">
                <div class="col-md-5">
                    <div style="border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <img src="./img/about.png" alt="Gedung Sekolah" style="width: 100%; display: block;">
                    </div>
                </div>
                <div class="col-md-7">
                    <h2 class="profile-section-title">Sejarah Singkat</h2>
                    <div class="history-text">
                        <?php 
                            // Jika data kosong, tampilkan placeholder
                            echo nl2br(htmlspecialchars($profil['sejarah'] ?? 'Data sejarah sekolah belum diisi oleh admin.')); 
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="profile-card">
                    
                    <div class="row">
                        <div class="col-md-5">
                            <h2 class="profile-section-title">Visi Sekolah</h2>
                            <div class="visi-box">
                                <i class="fa fa-quote-left" style="font-size: 14px; color: #FF6700; vertical-align: top;"></i> 
                                <?php echo nl2br(htmlspecialchars($profil['visi'] ?? 'Visi belum diisi.')); ?>
                                <i class="fa fa-quote-right" style="font-size: 14px; color: #FF6700; vertical-align: bottom;"></i>
                            </div>
                            <p class="text-muted" style="font-size: 13px; margin-bottom: 30px;">"Visi adalah cita-cita luhur yang ingin kami capai di masa depan."</p>
                        </div>

                        <div class="col-md-7" style="border-left: 1px solid #eee; padding-left: 30px;">
                            <h2 class="profile-section-title">Misi Sekolah</h2>
                            <ul class="misi-list">
                                <?php
                                if (!empty($profil['misi'])) {
                                    // Pisahkan misi berdasarkan baris baru (Enter)
                                    $misi_array = explode("\n", $profil['misi']); 
                                    foreach ($misi_array as $m) {
                                        if (trim($m) != "") {
                                            echo '<li>' . htmlspecialchars(trim($m)) . '</li>';
                                        }
                                    }
                                } else {
                                    echo '<li>Misi belum diisi.</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="profile-card">
                    <div class="text-center">
                        <h2 class="profile-section-title">Fasilitas Utama</h2>
                        <p class="text-muted" style="margin-bottom: 30px;">Kami menyediakan sarana dan prasarana terbaik untuk menunjang proses belajar mengajar.</p>
                    </div>
                    
                    <div class="row">
                        <?php
                        if (!empty($profil['fasilitas'])) {
                            // Cek pemisah: Koma atau Enter
                            if (strpos($profil['fasilitas'], ',') !== false) {
                                $fasilitas_array = explode(",", $profil['fasilitas']);
                            } else {
                                $fasilitas_array = explode("\n", $profil['fasilitas']);
                            }

                            foreach ($fasilitas_array as $f) {
                                if (trim($f) != "") {
                        ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="facility-item">
                                        <div class="facility-icon"><i class="fa fa-check"></i></div>
                                        <div class="facility-name"><?php echo htmlspecialchars(trim($f)); ?></div>
                                    </div>
                                </div>
                        <?php
                                }
                            }
                        } else {
                            echo '<div class="col-md-12 text-center text-muted">Data fasilitas belum diisi.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


