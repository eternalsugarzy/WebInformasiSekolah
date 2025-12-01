<style>
    /* ========== GLOBAL ========== */
    #about-school {
        background: linear-gradient(180deg, #f4f6f9, #ffffff);
        padding: 90px 0;
    }

    /* ========== JUDUL ========== */
    .profile-section-title {
        font-size: 30px;
        font-weight: 800;
        color: #001f3f;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 18px;
    }

    .profile-section-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #FF6700, #ff9f45);
        border-radius: 10px;
    }

    .text-center .profile-section-title:after {
        left: 50%;
        transform: translateX(-50%);
    }

    /* ========== CARD UMUM ========== */
    .profile-card {
        background: #fff;
        padding: 45px;
        border-radius: 14px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        margin-bottom: 50px;
        border-top: 5px solid #FF6700;
        transition: 0.4s ease;
    }

    .profile-card:hover {
        transform: translateY(-8px);
    }

    /* ========== SEJARAH ========== */
    .history-text {
        font-size: 16px;
        line-height: 1.9;
        color: #444;
        text-align: justify;
    }

    /* ========== VISI ========== */
    .visi-box {
        background: linear-gradient(135deg, #fff3e8, #ffe0c2);
        border-left: 6px solid #FF6700;
        padding: 28px;
        font-style: italic;
        font-size: 18px;
        color: #333;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    /* ========== MISI ========== */
    .misi-list {
        list-style: none;
        padding: 0;
    }

    .misi-list li {
        position: relative;
        padding-left: 32px;
        margin-bottom: 16px;
        font-size: 15px;
        color: #444;
        line-height: 1.7;
    }

    .misi-list li:before {
        content: '\f058';
        font-family: 'FontAwesome';
        position: absolute;
        left: 0;
        top: 1px;
        color: #FF6700;
        font-size: 17px;
    }

    /* ========== FASILITAS ========== */
    .facility-item {
        background: #fff;
        padding: 18px;
        border-radius: 12px;
        border: 1px solid #eee;
        display: flex;
        align-items: center;
        margin-bottom: 22px;
        transition: 0.3s;
    }

    .facility-item:hover {
        background: linear-gradient(135deg, #001f3f, #003366);
        color: #fff;
        transform: translateY(-6px);
    }

    .facility-icon {
        width: 45px;
        height: 45px;
        background: #f2f2f2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 14px;
        font-size: 18px;
    }

    .facility-item:hover .facility-icon {
        background: #FF6700;
        color: #fff;
    }

    .facility-name {
        font-weight: 700;
        font-size: 14px;
    }

    /* ========== KEPALA SEKOLAH ========== */
    .kepsek-card {
        display: flex;
        align-items: center;
        gap: 35px;
    }

    .kepsek-photo {
        width: 200px;
        height: 240px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        flex-shrink: 0;
    }

    .kepsek-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .kepsek-info h3 {
        font-size: 24px;
        font-weight: 800;
        color: #001f3f;
        margin-bottom: 10px;
    }

    .kepsek-info span {
        display: inline-block;
        background: #FF6700;
        color: #fff;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .kepsek-info p {
        font-size: 15px;
        color: #444;
        line-height: 1.8;
        margin-top: 10px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .kepsek-card {
            flex-direction: column;
            text-align: center;
        }
    }


    /* ========== HERO ========== */
    /*.hero-area {
    border-bottom-left-radius: 60px;
    border-bottom-right-radius: 60px;
    overflow: hidden;
}

.hero-area .bg-parallax.overlay {
    background: linear-gradient(
        rgba(0, 31, 63, 0.7),
        rgba(0, 31, 63, 0.7)
    ), url(./img/page-background2.jpg) center/cover;
}*/
</style>

<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 130px;">
                <h1 class="white-text">Tentang Sekolah Kami</h1>

                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Profil</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="about-school">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-card">

                    <div class="kepsek-card">

                        <!-- FOTO KEPALA SEKOLAH -->
                        <div class="kepsek-photo">
                            <?php
                            $foto_kepsek = !empty($kepsek['foto'])
                                ? "admin/uploads/guru/" . $kepsek['foto']
                                : "img/default-user.png";
                            ?>
                            <img src="<?= $foto_kepsek; ?>" alt="Kepala Sekolah">
                        </div>

                        <!-- INFO KEPALA SEKOLAH -->
                        <div class="kepsek-info">
                            <h3>
                                <?= htmlspecialchars($kepsek['nama_lengkap'] ?? 'Nama Kepala Sekolah'); ?>
                            </h3>

                            <span><?= htmlspecialchars($kepsek['jabatan'] ?? 'Kepala Sekolah'); ?></span>

                            <p>
                                <?= nl2br(htmlspecialchars(
                                    $profil['sambutan_kepsek']
                                    ?? 'Sambutan kepala sekolah belum tersedia.'
                                )); ?>
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

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
                                <i class="fa fa-quote-left"
                                    style="font-size: 14px; color: #FF6700; vertical-align: top;"></i>
                                <?php echo nl2br(htmlspecialchars($profil['visi'] ?? 'Visi belum diisi.')); ?>
                                <i class="fa fa-quote-right"
                                    style="font-size: 14px; color: #FF6700; vertical-align: bottom;"></i>
                            </div>
                            <p class="text-muted" style="font-size: 13px; margin-bottom: 30px;">"Visi adalah cita-cita
                                luhur yang ingin kami capai di masa depan."</p>
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
                        <p class="text-muted" style="margin-bottom: 30px;">Kami menyediakan sarana dan prasarana terbaik
                            untuk menunjang proses belajar mengajar.</p>
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