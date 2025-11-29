<?php
// variabel $title di-set oleh Controller
if (!isset($title)) {
    $title = 'Website Resmi SMA Frater Don Bosco Bjm';
}

// Dapatkan nama halaman saat ini untuk menu aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>

    <link rel="icon" href="./img/logo2.png" type="image/png">

    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <style>
        /* ========================================= */
        /* 1. EFEK SMOOTH SCROLL (PENTING)           */
        /* ========================================= */
        html {
            scroll-behavior: smooth !important; /* Membuat scroll meluncur halus */
        }

        /* ========================================= */
        /* MODIFIKASI HEADER (FULL WIDTH & STICKY)   */
        /* ========================================= */

        /* HEADER UTAMA */
        #header {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
            transition: all 0.3s ease-in-out;
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: transparent;
            border-bottom: none;
        }

        /* Style Saat Scroll (Putih) */
        #header.navbar-scrolled {
            background-color: #ffffff !important;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
        }

        /* CONTAINER MENJADI FULL WIDTH (MENTOK KIRI KANAN) */
        #header .container {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 40px !important;
            padding-right: 40px !important;
            float: none;
        }
        
        #header .container:before,
        #header .container:after { display: none !important; }

        /* LOGO & BRAND */
        .navbar-header {
            float: none !important;
            margin: 0 !important;
            display: flex;
            align-items: center;
            flex-shrink: 0; 
        }

        .navbar-brand {
            float: none !important;
            padding: 0;
            height: auto;
            display: flex;
            align-items: center;
            text-decoration: none !important;
        }

        .navbar-brand .logo > img {
            max-height: 60px;
            height: auto;
            width: auto;
            transition: all 0.3s ease;
            margin-right: 15px;
        }

        .brand-text {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 25px;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0px 1px 3px rgba(0,0,0,0.6);
            white-space: nowrap;
            transition: color 0.3s ease;
        }

        /* NAVIGASI */
        #nav {
            margin-left: auto !important; 
            display: flex;
            align-items: center;
        }

        #nav .main-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            float: none !important;
        }

        #nav .main-menu li {
            margin-left: 25px;
            display: block;
        }

        /* Style Link Menu */
        #nav .main-menu li a {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 17px;
            text-decoration: none;
            text-shadow: 0px 1px 2px rgba(0,0,0,0.5);
            transition: color 0.3s ease;
            padding: 10px 0; 
            display: block;
            position: relative;
        }

        /* Hover & Active */
        #nav .main-menu li a:hover { color: #FFC107 !important; }
        #nav .main-menu li.active a::after {
            content: ''; display: block; width: 100%; height: 3px;
            background: #FFC107; position: absolute; bottom: 0; left: 0;
        }

        /* WARNA MENU SAAT SCROLL (HITAM) */
        #header.navbar-scrolled #nav .main-menu li a {
            color: #333333 !important;
            text-shadow: none;
        }
        #header.navbar-scrolled #nav .main-menu li a:hover { color: #045bb8ff !important; }
        #header.navbar-scrolled #nav .main-menu li.active a { color: #045bb8ff !important; }
        #header.navbar-scrolled #nav .main-menu li.active a::after { background: #045bb8ff; }
        
        /* Logo & Teks saat Scroll */
        #header.navbar-scrolled .navbar-brand .logo > img { max-height: 50px; }
        #header.navbar-scrolled .brand-text { color: #333333; text-shadow: none; }

        /* TOMBOL MOBILE */
        .navbar-toggle {
            display: none; 
            background-color: #045bb8ff !important;
            border: none;
            margin-top: 0;
        }
        .navbar-toggle span { background-color: #fff !important; }

        /* RESPONSIF */
        @media (max-width: 991px) {
            #header .container { 
                display: block !important; 
                padding-left: 15px !important; 
                padding-right: 15px !important;
            }
            .navbar-header { display: flex; justify-content: space-between; width: 100%; }
            .navbar-toggle { display: block; }
            #nav { display: none; } 
            .brand-text { font-size: 16px; }
        }
    </style>
</head>

<body>

    <header id="header" class="transparent-nav">
        <div class="container">
            
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a class="logo" href="index.php" style="display:flex; align-items:center; text-decoration:none;">
                        <img src="./img/logo2.png" alt="Logo SMA">
                        <span class="brand-text">DON BOSCO</span>
                    </a>
                </div>
                <button class="navbar-toggle">
                    <span></span>
                </button>
            </div>

            <nav id="nav">
                <ul class="main-menu">
                    <li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                        <a href="index.php">Beranda</a>
                    </li>
                    <li class="<?php echo ($current_page == 'profil.php') ? 'active' : ''; ?>">
                        <a href="profil.php">Profil</a>
                    </li>
                    <li class="<?php echo ($current_page == 'berita.php') ? 'active' : ''; ?>">
                        <a href="berita.php">Berita & Info</a>
                    </li>
                    <li class="<?php echo ($current_page == 'pengumuman.php') ? 'active' : ''; ?>">
                        <a href="pengumuman.php">Pengumuman</a>
                    </li>
                    <li class="<?php echo ($current_page == 'guru.php') ? 'active' : ''; ?>">
                        <a href="guru.php">Guru</a>
                    </li>
                    <li class="<?php echo ($current_page == 'galeri.php') ? 'active' : ''; ?>">
                        <a href="galeri.php">Galeri</a>
                    </li>
                    <li class="<?php echo ($current_page == 'ppdb.php') ? 'active' : ''; ?>">
                        <a href="ppdb.php">PPDB</a>
                    </li>
                    
                    <li><a href="index.php#contact">Kontak</a></li>
                </ul>
            </nav>
            
        </div>
    </header>

    <script>
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('navbar-scrolled');
            } else {
                header.classList.remove('navbar-scrolled');
            }
        });
    </script>

</body>
</html>