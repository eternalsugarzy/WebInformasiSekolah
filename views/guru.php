<?php


/*
  Standalone page: "Guru & Staf" dengan carousel (Swiper.js)
  Pastikan:
  - $data_guru diisi oleh Controller / sebelum include file ini, atau
    server akan menampilkan placeholder kalau tidak ada data.
  - Foto guru di folder: admin/uploads/guru/<nama_file>
*/

$title = "Guru dan Staf - SMA Frater Don Bosco Bjm";

/* 
  Example dummy data jika $data_guru belum didefinisikan.
  Hapus / comment bagian ini kalau Anda sudah mengisi $data_guru dari DB.
*/
if (!isset($data_guru)) {
    $data_guru = [
        [
            'nama_lengkap' => 'Budi Santoso',
            'jabatan' => 'Guru Matematika',
            'bidang_studi' => 'Matematika',
            'email' => 'budi@example.com',
            'foto' => '' // kosong -> pakai placeholder
        ],
        [
            'nama_lengkap' => 'Siti Aminah',
            'jabatan' => 'Kepala Sekolah',
            'bidang_studi' => 'Manajemen Pendidikan',
            'email' => 'siti@example.com',
            'foto' => '' 
        ],
        [
            'nama_lengkap' => 'Andi Wijaya',
            'jabatan' => 'Guru Olahraga',
            'bidang_studi' => 'Pendidikan Jasmani',
            'email' => 'andi@example.com',
            'foto' => ''
        ],
        [
            'nama_lengkap' => 'Dewi Lestari',
            'jabatan' => 'Guru Bahasa Inggris',
            'bidang_studi' => 'Bahasa Inggris',
            'email' => 'dewi@example.com',
            'foto' => ''
        ],
        // ... tambah lebih banyak bila perlu
    ];
}

$current_keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';
if ($current_keyword !== '') {
    // Filter sederhana (nama/jabatan/bidang)
    $filtered = [];
    foreach ($data_guru as $g) {
        if (stripos($g['nama_lengkap'], $current_keyword) !== false
            || stripos($g['jabatan'], $current_keyword) !== false
            || stripos($g['bidang_studi'], $current_keyword) !== false) {
            $filtered[] = $g;
        }
    }
    $data_guru = $filtered;
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>

    <!-- Bootstrap (opsional - Anda sudah punya bootstrap di project) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <style>
    /* ===========================
       Reset / Utility
       =========================== */
    body {
        font-family: "Montserrat", Arial, sans-serif;
        background: #f7f9fc;
        margin: 0;
        color: #333;
    }
    a { text-decoration: none; }

    /* ===========================
       Hero area
       =========================== */
    .hero-area {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .hero-area .bg-image {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-size: cover;
        background-position: center;
        z-index: 0;
    }
    .hero-area .overlay {
        background-color: rgba(0,0,0,0.45);
    }
    .hero-area .container {
        position: relative;
        z-index: 2;
    }
    .logo-header-berita { display:block; margin: 0 auto 10px; }

    .hero-area h1.white-text {
        color: #fff;
        font-size: 28px;
        margin: 10px 0 5px;
        font-weight: 700;
    }
    .hero-area .hero-area-tree {
        list-style: none;
        padding: 0;
        margin: 0;
        color: #fff;
        opacity: 0.9;
    }
    .hero-area .hero-area-tree li { display: inline-block; margin: 0 6px; color: #fff; }
    .hero-area .hero-area-tree a { color: #ffdca8; }

    /* ===========================
       Teacher card base (Anda sudah punya; saya satukan)
       =========================== */
    .single-teacher {
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 16px;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .single-teacher:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .teacher-img {
        position: relative;
        overflow: hidden;
        width: 100%;
    }
    .teacher-img img {
        transition: transform 0.5s ease;
        filter: brightness(0.95);
        width: 100%;
        display: block;
    }
    .single-teacher:hover .teacher-img img {
        transform: scale(1.05);
        filter: brightness(1);
    }

   
    .single-teacher:hover .teacher-social { opacity: 1; }
    .teacher-social p { color: #fff; margin: 0; font-weight: 600; }

    .teacher-content {
        padding: 14px 12px 18px;
        text-align: center;
        flex-grow: 1;
    }
    .teacher-content h4 { font-size: 18px; color: #222; margin: 0 0 6px; }
    .teacher-content span { display:block; color: #ff8c00; font-weight:600; margin-bottom:6px; }
    .teacher-content .text-muted { color: #888 !important; font-size: 13px; margin: 0; }

    .main-button {
        background-color: #007bff;
        color: white;
        font-weight: 600;
        border-radius: 5px;
        padding: 10px 18px;
        line-height: normal;
        border: none;
        display: inline-block;
    }

    /* ===========================
       Swiper customizations
       =========================== */
    .my-teacher-swiper { position: relative; padding: 10px 10px 30px; }
    .my-teacher-swiper .swiper-wrapper { align-items: stretch; } /* slide stretch tinggi agar kartu sama */
    .my-teacher-swiper .swiper-slide {
        width: auto;
        display: flex;
        justify-content: center;
        box-sizing: border-box;
        padding: 8px;
    }

    .my-teacher-swiper .single-teacher { max-width: 280px; width: 100%; }

    .teacher-img img { height: 240px; object-fit: cover; }

    .swiper-button-next, .swiper-button-prev {
        color: #333;
        top: 40%;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255,255,255,0.92);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 16px;
        font-weight: 700;
    }

    .swiper-pagination-bullet { background: rgba(0,0,0,0.2); }
    .swiper-pagination-bullet-active { background: #007bff; }

    @media (max-width: 480px) {
        .single-teacher { max-width: 92%; }
        .hero-area h1.white-text { font-size: 20px; }
    }
    </style>
</head>
<body>

<!-- HERO -->
<div class="hero-area section" style="height: 40vh; min-height: 280px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url('./img/page-background2.jpg')"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita" style="max-height: 120px;">
                <h1 class="white-text">Pendidik dan Tenaga Kependidikan SMA Frater Don Bosco Bjm</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li> / </li>
                    <li>Guru dan Staf</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- TEACHERS -->
<div id="teachers" class="section" style="padding: 40px 0;">
    <div class="container">

        <div class="row" style="margin-bottom: 24px;">
            <div class="col-md-8 col-md-offset-2">
                <form action="" method="GET" class="form-horizontal">
                    <div class="input-group">
                        <input type="text"
                               name="cari"
                               class="form-control"
                               placeholder="Cari Guru berdasarkan Nama, Jabatan, atau Mata Pelajaran..."
                               value="<?php echo htmlspecialchars($current_keyword); ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-primary main-button" type="submit" style="height:40px;">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!-- SWIPER -->
        <div class="row">
            <div class="col-md-12">
                <?php if (isset($data_guru) && count($data_guru) > 0): ?>
                <div class="swiper my-teacher-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($data_guru as $guru): 
                            $path_foto = "admin/uploads/guru/" . ($guru['foto'] ?? '');
                            if (empty($guru['foto']) || !file_exists($path_foto)) {
                                $path_foto = "./img/placeholder-guru.jpg";
                            }
                            // safe outputs
                            $nama = htmlspecialchars($guru['nama_lengkap'] ?? 'Nama Tidak Diketahui');
                            $jabatan = htmlspecialchars($guru['jabatan'] ?? '-');
                            $bidang = htmlspecialchars($guru['bidang_studi'] ?? '-');
                            $email = htmlspecialchars($guru['email'] ?? 'Tidak Ada');
                        ?>
                        <div class="swiper-slide">
                            <div class="single-teacher">
                                <div class="teacher-img">
                                    <img src="<?php echo $path_foto; ?>" alt="<?php echo $nama; ?>">
                                    <div class="teacher-social">
                                        <p>Email: <?php echo $email; ?></p>
                                    </div>
                                </div>
                                <div class="teacher-content">
                                    <h4><?php echo $nama; ?></h4>
                                    <span style="color: <?php echo ($jabatan === 'Kepala Sekolah' || stripos($jabatan, 'Wali Kelas') !== false) ? '#dc3545' : '#ff8c00'; ?>;">
                                        <?php echo $jabatan; ?>
                                    </span>
                                    <p class="small text-muted"><?php echo $bidang; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- navigasi -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <?php else: ?>
                    <div class="text-center">
                        <h3>
                            <?php
                            if (!empty($current_keyword)) {
                                echo "Data guru tidak ditemukan untuk pencarian '" . htmlspecialchars($current_keyword) . "'.";
                            } else {
                                echo "Data guru dan staf belum tersedia.";
                            }
                            ?>
                        </h3>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  const teacherSwiper = new Swiper('.my-teacher-swiper', {
    slidesPerView: 4,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      576: {
        slidesPerView: 2,
        spaceBetween: 12,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 16,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 20,
      }
    }
  });
</script>

</body>
</html>
