<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title ?? 'Admin Panel'); ?></title>

    <link rel="icon" href="./img/logo2.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link type="text/css" rel="stylesheet" href="css/header-custom.css" />

    <style>
        /* SIDEBAR TOGGLE SYSTEM */
        .admin-sidebar { width: 260px; transition: all 0.3s ease; position: fixed; left: 0; top: 0; height: 100vh; z-index: 9999; background: #1c1e2f; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); }
        .admin-sidebar.closed { transform: translateX(-100%); }
        .admin-sidebar:not(.closed) { transform: translateX(0); }
        
        .toggle-sidebar-btn { position: fixed !important; top: 20px !important; z-index: 10000 !important; background: #1c1e2f; color: #fff; border: none; width: 50px; height: 50px; border-radius: 10px; cursor: pointer; font-size: 20px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35); display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; }
        .toggle-sidebar-btn.sidebar-closed { left: 20px !important; }
        .toggle-sidebar-btn.sidebar-open { left: 280px !important; }
        .toggle-sidebar-btn:hover { background: #252739; transform: scale(1.05); }

        .main-content { margin-left: 260px; transition: margin-left 0.3s ease; position: relative; min-height: 100vh; background: #f5f6fa; padding: 20px; padding-top: 80px; }
        .main-content.full { margin-left: 0; }

        @media (max-width: 991px) {
            .admin-sidebar { width: 280px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.4); }
            .main-content { margin-left: 0; padding-top: 80px; }
        }
    </style>
</head>

<body>

    <button id="toggleSidebar" class="toggle-sidebar-btn sidebar-closed">
        <i class="fa fa-bars"></i>
    </button>

    <div class="admin-sidebar closed">
        <div class="admin-brand" style="height: auto; padding: 20px 0; flex-direction: column; text-align: center;">
            <img src="../img/logo.png" alt="Logo Sekolah" style="width: 60px; height: auto; margin-bottom: 10px;">
            <h3 style="margin: 0; font-size: 16px; line-height: 1.4; text-transform: uppercase;">
                SMA FRATER <br> DON BOSCO
                <span style="display: block; margin-top: 8px; font-size: 14px; letter-spacing: 1px; color:#FF6700;">ADMIN PANEL</span>
            </h3>
        </div>

        <ul class="sidebar-menu">
            <?php $page = basename($_SERVER['PHP_SELF']); ?>

            <li class="<?php echo ($page == 'index.php') ? 'active' : ''; ?>">
                <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="<?php echo ($page == 'identitas.php') ? 'active' : ''; ?>">
                <a href="identitas.php"><i class="fa fa-cogs"></i> Identitas Sekolah</a>
            </li>
            <li class="<?php echo ($page == 'berita.php') ? 'active' : ''; ?>">
                <a href="berita.php"><i class="fa fa-newspaper-o"></i> Kelola Berita</a>
            </li>
            <li class="<?php echo ($page == 'pengumuman.php') ? 'active' : ''; ?>">
                <a href="pengumuman.php"><i class="fa fa-bullhorn"></i> Kelola Pengumuman</a>
            </li>
            <li class="<?php echo ($page == 'guru.php') ? 'active' : ''; ?>">
                <a href="guru.php"><i class="fa fa-users"></i> Data Guru</a>
            </li>
            <li class="<?php echo ($page == 'pendaftar_ppdb.php') ? 'active' : ''; ?>">
                <a href="pendaftar_ppdb.php"><i class="fa fa-user-plus"></i> Info PPDB</a>
            </li>
            <li class="<?php echo ($page == 'galeri.php') ? 'active' : ''; ?>">
                <a href="galeri.php"><i class="fa fa-image"></i> Galeri Foto</a>
            </li>

            <li style="padding: 15px 20px 5px 20px; color: #888; font-size: 11px; text-transform: uppercase; font-weight: bold;">
                Sistem Seleksi (SAW)
            </li>
            <li class="<?php echo ($page == 'bobot_saw.php') ? 'active' : ''; ?>">
                <a href="bobot_saw.php"><i class="fa fa-sliders"></i> Bobot SAW</a>
            </li>
            <li class="<?php echo ($page == 'input_nilai.php') ? 'active' : ''; ?>">
                <a href="input_nilai.php"><i class="fa fa-edit"></i> Input Nilai SAW</a>
            </li>
            <li class="<?php echo ($page == 'proses_saw.php') ? 'active' : ''; ?>">
                <a href="proses_saw.php"><i class="fa fa-calculator"></i> Proses Seleksi SAW</a>
            </li>
            <li class="<?php echo ($page == 'kelulusan.php') ? 'active' : ''; ?>">
                <a href="kelulusan.php"><i class="fa fa-certificate"></i> Kuota Kelulusan</a>
            </li>

            <li class="<?php echo (strpos($page, 'laporan') !== false) ? 'active' : ''; ?>">
                <a href="laporan.php"><i class="fa fa-print"></i> <span>Laporan</span></a>
            </li>

            <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
                <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
            </li>
        </ul>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".admin-sidebar");
        const content = document.querySelector(".main-content");

        function updateToggleButtonPosition(isClosed) {
            if (isClosed) { toggleBtn.classList.remove('sidebar-open'); toggleBtn.classList.add('sidebar-closed'); } 
            else { toggleBtn.classList.remove('sidebar-closed'); toggleBtn.classList.add('sidebar-open'); }
        }

        const sidebarState = localStorage.getItem('sidebarState');
        let isSidebarClosed = true;

        if (sidebarState === 'open') { sidebar.classList.remove("closed"); isSidebarClosed = false; if (content) content.classList.remove("full"); } 
        else { sidebar.classList.add("closed"); isSidebarClosed = true; if (content) content.classList.add("full"); }

        updateToggleButtonPosition(isSidebarClosed);

        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("closed");
            isSidebarClosed = sidebar.classList.contains("closed");
            updateToggleButtonPosition(isSidebarClosed);
            if (content) content.classList.toggle("full");
            localStorage.setItem('sidebarState', isSidebarClosed ? 'closed' : 'open');
        });
    });
</script>
</body>
</html>