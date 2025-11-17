<style>
    /* ======================================= */
    /* Styling Umum Kartu Guru */
    /* ======================================= */

    .single-teacher {
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        /* Penting agar gambar membulat di sudut atas */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
        /* Menjaga jarak antar baris */
    }

    .single-teacher:hover {
        transform: translateY(-5px);
        /* Mengangkat kartu saat di-hover */
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    }

    /* ======================================= */
    /* Styling Foto dan Efek Hover */
    /* ======================================= */

    .teacher-img {
        position: relative;
        overflow: hidden;
    }

    .teacher-img img {
        transition: transform 0.5s ease;
        filter: brightness(0.95);
        /* Sedikit redup */
    }

    .single-teacher:hover .teacher-img img {
        transform: scale(1.05);
        /* Zoom in sedikit saat hover */
        filter: brightness(1.0);
        /* Kembali ke kecerahan normal */
    }

    /* Overlay Sosial/Email */
    .teacher-social {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 123, 255, 0.8);
        /* Overlay Biru Transparan */
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        /* Awalnya tersembunyi */
        transition: opacity 0.3s ease;
    }

    .single-teacher:hover .teacher-social {
        opacity: 1;
        /* Tampil saat hover */
    }

    .teacher-social p {
        color: white;
        font-size: 14px;
        font-weight: 500;
        margin: 0;
        padding: 0 10px;
    }

    /* ======================================= */
    /* Styling Konten Teks */
    /* ======================================= */

    .teacher-content {
        padding: 15px 10px 20px 10px;
        text-align: center;
    }

    .teacher-content h4 {
        font-size: 18px;
        color: #333;
        margin-top: 0;
        margin-bottom: 5px;
    }

    .teacher-content span {
        /* Jabatan */
        display: block;
        color: #ff8c00;
        /* Warna Oranye untuk Jabatan */
        font-weight: 600;
        margin-bottom: 5px;
    }

    .teacher-content .text-muted {
        /* Bidang Studi */
        font-size: 13px;
        color: #888 !important;
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 300px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background1.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Pendidik dan Tenaga Kependidikan SMA Frater Don Bosco Bjm</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Guru dan Staf</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="teachers" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                
                <div class="row">
                    <?php
                    // Cek apakah variabel $data_guru sudah diinisialisasi oleh Controller
                    if (isset($data_guru) && count($data_guru) > 0) {
                        foreach ($data_guru as $guru) {
                            // Tentukan path foto
                            $path_foto = "admin/uploads/guru/" . $guru['foto'];

                            // Jika foto tidak ditemukan, gunakan placeholder
                            if (empty($guru['foto']) || !file_exists($path_foto)) {
                                $path_foto = "./img/placeholder-guru.jpg";
                            }
                            ?>

                            <div class="col-md-3 mb-4">
                                <div class="single-teacher text-center">
                                    <div class="teacher-img">
                                        <img src="<?php echo $path_foto; ?>"
                                            alt="<?php echo htmlspecialchars($guru['nama_lengkap']); ?>"
                                            style="height: 250px; object-fit: cover; width: 100%;">

                                        <div class="teacher-social">
                                            <p>Email: <?php echo htmlspecialchars($guru['email'] ?? 'Tidak Ada'); ?></p>
                                        </div>

                                    </div>
                                    <div class="teacher-content">
                                        <h4><?php echo htmlspecialchars($guru['nama_lengkap']); ?></h4>
                                        <span><?php echo htmlspecialchars($guru['jabatan']); ?></span>
                                        <p class="small text-muted"><?php echo htmlspecialchars($guru['bidang_studi']); ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        echo "<div class='col-md-12 text-center'><h3>Data guru dan staf belum tersedia.</h3></div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>