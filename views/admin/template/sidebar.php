<div class="admin-sidebar">
    <div class="admin-brand" style="height: auto; padding: 20px 0; flex-direction: column; text-align: center;">
        <img src="../img/logo.png" alt="Logo Sekolah" style="width: 60px; height: auto; margin-bottom: 10px;">
        
        <h3 style="margin: 0; font-size: 16px; line-height: 1.4;">
            SMA Frater <br> Don Bosco 
            <span style="display: block; margin-top: 8px; font-size: 14px; letter-spacing: 1px;">
                ADMIN PANEL
            </span>
        </h3>
    </div>

    <ul class="sidebar-menu">
        <?php $page = basename($_SERVER['PHP_SELF']); ?>

        <li class="<?php echo ($page == 'index.php') ? 'active' : ''; ?>">
            <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
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
        <li class="<?php echo ($page == 'ppdb.php') ? 'active' : ''; ?>">
            <a href="ppdb.php"><i class="fa fa-graduation-cap"></i> Info PPDB</a>
        </li>
        <li class="<?php echo ($page == 'galeri.php') ? 'active' : ''; ?>">
            <a href="galeri.php"><i class="fa fa-image"></i> Galeri Foto</a>
        </li>
        <li class="has-submenu">
            <a href="#" class="submenu-toggle">
                <i class="fa fa-print"></i> Laporan <i class="fa fa-angle-down pull-right"></i>
            </a>
            <ul class="submenu" style="display: none; background: #252739; padding-left: 0;">
                <li>
                    <a href="laporan.php?aksi=guru" style="padding-left: 50px;">
                        <i class="fa fa-angle-right"></i> Lap. Data Guru
                    </a>
                </li>
                <li>
                    <a href="laporan.php?aksi=berita" style="padding-left: 50px;">
                        <i class="fa fa-angle-right"></i> Lap. Berita
                    </a>
                </li>
                <li>
                    <a href="laporan.php?aksi=ppdb" style="padding-left: 50px;">
                        <i class="fa fa-angle-right"></i> Lap. PPDB
                    </a>
                </li>
                <li>
                    <a href="laporan.php?aksi=pengumuman" style="padding-left: 50px;">
                        <i class="fa fa-angle-right"></i> Lap. Pengumuman
                    </a>
                </li>
                <li>
                    <a href="laporan.php?aksi=galeri" style="padding-left: 50px;">
                        <i class="fa fa-angle-right"></i> Lap. Galeri Foto
                    </a>
                </li>
                </ul>
        </li>
        <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
            <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
        </li>
    </ul>
</div>