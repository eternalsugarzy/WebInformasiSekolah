<?php 
$title = "Kelola Info PPDB";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6"><h4>Informasi Pendaftaran (PPDB)</h4></div>
                <div class="col-md-6 text-right">
                    <a href="ppdb.php?aksi=tambah" class="btn btn-orange"><i class="fa fa-plus"></i> Tambah Info</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Jenis Informasi</th>
                            <th>Detail Singkat</th>
                            <th width="15%">Periode</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (count($data_ppdb) > 0) {
                            foreach ($data_ppdb as $d) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td style="font-weight:bold;"><?php echo htmlspecialchars($d['jenis_informasi']); ?></td>
                            <td><?php echo substr(htmlspecialchars($d['isi_detail']), 0, 80); ?>...</td>
                            <td>
                                <small class="text-muted">
                                    <?php echo date('d/m/Y', strtotime($d['tanggal_mulai'])); ?> <br> s/d <br>
                                    <?php echo date('d/m/Y', strtotime($d['tanggal_akhir'])); ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <a href="ppdb.php?aksi=hapus&id=<?php echo $d['id_info']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')"><i class="fa fa-trash"></i></a>
                            </td>
                            <td class="text-center">
                                <a href="ppdb.php?aksi=edit&id=<?php echo $d['id_info']; ?>" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Belum ada informasi PPDB.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>