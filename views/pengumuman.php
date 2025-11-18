<style>
    /* ======================================= */
    /* Styling Kartu Pengumuman (single-announcement) */
    /* ======================================= */

    .single-announcement {
        background-color: #ffffff;
        padding: 25px;
        /* Jarak di dalam kartu */
        margin-bottom: 25px;
        /* Jarak antar kartu */
        border-radius: 8px;

        /* Efek Shadow agar terlihat seperti kartu */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: box-shadow 0.3s ease;
        border-left: 5px solid #007bff;
        /* Garis vertikal biru untuk menonjolkan */
    }

    .single-announcement:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        /* Shadow lebih tebal saat hover */
    }

    /* ======================================= */
    /* Styling Meta & Ikon */
    /* ======================================= */

    .single-announcement .pengumuman-meta {
        list-style: none;
        padding: 0;
        margin: 0 0 15px 0;
        font-size: 13px;
        color: #888;
        border-bottom: 1px dashed #eee;
        /* Garis pemisah antara meta dan judul */
        padding-bottom: 10px;
    }

    .single-announcement .pengumuman-meta li {
        display: inline-block;
        margin-right: 15px;
    }

    .single-announcement .pengumuman-meta i {
        color: #ff8c00;
        /* Warna oranye untuk ikon (sesuai branding tombol) */
        margin-right: 5px;
    }

    /* ======================================= */
    /* Styling Judul dan Konten */
    /* ======================================= */

    .single-announcement h3 {
        color: #333;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .single-announcement .pengumuman-content p {
        color: #555;
        line-height: 1.6;
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Papan Informasi Sekolah</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Pengumuman</li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div id="pengumuman-list" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <div class="row">
                    <?php
                    // Cek apakah variabel $data_pengumuman sudah diinisialisasi oleh Controller
                    if (isset($data_pengumuman) && count($data_pengumuman) > 0) {
                        foreach ($data_pengumuman as $p) {
                            ?>

                            <div class="col-md-12">
                                <div class="single-announcement">
                                    <ul class="pengumuman-meta">
                                        <li><i class="fa fa-calendar"></i> Tanggal Penting:
                                            <?php echo date('d F Y', strtotime($p['tanggal_penting'])); ?></li>
                                        <li><i class="fa fa-bullhorn"></i> Status: Aktif</li>
                                    </ul>

                                    <h3><?php echo htmlspecialchars($p['judul']); ?></h3>

                                    <div class="pengumuman-content">
                                        <p><?php echo nl2br(htmlspecialchars($p['isi_pengumuman'])); ?></p>
                                    </div>

                                </div>
                            </div>

                        <?php
                        }
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Tidak ada pengumuman aktif saat ini.</h3></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>