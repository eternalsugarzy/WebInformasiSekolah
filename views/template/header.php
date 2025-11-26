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
        /* MODIFIKASI HEADER (STICKY & ALIGNMENT)    */
        /* ========================================= */

        #header {
            position: fixed !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
            transition: all 0.3s ease-in-out;
            padding-top: 15px;
            padding-bottom: 15px;
            background-color: transparent;
            border-bottom: none;
        }

        #header.navbar-scrolled {
            background-color: #ffffff !important;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15);
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }

        /* --- LOGO --- */
        .navbar-brand .logo > img {
            max-height: 70px;
            height: auto;
            width: auto;
            transition: all 0.3s ease;
        }

        #header.navbar-scrolled .navbar-brand .logo > img {
            max-height: 50px;
        }

        /* --- MENU NAVIGASI (PERBAIKAN POSISI) --- */
        #nav {
            /* Pastikan nav mengambil sisa ruang dan kontennya rata kanan */
            display: flex;
            justify-content: flex-end; 
            align-items: center;
            height: 70px; /* Sesuaikan tinggi dengan logo */
        }

        /* Hapus float bawaan bootstrap agar flexbox bekerja */
        .navbar-header {
            float: left;
        }
        
        /* Reset float pada UL agar bisa diatur oleh flexbox parent */
        #nav .main-menu {
            float: none !important; 
            margin: 0;
            display: flex; /* Menu berjejer ke samping */
        }

        /* Jarak antar menu */
        #nav .main-menu li {
            margin-left: 25px; /* Beri jarak antar item menu */
            display: block;
        }

        /* Warna Teks Menu - Default (Putih) */
        #nav .main-menu li a {
            color: #ffffff !important; 
            font-weight: 700;
            font-size: 14px;
            transition: color 0.3s ease;
            text-shadow: 0px 0px 2px rgba(0,0,0,0.5);
            text-decoration: none;
            padding: 5px 0; /* Padding atas bawah dikit */
        }

        /* Warna Teks Menu - Saat Hover */
        #nav .main-menu li a:hover {
            color: #7472ffff !important; /* Kuning */
        }

        /* --- WARNA MENU SAAT SCROLL (JADI HITAM) --- */
        #header.navbar-scrolled #nav .main-menu li a {
            color: #333333 !important;
            text-shadow: none;
        }

        #header.navbar-scrolled #nav .main-menu li a:hover {
            color: #3734f8ff !important;
        }

       
        #header.navbar-scrolled #nav .main-menu li.active a {
            color: #045bb8ff !important; /* Biru saat aktif di mode putih */
        }
        
        /* Toggle Menu HP */
        .navbar-toggle {
            background-color: #045bb8ff !important;
            margin-top: 18px; /* Penyesuaian posisi tombol HP */
        }
        .navbar-toggle span {
            background-color: #fff !important;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 991px) {
            #nav {
                display: none; /* Sembunyikan menu desktop di HP, nanti muncul lewat toggle JS bawaan template */
            }
            /* Jika template menggunakan JS untuk mobile menu, biarkan style bawaan template menangani tampilan mobile */
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
            if (window.scrollY > 50) {
                header.classList.add('navbar-scrolled');
            } else {
                header.classList.remove('navbar-scrolled');
            }
        });
    </script>

</body>
</html>