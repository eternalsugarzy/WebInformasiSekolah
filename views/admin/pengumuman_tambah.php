<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pengumuman</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    <style>
        body { background-color: #f5f7fa; font-family: 'Montserrat', sans-serif; padding-top: 0; }
        .admin-sidebar { width: 260px; height: 100vh; background: #2B2D42; position: fixed; left: 0; top: 0; z-index: 100; }
        .admin-brand { height: 70px; display: flex; align-items: center; padding-left: 30px; background: #252739; border-bottom: 1px solid #3a3c55; }
        .admin-brand h3 { color: #fff; margin: 0; font-size: 18px; font-weight: 700; text-transform: uppercase; }
        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-menu li a { display: block; padding: 15px 30px; color: #b7c0cd; text-decoration: none; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar-menu li a:hover, .sidebar-menu li.active a { background: #32344d; color: #fff; border-left-color: #FF6700; }
        .sidebar-menu li a i { width: 25px; margin-right: 10px; }
        .main-content { margin-left: 260px; }
        .admin-header { background: #fff; height: 70px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .content-wrapper { padding: 40px; }
        .card-box { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <div class="admin-sidebar">
        <div class="admin-brand"><h3>Edu<span>Site</span> Admin</h3></div>
        <ul class="sidebar-menu">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="berita.php"><i class="fa fa-newspaper-o"></i> Kelola Berita</a></li>
            <li class="active"><a href="pengumuman.php"><i class="fa fa-bullhorn"></i> Kelola Pengumuman</a></li>
            <li><a href="#"><i class="fa fa-users"></i> Data Guru</a></li>
            <li><a href="#"><i class="fa fa-graduation-cap"></i> Info PPDB</a></li>
            <li style="margin-top: 30px; border-top: 1px solid #3a3c55;">
                <a href="../index.php" target="_blank"><i class="fa fa-external-link"></i> Lihat Website</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="admin-header">
            <h4 style="margin:0; font-weight:700; color: #333;">TAMBAH PENGUMUMAN</h4>
            <div>
                <span style="margin-right: 15px;">Halo, <b><?php echo $_SESSION['admin_nama']; ?></b></span>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="card-box">
                <form method="POST" action="pengumuman.php?aksi=simpan">
                    
                    <div class="form-group">
                        <label>Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Contoh: Libur Semester Ganjil">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Penting / Event</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="Aktif">Aktif (Tampil di Web)</option>
                                    <option value="Arsip">Arsip (Disembunyikan)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" rows="5" required placeholder="Isi detail pengumuman..."></textarea>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Pengumuman</button>
                    <a href="pengumuman.php" class="btn btn-default">Batal</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>