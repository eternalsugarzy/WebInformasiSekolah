<?php 
$title = "Data Pendaftar PPDB";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-6"><h4>Daftar Pendaftar PPDB</h4></div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No. Reg</th>
                            <th>Nama Pendaftar</th>
                            <th>Asal Sekolah</th>
                            <th>Status Seleksi</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (!empty($data_pendaftar)) {
                            foreach ($data_pendaftar as $p) {
                                // Logika Warna Status
                                $status = $p['status_seleksi'] ?? 'Menunggu';
                                $class = 'default';
                                if ($status == 'Diterima') $class = 'success';
                                elseif ($status == 'Cadangan') $class = 'warning';
                                elseif ($status == 'Ditolak') $class = 'danger';
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($p['no_registrasi']); ?></td>
                            <td style="font-weight:bold;"><?php echo htmlspecialchars($p['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($p['asal_sekolah']); ?></td>
                            <td>
                                <span class="label label-<?php echo $class; ?>">
                                    <?php echo $status; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="pendaftar_ppdb.php?aksi=detail&id=<?php echo $p['id_pendaftar']; ?>" class="btn btn-sm btn-default"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>Belum ada data pendaftar.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>