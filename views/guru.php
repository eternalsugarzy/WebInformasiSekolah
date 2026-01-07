<?php
/*
  Standalone page: "Guru & Staf"
*/
$title = "Guru dan Staf - SMA Frater Don Bosco Bjm";

$current_keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';
if ($current_keyword !== '') {
    $filtered = [];
    foreach ($data_guru as $g) {
        if (stripos($g['nama_lengkap'], $current_keyword) !== false || 
            stripos($g['jabatan'], $current_keyword) !== false || 
            stripos($g['bidang_studi'], $current_keyword) !== false) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        body { font-family: "Montserrat", Arial, sans-serif; background: #f7f9fc; margin: 0; color: #333; }
        a { text-decoration: none; }

        /* HERO AREA */
        .hero-area { position: relative; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .hero-area .bg-image { position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-size: cover; background-position: center; z-index: 0; }
        .hero-area .overlay { background-color: rgba(0, 0, 0, 0.45); }
        .hero-area .container { position: relative; z-index: 2; }
        .logo-header-berita { display: block; margin: 0 auto 10px; }
        .hero-area h1.white-text { color: #fff; font-size: 28px; margin: 10px 0 5px; font-weight: 700; }
        .hero-area .hero-area-tree { list-style: none; padding: 0; margin: 0; color: #fff; opacity: 0.9; }
        .hero-area .hero-area-tree li { display: inline-block; margin: 0 6px; }
        .hero-area .hero-area-tree a { color: #ffdca8; }

        /* SWIPER BASE */
        .my-teacher-swiper { position: relative; }
        .my-teacher-swiper .swiper-wrapper { display: flex; align-items: stretch; }
        .my-teacher-swiper .swiper-slide { height: auto; display: flex; flex-direction: column; padding-bottom: 40px; }

        /* TEACHER CARD */
        .single-teacher {
            background-color: #ffffff; border-radius: 12px; overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); transition: all 0.3s ease;
            display: flex; flex-direction: column; height: 100%; width: 100%;
        }
        .single-teacher:hover { transform: translateY(-6px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12); }

        .teacher-img { position: relative; width: 100%; height: 300px; overflow: hidden; background-color: #f0f0f0; }
        .teacher-img img { width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.5s ease; display: block; }
        .single-teacher:hover .teacher-img img { transform: scale(1.05); }

        .teacher-social {
            position: absolute; bottom: 0; left: 0; right: 0; opacity: 0;
            background: rgba(0, 31, 63, 0.8); color: #fff; padding: 10px;
            text-align: center; transition: 0.3s ease;
        }
        .single-teacher:hover .teacher-social { opacity: 1; }
        .teacher-social p { margin: 0; font-weight: 600; color: #fff; }

        .teacher-content { padding: 20px 15px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; justify-content: flex-start; }
        .teacher-content h4 { font-size: 17px; font-weight: 700; color: #222; margin: 0 0 8px; min-height: 40px; display: flex; align-items: center; justify-content: center; }
        .teacher-content span { font-size: 14px; font-weight: 600; margin-bottom: 10px; min-height: 34px; display: flex; align-items: center; justify-content: center; }
        .teacher-content .text-muted { color: #888 !important; font-size: 13px; margin: 0; }

        /* BUTTONS */
        .btn-search-custom {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white;
            font-weight: 600; border-radius: 0 5px 5px 0 !important; padding: 0 25px;
            height: 40px; border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
        }
        .btn-search-custom:hover { background: linear-gradient(135deg, #0056b3 0%, #004085 100%); box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3); }

        .btn-detail-guru {
            display: inline-flex; align-items: center; justify-content: center;
            background: #001f3f; color: #fff !important; padding: 14px 35px; border-radius: 50px;
            font-weight: 700; font-size: 16px; text-transform: uppercase; letter-spacing: 1px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 5px 15px rgba(0, 31, 63, 0.2);
        }
        .btn-detail-guru:hover { background: #FF8C00; transform: scale(1.05); box-shadow: 0 8px 25px rgba(255, 140, 0, 0.4); }
        .btn-detail-guru i { margin-left: 10px; transition: transform 0.3s ease; }
        .btn-detail-guru:hover i { transform: translateX(5px); }

        /* NAVIGATION */
        .swiper-button-next, .swiper-button-prev {
            color: #333; top: 50%; transform: translateY(-50%); width: 44px; height: 44px;
            background: rgba(255, 255, 255, 0.92); border-radius: 50%; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 10; transition: all 0.3s ease;
        }
        .swiper-button-next:after, .swiper-button-prev:after { font-size: 18px; font-weight: bold; }
        .swiper-button-next:hover, .swiper-button-prev:hover { background: #007bff; color: #fff; }
        .swiper-button-prev { left: 10px; }
        .swiper-button-next { right: 10px; }

        .swiper-pagination { bottom: 15px !important; }
        .swiper-pagination-bullet-active { background: #007bff; }

        /* INPUT GROUP */
        .input-group .form-control { border-radius: 5px 0 0 5px !important; border: 1px solid #ddd; height: 40px; }
        .input-group .form-control:focus { border-color: #007bff; box-shadow: none; }

        @media (max-width: 768px) {
            .hero-area h1.white-text { font-size: 20px; }
            .my-teacher-swiper { padding: 10px 40px 40px 40px; }
            .swiper-button-prev { left: 5px; }
            .swiper-button-next { right: 5px; }
        }
    </style>
</head>
<body>

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

    <div id="teachers" class="section" style="padding: 40px 0;">
        <div class="container">
            <div class="row" style="margin-bottom: 24px;">
                <div class="col-md-8 col-md-offset-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control" placeholder="Cari Nama, Jabatan, atau Mata Pelajaran..." value="<?php echo htmlspecialchars($current_keyword); ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-search-custom" type="submit"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($data_guru) && count($data_guru) > 0): ?>
                        <div class="swiper my-teacher-swiper">
                            <div class="swiper-wrapper">
                                <?php foreach ($data_guru as $guru):
                                    $path_foto = "admin/uploads/guru/" . ($guru['foto'] ?? '');
                                    if (empty($guru['foto']) || !file_exists($path_foto)) $path_foto = "./img/placeholder-guru.jpg";
                                ?>
                                <div class="swiper-slide">
                                    <div class="single-teacher">
                                        <div class="teacher-img">
                                            <img src="<?php echo $path_foto; ?>" alt="<?php echo htmlspecialchars($guru['nama_lengkap']); ?>">
                                            <div class="teacher-social">
                                                <p><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($guru['email'] ?? 'Tidak Ada'); ?></p>
                                            </div>
                                        </div>
                                        <div class="teacher-content">
                                            <h4><?php echo htmlspecialchars($guru['nama_lengkap']); ?></h4>
                                            <span style="color: <?php echo ($guru['jabatan'] === 'Kepala Sekolah') ? '#dc3545' : '#FF8C00'; ?>;">
                                                <?php echo htmlspecialchars($guru['jabatan']); ?>
                                            </span>
                                            <p class="small text-muted"><?php echo htmlspecialchars($guru['bidang_studi'] ?? '-'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    <?php else: ?>
                        <div class="text-center"><h3>Data tidak ditemukan.</h3></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row text-center" style="margin-top: 50px; margin-bottom: 50px;">
                <div class="col-md-12">
                    <a href="detail_guru.php" class="btn-detail-guru">Lihat Direktori Lengkap <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.my-teacher-swiper', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            observer: true,
            observeParents: true,
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                0: { slidesPerView: 1, spaceBetween: 10 },
                576: { slidesPerView: 2, spaceBetween: 12 },
                768: { slidesPerView: 3, spaceBetween: 16 },
                992: { slidesPerView: 4, spaceBetween: 20 }
            }
        });
    </script>
</body>
</html>