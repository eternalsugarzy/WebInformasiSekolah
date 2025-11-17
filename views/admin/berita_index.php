<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

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
        body { background-color: #f5f7fa; font-family: 'Montserrat', sans-serif; padding-top: 0; }
        
        /* Sidebar Style (Sama dengan Dashboard) */
        .admin-sidebar { width: 260px; height: 100vh; background: #2B2D42; position: fixed; left: 0; top: 0; z-index: 100; transition: all 0.3s; }
        .admin-brand { height: 70px; display: flex; align-items: center; padding-left: 30px; background: #252739; border-bottom: 1px solid #3a3c55; }
        .admin-brand h3 { color: #fff; margin: 0; font-size: 18px; font-weight: 700; text-transform: uppercase; }
        .admin-brand span { color: #FF6700; }
        .sidebar-menu { list-style: none; padding: 20px 0; margin: 0; }
        .sidebar-menu li a { display: block; padding: 15px 30px; color: #b7c0cd; text-decoration: none; transition: 0.3s; font-size: 14px; border-left: 4px solid transparent; }
        .sidebar-menu li a:hover, .sidebar-menu li.active a { background: #32344d; color: #fff; border-left-color: #FF6700; }
        .sidebar-menu li a i { width: 25px; margin-right: 10px; }
        
        /* Content Area */
        .main-content { margin-left: 260px; transition: all 0.3s; }
        .admin-header { background: #fff; height: 70px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; padding: 0 40px; }
        .content-wrapper { padding: 40px; }
        
        /* Table Styling */
        .card-box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .btn-orange { background: #FF6700; color: #fff; border: none; }
        .btn-orange:hover { background: #e05a00; color: #fff; }
    </style>
</head>
<body>



    <div class="main-content">
        <div class="admin-header">
            <h4 style="margin:0; font-weight:700; color: #333;">KELOLA BERITA</h4>
            <div>
                <span style="margin-right: 15px; color:#666;">Halo, <b><?php echo $nama_admin; ?></b></span>
                <a href="logout.php" class="text-danger" onclick="return confirm('Keluar?')"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="card-box">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <h4 style="margin-top: 5px;">Daftar Berita & Artikel</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="berita.php?aksi=tambah" class="btn btn-orange"><i class="fa fa-plus"></i> Tambah Berita</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Foto</th>
                                <th>Judul</th>
                                <th width="15%">Kategori</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (count($data_berita) > 0) {
                                foreach ($data_berita as $b) {
                                    // Cek path gambar
                                    $img_path = "uploads/berita/" . $b['gambar_utama'];
                                    if(empty($b['gambar_utama']) || !file_exists("../admin/" . $img_path)) {
                                        $img_show = "../img/course01.jpg"; // Default
                                    } else {
                                        $img_show = $img_path;
                                    }
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <img src="<?php echo $img_show; ?>" width="60" style="border-radius: 4px;">
                                </td>
                                <td style="font-weight: 600;"><?php echo htmlspecialchars($b['judul']); ?></td>
                                <td><span class="label label-info"><?php echo htmlspecialchars($b['kategori']); ?></span></td>
                                <td><?php echo date('d/m/Y', strtotime($b['tanggal_publikasi'])); ?></td>
                                <td class="text-center">
                                    <a href="berita.php?aksi=edit&id=<?php echo $b['id_berita']; ?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>
                                    <a href="berita.php?aksi=hapus&id=<?php echo $b['id_berita']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus berita ini?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center' style='padding: 30px;'>Belum ada berita. Silakan tambah baru.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>