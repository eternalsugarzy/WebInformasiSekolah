<?php
// variabel $title di-set oleh Controller
if (!isset($title)) {
    $title = 'Website Resmi SMA Frater Don Bosco Bjm';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>
    
    <link rel="icon" href="../img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />

<style>
    
/* --- LOGO LEBIH BESAR --- */
/* 1. Paksa Logo Berubah Ukuran (Override max-height:30px bawaan) */
.navbar-brand .logo > img {
    max-height: 80px !important; /* Tinggi Logo yang diinginkan */
    height: 80px !important; 
    width: auto !important;
}

/* 2. Paksa Header Menjadi Lebih Tinggi (Agar logo 60px muat) */
#header {
    padding-top: 15px !important; 
    padding-bottom: 20px !important; 
}

/* 3. Sesuaikan Jarak Logo dari Atas Header */
.navbar-brand .logo {
    margin-top: 0px !important;
}

/* 4. Sesuaikan Posisi Teks Navigasi (Agar menu berada di tengah vertikal) */
.main-menu {
    margin-top: 10px !important; 
}

/* --- MENU AKTIF & HOVER --- */
/* Menargetkan semua tautan <a> di dalam menu utama */
#nav .main-menu li a {
    transition: color 0.3s ease; 
}

/* 5. Teks berubah menjadi Biru saat kursor diarahkan (HOVER) */
#nav .main-menu li a:hover {
    color: #000064ff !important; /* Warna Biru saat di-hover */
}

/* 6. Teks Berwarna Biru Permanen untuk Menu AKTIF (Logika dari PHP) */
#nav .main-menu li.active a {
    color: #000064ff !important; /* Teks menu aktif harus Biru */
}

/* 7. Garis Bawah Biru Permanen untuk Menu AKTIF */
/* Menimpa aturan after bawaan template */
#nav .main-menu li.active a:after {
    content:"";
	display:block;
	height:2px;
	background-color:#007bff !important; /* Garis Bawah Biru */
	width:100%;
    /* Atur ulang posisi agar terlihat di bawah */
	transform: translateY(0px) !important; 
	opacity:1 !important;
}
</style>
</head>


<body>

    <header id="header" class="transparent-nav">
        <div class="container">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <a class="logo" href="index.php" style="max-width: 100px;">
                        <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Banjarmasin">
                    </a>
                </div>
                <button class="navbar-toggle"><span></span></button>
            </div>
            <nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">
                    <li class="<?php if ($current_page == 'index.php') { echo 'active'; } ?>"><a href="index.php">Beranda</a></li>
                    <li class="<?php if ($current_page == 'profil.php') { echo 'active'; } ?>"><a href="profil.php">Profil</a></li>
                    <li class="<?php if ($current_page == 'berita.php') { echo 'active'; } ?>"><a href="berita.php">Berita & Info</a></li>
                    <li class="<?php if ($current_page == 'pengumuman.php') { echo 'active'; } ?>"><a href="pengumuman.php">Pengumuman</a></li>
                    <li class="<?php if ($current_page == 'guru.php') { echo 'active'; } ?>"><a href="guru.php">Guru</a></li>
                    <li class="<?php if ($current_page == 'galeri.php') { echo 'active'; } ?>"><a href="galeri.php">Galeri</a></li>
                    <li class="<?php if ($current_page == 'ppdb.php') { echo 'active'; } ?>"><a href="ppdb.php">PPDB</a></li>
                    <li class="<?php if ($current_page == 'contact.php') { echo 'active'; } ?>"><a href="contact.php">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header> 

    </body>
</html>