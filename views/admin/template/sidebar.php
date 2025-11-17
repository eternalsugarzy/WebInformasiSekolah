<div class="admin-sidebar">
    <div class="admin-brand">
        <h3>SMA Frater Don Bosco<span>Admin</span> </h3>
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
        <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
            <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
        </li>
    </ul>
</div>