<?php 
$title = "Kelola Galeri";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6"><h4>Galeri Kegiatan Sekolah</h4></div>
                <div class="col-md-6 text-right">
                    <a href="galeri.php?aksi=tambah" class="btn btn-orange"><i class="fa fa-plus"></i> Tambah Album</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Cover</th>
                            <th>Judul Album</th>
                            <th>Tanggal</th>
                            <th>Jumlah Foto</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (isset($data_galeri) && count($data_galeri) > 0) {
                            foreach ($data_galeri as $g) {
                                // Mengambil data cover & jumlah yang sudah di-join di Model
                                $cover = $g['cover_foto'];
                                $jumlah = $g['jumlah_foto'];
                                $img_path = "uploads/galeri/" . $cover;
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php if(!empty($cover) && file_exists("../admin/" . $img_path)): ?>
                                    <img src="<?php echo $img_path; ?>" width="60" height="60" style="border-radius: 4px; object-fit: cover;">
                                <?php else: ?>
                                    <small class="text-muted">No Image</small>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight:600;">
                                <?php echo htmlspecialchars($g['judul_album']); ?>
                                <br><small class="text-muted"><?php echo substr($g['deskripsi'], 0, 50); ?>...</small>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($g['tanggal_event'])); ?></td>
                            <td>
                                <span class="label label-info"><?php echo $jumlah; ?> Foto</span>
                            </td>
                            <td class="text-center">
                                <a href="galeri.php?aksi=edit&id=<?php echo $g['id_album']; ?>" class="btn btn-sm btn-default" title="Edit & Kelola Foto">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="galeri.php?aksi=hapus&id=<?php echo $g['id_album']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Album ini beserta semua fotonya?')" title="Hapus Album">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Belum ada album galeri.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>