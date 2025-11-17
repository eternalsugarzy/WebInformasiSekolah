<style>
    /* ======================================= */
    /* CSS Umum Profil */
    /* ======================================= */

    #about-school {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .blockquote-visi p {
        /* Mengatur jarak antar baris agar tidak menumpuk */
        line-height: 1.6 !important;

        /* Mengatur ukuran font ke standar agar tidak terlalu besar */
        font-size: 16px;
        /* Sesuaikan angka ini sesuai template dasar Anda */

        /* Memastikan teks memiliki ruang yang cukup di sekitar tanda kutip pseudo-element */
        padding-left: 20px;

        /* Menghapus margin yang mungkin mendorong teks keluar */
        margin-bottom: 0;
    }

    /* Styling Header Section */
    .section-header h2 {
        color: #007bff;
        /* Warna biru untuk Judul Utama */
        border-bottom: 2px solid #ff8c00;
        /* Garis oranye di bawah judul */
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    /* ======================================= */
    /* Styling Visi & Misi (Card-Style) */
    /* ======================================= */

    .card-vision-mission {
        background-color: #f8f9fa;
        /* Latar belakang abu-abu muda */
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        height: 100%;
        /* Memastikan tinggi kartu sama */
    }

    /* Visi Blockquote */
    .blockquote-visi {
        border-left: 5px solid #ff8c00;
        /* Garis Oranye untuk Visi */
        padding-left: 20px;
        font-style: italic;
        font-size: 1.1em;
        margin-top: 15px;
        margin-bottom: 15px;
    }

    /* Misi List Style */
    .list-style-misi {
        list-style: none;
        padding-left: 0;
    }

    .list-style-misi li {
        margin-bottom: 10px;
        font-size: 1em;
    }

    .list-style-misi i.fa-check {
        color: #28a745;
        /* Ikon Hijau untuk Misi yang berhasil */
        margin-right: 8px;
    }

    /* ======================================= */
    /* Styling Fasilitas */
    /* ======================================= */

    .list-style-fasilitas {
        list-style: none;
        padding: 0;
        margin-top: 15px;
        display: flex;
        flex-wrap: wrap;
    }

    .list-style-fasilitas li {
        background-color: #e9ecef;
        /* Badge abu-abu untuk item fasilitas */
        border-radius: 5px;
        padding: 10px 15px;
        margin: 5px;
        font-size: 0.95em;
    }

    .list-style-fasilitas i.fa-building-o {
        color: #007bff;
        /* Ikon biru untuk Fasilitas */
        margin-right: 8px;
    }

    .list-style-misi li {
        /* 1. Mengaktifkan Flexbox pada setiap item list */
        display: flex;

        /* 2. Memastikan baris teks berikutnya tetap di bawah baris teks pertama */
        align-items: flex-start;
        /* Penting untuk penjajaran multi-baris */

        margin-bottom: 10px;
        /* Jarak antar item list */
    }

    .list-style-misi i.fa-check {
        /* 3. Memberikan ikon ukuran dan margin kanan tetap */
        flex-shrink: 0;
        /* Mencegah ikon menyusut */
        margin-right: 8px;
        /* Jarak antara ikon dan teks */
        padding-top: 3px;
        /* Opsional: sedikit geser ikon ke bawah agar sejajar dengan teks */
    }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 300px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background1.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" 
                     alt="Logo SMA Frater Don Bosco Bjm" 
                     class="logo-header-berita"
                     style="max-height: 80px; margin-bottom: 15px;"> 
                <h1 class="white-text">Tentang SMA Frater Don Bosco Bjm</h1>
                 <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Profil Sekolah</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="about-school" class="section">
    <div class="container">
        <div class="row">

            <div class="col-md-7">
                <div class="card-vision-mission">
                    <div class="section-header">
                        <h2><i class="fa fa-history"></i> Sejarah Sekolah</h2>
                    </div>
                    <p><?php echo htmlspecialchars($data_profil['sejarah'] ?? 'Data sejarah belum diatur.'); ?></p>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card-vision-mission" style="height: 100%;">

                    <div class="section-header">
                        <h2><i class="fa fa-eye"></i> Visi</h2>
                    </div>
                    <blockquote class="blockquote-visi">
                        <p><?php echo nl2br(htmlspecialchars($data_profil['visi'] ?? 'Visi belum diatur.')); ?></p>
                    </blockquote>

                    <div class="section-header" style="margin-top: 25px;">
                        <h2><i class="fa fa-tasks"></i> Misi</h2>
                    </div>
                    <ul class="list-style-misi">
                        <?php
                        if (!empty($data_profil['misi'])) {
                            foreach ($data_profil['misi'] as $misi) {
                                echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($misi) . '</li>';
                            }
                        } else {
                            echo '<li><i class="fa fa-info-circle"></i> Misi belum diatur.</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-12">
                <div class="section-header" style="margin-top: 30px;">
                    <h2><i class="fa fa-wrench"></i> Fasilitas Utama</h2>
                </div>
                <ul class="list-style-fasilitas">
                    <?php
                    if (!empty($data_profil['fasilitas'])) {
                        foreach ($data_profil['fasilitas'] as $fasilitas) {
                            // Menggunakan col-md-3 agar fasilitas berjajar 4 kolom
                            echo '<div class="col-md-3"><li><i class="fa fa-building-o"></i> ' . htmlspecialchars($fasilitas) . '</li></div>';
                        }
                    } else {
                        echo '<div class="col-md-12"><li><i class="fa fa-info-circle"></i> Data fasilitas belum diatur.</li></div>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>