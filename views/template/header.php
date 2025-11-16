<?php
// variabel $title di-set oleh Controller
if (!isset($title)) {
    $title = 'Website Resmi SMA Maju Jaya';
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo htmlspecialchars($title); ?></title>

        <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
    </head>
    <body>

        <header id="header" class="transparent-nav">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <a class="logo" href="index.php">
                            <img src="./img/logo-alt.png" alt="Logo SMA Maju Jaya">
                        </a>
                    </div>
                    <button class="navbar-toggle"><span></span></button>
                </div>
                <nav id="nav">
                    <ul class="main-menu nav navbar-nav navbar-right">
                        <li><a href="index.php">Beranda</a></li>
                        <li><a href="index.php#about">Tentang Sekolah</a></li>
                        <li><a href="index.php#courses">Berita & Info</a></li>
                        <li><a href="ppdb.php">PPDB</a></li>
                        <li><a href="galeri.php">Galeri</a></li>
                        <li><a href="kontak.php">Kontak</a></li>
                    </ul>
                </nav>
            </div>
        </header>