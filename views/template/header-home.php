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
        /* MODIFIKASI HEADER (STICKY FIXED)          */
        /* ========================================= */

        /* 1. Atur Header agar Selalu Menempel di Atas */
        #header {
            position: fixed !important; /* Paksa Fixed agar nyangkut */
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999; /* Layer paling atas */
            transition: all 0.3s ease-in-out; /* Animasi halus */
            padding-top: 20px;
            padding-bottom: 20px;
            
            /* Kondisi Awal (Belum Scroll): Transparan */
            background-color: transparent; 
            border-bottom: none;
        }

        /* 2. Style saat Header di-Scroll (Ditambah via JS) */
        #header.navbar-scrolled {
            background-color: #ffffff !important; /* Jadi Putih Solid */
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15); /* Bayangan bawah */
            padding-top: 10px !important; /* Mengecil sedikit */
            padding-bottom: 10px !important;
        }

        /* --- LOGO --- */
        .navbar-brand .logo > img {
            max-height: 70px;
            height: auto;
            width: auto;
            transition: all 0.3s ease;
        }

        /* Logo mengecil saat scroll */
        #header.navbar-scrolled .navbar-brand .logo > img {
            max-height: 50px;
        }

        /* --- MENU NAVIGASI --- */
        #nav {
            margin-top: 5px;
        }

        /* Warna Teks Menu - Default (Biru) */
        #nav .main-menu li a {
            color: #ffffffff !important; 
            font-weight: 700;
            font-size: 14px;
            transition: color 0.3s ease;
            text-shadow: 0px 0px 1px rgba(255,255,255,0.5); /* Agar terbaca di foto gelap */
        }

       /* --- WARNA MENU SAAT SCROLL (JADI HITAM) --- */
        #header.navbar-scrolled #nav .main-menu li a {
            color: #333333 !important; /* Warna Hitam Abu Gelap */
            text-shadow: none; /* Hapus bayangan teks agar bersih */
        }

        /* Tetap pertahankan warna saat di-Hover (Kuning/Oranye) */
        #header.navbar-scrolled #nav .main-menu li a:hover {
            color: #f8e134ff !important;
        }

       
        
        

        /* Toggle Menu HP */
        .navbar-toggle {
            background-color: #045bb8ff !important;
        }
        .navbar-toggle span {
            background-color: #fff !important;
        }
    </style>
</head>

<body>

    <header id="header" class="transparent-nav">
        <div class="container">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a class="logo" href="index.php">
                        <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Banjarmasin">
                    </a>
                </div>
                <button class="navbar-toggle">
                    <span></span>
                </button>
                </div>

            <nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">
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
                    <li class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
                        <a href="contact.php">Kontak</a>
                    </li>
                </ul>
            </nav>
            </div>
    </header>
    <script>
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            
            // Jika scroll lebih dari 50px
            if (window.scrollY > 50) {
                header.classList.add('navbar-scrolled');
            } else {
                header.classList.remove('navbar-scrolled');
            }
        });
    </script>

</body>
</html>