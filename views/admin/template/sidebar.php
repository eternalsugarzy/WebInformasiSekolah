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

    <style>
        /* =============================== */
        /* SIDEBAR TOGGLE SYSTEM */
        /* =============================== */

        .admin-sidebar {
            width: 260px;
            transition: all 0.3s ease;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 9999;
            background: #1c1e2f;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }

        /* SIDEBAR TERTUTUP - geser keluar layar */
        .admin-sidebar.closed {
            transform: translateX(-100%);
        }

        /* SIDEBAR TERBUKA */
        .admin-sidebar:not(.closed) {
            transform: translateX(0);
        }

        /* =============================== */
        /* TOMBOL TOGGLE SIDEBAR */
        /* =============================== */

        .toggle-sidebar-btn {
            position: fixed !important;
            top: 20px !important;
            z-index: 10000 !important;

            background: #1c1e2f;
            color: #fff;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        /* POSISI TOMBOL SAAT SIDEBAR TERTUTUP */
        .toggle-sidebar-btn.sidebar-closed {
            left: 20px !important;
        }

        /* POSISI TOMBOL SAAT SIDEBAR TERBUKA */
        .toggle-sidebar-btn.sidebar-open {
            left: 280px !important;
        }

        /* Efek hover untuk tombol */
        .toggle-sidebar-btn:hover {
            background: #252739;
            transform: scale(1.05);
        }

        /* KONTEN ADMIN AGAR IKUT GESER */
        .main-content {
            margin-left: 260px;
            transition: margin-left 0.3s ease;
            position: relative;
            min-height: 100vh;
            background: #f5f6fa;
            padding: 20px;
            padding-top: 80px;
            /* Memberikan ruang untuk tombol */
        }

        .main-content.full {
            margin-left: 0;
        }

        /* RESPONSIVE UNTUK MOBILE & TABLET */
        @media (max-width: 991px) {
            .admin-sidebar {
                width: 280px;
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
            }

            .admin-sidebar.closed {
                transform: translateX(-100%);
            }

            .admin-sidebar:not(.closed) {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding-top: 80px;
            }


        }

        /* DESKTOP LEBAR */
        @media (min-width: 1200px) {
            .toggle-sidebar-btn.sidebar-open {
                left: 280px !important;
            }
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
                <span style="display: block; margin-top: 8px; font-size: 14px; letter-spacing: 1px; color:#FF6700;">
                    ADMIN PANEL
                </span>
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
            
            
            <!--
            <li class="<?php echo ($page == 'ppdb.php') ? 'active' : ''; ?>">
                <a href="ppdb.php"><i class="fa fa-graduation-cap"></i> Info PPDB</a>
            </li>
            -->

            

            <li class="<?php echo ($page == 'pendaftar_ppdb.php') ? 'active' : ''; ?>">
                <a href="pendaftar_ppdb.php"><i class="fa fa-user-plus"></i> Info PPDB</a>
            </li>

            <li class="<?php echo ($page == 'galeri.php') ? 'active' : ''; ?>">
                <a href="galeri.php"><i class="fa fa-image"></i> Galeri Foto</a>
            </li>
            <li class="<?php echo (strpos($page, 'laporan') !== false) ? 'active' : ''; ?>">
                <a href="laporan.php"><i class="fa fa-print"></i> <span>Laporan</span></a>
            </li>
            

            <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
                <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
            </li>
        </ul>
    </div>
</body>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleSidebar");
        const sidebar = document.querySelector(".admin-sidebar");
        const content = document.querySelector(".main-content");

        // Fungsi untuk update posisi tombol
        function updateToggleButtonPosition(isClosed) {
            if (isClosed) {
                toggleBtn.classList.remove('sidebar-open');
                toggleBtn.classList.add('sidebar-closed');
            } else {
                toggleBtn.classList.remove('sidebar-closed');
                toggleBtn.classList.add('sidebar-open');
            }
        }

        // Inisialisasi status sidebar dari localStorage
        const sidebarState = localStorage.getItem('sidebarState');
        let isSidebarClosed = true;

        if (sidebarState === 'open') {
            sidebar.classList.remove("closed");
            isSidebarClosed = false;
            if (content) content.classList.remove("full");
        } else {
            sidebar.classList.add("closed");
            isSidebarClosed = true;
            if (content) content.classList.add("full");
        }

        // Update posisi tombol awal
        updateToggleButtonPosition(isSidebarClosed);

        // Event listener untuk toggle sidebar
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("closed");
            isSidebarClosed = sidebar.classList.contains("closed");

            // Update posisi tombol
            updateToggleButtonPosition(isSidebarClosed);

            if (content) {
                content.classList.toggle("full");
            }

            // Simpan status sidebar ke localStorage
            if (isSidebarClosed) {
                localStorage.setItem('sidebarState', 'closed');
            } else {
                localStorage.setItem('sidebarState', 'open');
            }

            // Update ikon
            updateToggleIcon();
        });

        // Tutup sidebar saat klik di luar sidebar (untuk mobile)
        document.addEventListener("click", function (event) {
            if (window.innerWidth <= 991 && !isSidebarClosed) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggleBtn = toggleBtn.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggleBtn) {
                    sidebar.classList.add("closed");
                    isSidebarClosed = true;
                    updateToggleButtonPosition(true);

                    if (content) content.classList.add("full");
                    localStorage.setItem('sidebarState', 'closed');
                    updateToggleIcon();
                }
            }
        });

        // Submenu toggle
        const submenuToggles = document.querySelectorAll('.submenu-toggle');
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                const submenu = this.nextElementSibling;

                if (submenu.style.display === 'block') {
                    submenu.style.display = 'none';
                    this.querySelector('.fa-angle-down').style.transform = 'rotate(0deg)';
                } else {
                    submenu.style.display = 'block';
                    this.querySelector('.fa-angle-down').style.transform = 'rotate(180deg)';
                }
            });
        });

        // Update ikon tombol berdasarkan status sidebar
        function updateToggleIcon() {
            const icon = toggleBtn.querySelector('i');
            if (isSidebarClosed) {
                icon.className = 'fa fa-bars';
            } else {
                icon.className = 'fa fa-times';
            }
        }

        // Panggil fungsi update ikon
        updateToggleIcon();
    });
</script>
</html>