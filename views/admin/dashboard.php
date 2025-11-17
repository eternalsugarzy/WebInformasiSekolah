<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/font-awesome.min.css">

    <link type="text/css" rel="stylesheet" href="../css/style.css"/>

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Montserrat', sans-serif;
            padding-top: 0; /* Reset padding bootstrap default */
        }

        /* --- Sidebar Styling --- */
        .admin-sidebar {
            width: 260px;
            height: 100vh;
            background: #2B2D42; /* Warna gelap elegan */
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .admin-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding-left: 30px;
            background: #252739;
            border-bottom: 1px solid #3a3c55;
        }
        
        .admin-brand h3 {
            color: #fff;
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .admin-brand span { color: #FF6700; } /* Aksen Oranye */

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: block;
            padding: 15px 30px;
            color: #b7c0cd;
            text-decoration: none;
            transition: 0.3s;
            font-size: 14px;
            border-left: 4px solid transparent;
        }

        .sidebar-menu li a:hover, .sidebar-menu li.active a {
            background: #32344d;
            color: #fff;
            border-left-color: #FF6700; /* Border Oranye saat aktif */
        }

        .sidebar-menu li a i {
            width: 25px;
            margin-right: 10px;
        }

        /* --- Main Content Area --- */
        .main-content {
            margin-left: 260px;
            transition: all 0.3s;
        }

        /* Top Navbar Admin */
        .admin-header {
            background: #fff;
            height: 70px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
        }

        .user-area {
            display: flex;
            align-items: center;
        }
        .user-area span {
            font-weight: 600;
            color: #555;
            margin-right: 20px;
        }
        .btn-logout {
            background: #ffebe6;
            color: #d63031;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-logout:hover {
            background: #d63031;
            color: #fff;
            text-decoration: none;
        }

        /* Dashboard Widgets (Cards) */
        .content-wrapper {
            padding: 40px;
        }

        .stat-card {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            transition: transform 0.3s;
            border-bottom: 3px solid transparent;
        }
        .stat-card:hover { transform: translateY(-5px); }

        .stat-content h3 { margin: 0; font-size: 32px; font-weight: 700; color: #333; }
        .stat-content p { margin: 5px 0 0; color: #888; font-size: 13px; text-transform: uppercase; font-weight: 600; }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Warna-warni Card */
        .card-orange { border-bottom-color: #FF6700; }
        .card-orange .stat-icon { background: rgba(255, 103, 0, 0.1); color: #FF6700; }
        
        .card-blue { border-bottom-color: #374050; }
        .card-blue .stat-icon { background: rgba(55, 64, 80, 0.1); color: #374050; }
        
        .card-green { border-bottom-color: #2ecc71; }
        .card-green .stat-icon { background: rgba(46, 204, 113, 0.1); color: #2ecc71; }

    </style>
</head>
<body>

    <div class="admin-sidebar">
        <div class="admin-brand">
            <h3>Edu<span>Site</span> Admin</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="berita.php"><i class="fa fa-newspaper-o"></i> Kelola Berita</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-bullhorn"></i> Kelola Pengumuman</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-users"></i> Data Guru</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-graduation-cap"></i> Info PPDB</a>
            </li>
            <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
                <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="admin-header">
            <h4 style="margin:0; font-weight:700; color: #333;">OVERVIEW</h4>
            <div class="user-area">
                <span>Hai, <?php echo $nama_admin; ?></span>
                <a href="logout.php" class="btn-logout" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" style="border-left: 4px solid #FF6700; background: #fff; color: #555;">
                        Selamat Datang di Panel Administrator SMA Maju Jaya. Anda login sebagai <b><?php echo $_SESSION['admin_level']; ?></b>.
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card card-orange">
                        <div class="stat-content">
                            <h3>5</h3> <p>Total Berita</p>
                            <a href="berita.php" style="font-size:11px; color:#FF6700; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                        </div>
                        <div class="stat-icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card card-blue">
                        <div class="stat-content">
                            <h3>2</h3>
                            <p>Pengumuman</p>
                            <a href="#" style="font-size:11px; color:#374050; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                        </div>
                        <div class="stat-icon">
                            <i class="fa fa-bullhorn"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card card-green">
                        <div class="stat-content">
                            <h3>45</h3>
                            <p>Data Guru</p>
                            <a href="#" style="font-size:11px; color:#2ecc71; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                        </div>
                        <div class="stat-icon">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div style="background: #fff; padding: 30px; border-radius: 8px; text-align:center; color:#aaa; border: 2px dashed #eee;">
                        <i class="fa fa-bar-chart" style="font-size: 50px; margin-bottom: 10px;"></i>
                        <p>Area Statistik Pengunjung (Coming Soon)</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div id='preloader'><div class='preloader'></div></div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>

</body>
</html>