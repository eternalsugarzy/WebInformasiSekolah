<?php
// variabel $title di-set oleh Controller
if (!isset($title)) {
    $title = 'Website Resmi SMA Frater Don Bosco Banjarmasin';
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
    <link type="text/css" rel="stylesheet" href="css/header-custom.css" />
</head>

<body>

    <header id="header" class="transparent-nav">
        <div class="container">
            
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <img src="./img/logo2.png" class="logo" alt="Logo SMA">
                    <span class="brand-text">DON BOSCO</span>
                </a>
                
                <button class="navbar-toggle">
                    <span></span>
                    <span></span>
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
                    <li><a href="index.php#footer">Kontak</a></li>
                </ul>
            </nav>
            
        </div>
    </header>

    <script>
        // 1. Script Sticky Header (Warna Putih saat Scroll)
        window.addEventListener('scroll', function() {
            var header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('navbar-scrolled');
            } else {
                header.classList.remove('navbar-scrolled');
            }
        });

        // 2. Script Toggle Menu Mobile (Agar Tombol HP Berfungsi)
        var toggleBtn = document.querySelector('.navbar-toggle');
        var navMenu = document.getElementById('nav');
        
        if(toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                navMenu.classList.toggle('open');
            });
        }
    </script>

</body>
</html>