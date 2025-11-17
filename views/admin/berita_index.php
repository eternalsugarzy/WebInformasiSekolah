<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link type="text/css" rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <style>
        body { padding-top: 70px; }
        .admin-sidebar { background: #f8f9fa; min-height: 100vh; padding: 20px; border-right: 1px solid #ddd; }
    </style>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Panel Admin</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fa fa-user"></i> <?php echo $nama_admin; ?></a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 admin-sidebar">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li class="active"><a href="berita.php"><i class="fa fa-newspaper-o"></i> Kelola Berita</a></li>
                    <li><a href="#"><i class="fa fa-bullhorn"></i> Kelola Pengumuman</a></li>
                    <li><a href="../../index.php" target="_blank"><i class="fa fa-globe"></i> Lihat Website</a></li>
                </ul>
            </div>

            <div class="col-md-10">
                <h3>Kelola Berita</h3>
                <hr>
                <a href="berita.php?aksi=tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Berita Baru</a>
                <br><br>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th>Judul Berita</th>
                                <th width="15%">Kategori</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (count($data_berita) > 0) {
                                foreach ($data_berita as $b) {
                                    $img_path = "uploads/berita/" . $b['gambar_utama'];
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td class="text-center">
                                    <?php if(!empty($b['gambar_utama'])): ?>
                                        <img src="<?php echo $img_path; ?>" width="80">
                                    <?php else: ?>
                                        <small>Tidak ada gambar</small>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($b['judul']); ?></td>
                                <td><?php echo htmlspecialchars($b['kategori']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($b['tanggal_publikasi'])); ?></td>
                                <td class="text-center">
                                    <a href="berita.php?aksi=edit&id=<?php echo $b['id_berita']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                    <a href="berita.php?aksi=hapus&id=<?php echo $b['id_berita']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus berita ini?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Belum ada data berita.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</body>
</html>