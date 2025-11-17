<?php 
$title = "Kelola Data Guru";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6"><h4>Daftar Guru & Staf</h4></div>
                <div class="col-md-6 text-right">
                    <a href="guru.php?aksi=tambah" class="btn btn-orange"><i class="fa fa-plus"></i> Tambah Guru</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto</th>
                            <th>NIP/NUPTK</th>
                            <th>Nama Lengkap</th>
                            <th>Jabatan</th>
                            <th>Bidang Studi</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (count($data_guru) > 0) {
                            foreach ($data_guru as $g) {
                                $img_path = "uploads/guru/" . $g['foto'];
                                if(empty($g['foto']) || !file_exists("../admin/" . $img_path)) {
                                    $img_show = "../img/course01.jpg"; // Default avatar
                                } else {
                                    $img_show = $img_path;
                                }
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><img src="<?php echo $img_show; ?>" width="50" style="border-radius: 50%; height: 50px; object-fit: cover;"></td>
                            <td><?php echo htmlspecialchars($g['nip']); ?></td>
                            <td style="font-weight:600;"><?php echo htmlspecialchars($g['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($g['jabatan']); ?></td>
                            <td><?php echo htmlspecialchars($g['bidang_studi']); ?></td>
                            <td class="text-center">
                                <a href="guru.php?aksi=hapus&id=<?php echo $g['id_guru']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data guru ini?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Belum ada data guru.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>