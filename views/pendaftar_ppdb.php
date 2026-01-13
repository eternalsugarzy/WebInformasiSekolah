<?php
require_once '../config/database.php';
require_once '../models/PPDBModel.php';

$ppdbModel = new PPDBModel();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// --- LOGIKA UTAMA (Action) ---

// 1. Logika Hapus
if ($aksi == 'hapus' && isset($_GET['id'])) {
    if ($ppdbModel->hapusPendaftar($_GET['id'])) {
        echo "<script>alert('Data berhasil dihapus'); window.location='pendaftar_ppdb.php';</script>";
        exit;
    }
}

// 2. Logika Update Status
if ($aksi == 'update_status' && isset($_POST['id_pendaftar'])) {
    $status = $_POST['status_seleksi'];
    $id = $_POST['id_pendaftar'];
    if ($ppdbModel->updateStatus($id, $status)) {
        echo "<script>alert('Status berhasil diubah menjadi $status'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    }
}

// --- PERSIAPAN DATA FILTER & PENCARIAN ---

// 1. Ambil data parameter dari URL (untuk menjaga nilai input tetap ada setelah refresh)
$q = isset($_GET['q']) ? $_GET['q'] : '';
$prov_selected = isset($_GET['provinsi']) ? $_GET['provinsi'] : '';
$kab_selected = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '';

// 2. Ambil Data List untuk Dropdown (Dari Model yang baru ditambahkan)
$list_provinsi = $ppdbModel->getListProvinsi(); 
$list_kabupaten = $ppdbModel->getListKabupaten();

// 3. Ambil Data Pendaftar Utama
// PENTING: Kita kirim seluruh $_GET agar Model bisa memilah 'q' (keyword) atau filter lainnya
$data_pendaftar = $ppdbModel->getAllPendaftar($_GET); 

$title = "Data Pendaftar PPDB";
require_once 'template/header.php';
require_once 'template/sidebar.php';
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        
        <?php 
        // --- TAMPILAN DETAIL SISWA ---
        if ($aksi == 'detail' && isset($_GET['id'])): 
            $siswa = $ppdbModel->getPendaftarById($_GET['id']);
            
            if(!$siswa) {
                echo "<div class='alert alert-danger'>Data siswa tidak ditemukan!</div>";
            } else {
                $foto_url = !empty($siswa['foto_siswa']) ? "uploads/peserta/" . $siswa['foto_siswa'] : "../img/default-user.png";
        ?>
            <div class="row">
                <div class="col-md-12 mb-3" style="margin-bottom: 20px;">
                    <a href="pendaftar_ppdb.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="col-md-4">
                    <div class="card-box text-center">
                        <img src="<?php echo $foto_url; ?>" style="width: 100%; max-width: 250px; border-radius: 10px; margin-bottom: 15px; border: 1px solid #ddd;">
                        
                        <h4 style="margin-bottom: 5px;"><?php echo htmlspecialchars($siswa['nama_lengkap']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($siswa['no_registrasi']); ?></p>

                        <hr>
                        
                        <form action="pendaftar_ppdb.php?aksi=update_status" method="POST">
                            <input type="hidden" name="id_pendaftar" value="<?php echo $siswa['id_pendaftar']; ?>">
                            <div class="form-group">
                                <label>Status Seleksi:</label>
                                <select name="status_seleksi" class="form-control" style="text-align-last:center; font-weight:bold;">
                                    <option value="Menunggu" <?php echo ($siswa['status_seleksi'] == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                                    <option value="Diterima" <?php echo ($siswa['status_seleksi'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                    <option value="Ditolak" <?php echo ($siswa['status_seleksi'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                    <option value="Cadangan" <?php echo ($siswa['status_seleksi'] == 'Cadangan') ? 'selected' : ''; ?>>Cadangan</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-box">
                        <h4><i class="fa fa-user"></i> Biodata Lengkap</h4>
                        <table class="table table-bordered">
                            <tr><th width="30%">NISN</th><td><?php echo $siswa['nisn']; ?></td></tr>
                            <tr><th>Nama Lengkap</th><td><?php echo $siswa['nama_lengkap']; ?></td></tr>
                            <tr><th>TTL</th><td><?php echo $siswa['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($siswa['tanggal_lahir'])); ?></td></tr>
                            <tr><th>Jenis Kelamin</th><td><?php echo $siswa['jenis_kelamin']; ?></td></tr>
                            <tr><th>Agama</th><td><?php echo $siswa['agama']; ?></td></tr>
                            <tr><th>Alamat</th><td><?php echo $siswa['alamat_lengkap']; ?></td></tr>
                            <tr><th>No. HP</th><td><?php echo $siswa['no_hp_siswa']; ?></td></tr>
                            <tr><th>Email</th><td><?php echo $siswa['email_siswa']; ?></td></tr>
                        </table>

                        <h4 style="margin-top: 20px;"><i class="fa fa-graduation-cap"></i> Data Sekolah Asal</h4>
                        <table class="table table-bordered">
                            <tr><th width="30%">NPSN SMP</th><td><?php echo $siswa['npsn_smp']; ?></td></tr>
                            <tr><th>Nama Sekolah</th><td><?php echo $siswa['nama_sekolah_asal']; ?></td></tr>
                            <tr><th>Lokasi</th><td><?php echo $siswa['kecamatan_smp'] . ', ' . $siswa['kabupaten_smp'] . ', ' . $siswa['provinsi_smp']; ?></td></tr>
                        </table>

                        <h4 style="margin-top: 20px;"><i class="fa fa-file"></i> Berkas</h4>
                        <table class="table table-bordered">
                            <tr><th width="30%">No. KK</th><td><?php echo $siswa['no_kk']; ?></td></tr>
                            <tr><th>NIK</th><td><?php echo $siswa['nik']; ?></td></tr>
                            <tr><th>No. Akte</th><td><?php echo $siswa['no_akte_lahir']; ?></td></tr>
                            <tr><th>Tanggal Daftar</th><td><?php echo date('d F Y H:i', strtotime($siswa['tanggal_daftar'])); ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php 
            } // End if data found 
        ?>

        <?php else: ?>
        <div class="card-box">
                <div class="row mb-3" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <h4>Data Pendaftar Masuk</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="pendaftar_ppdb.php?aksi=tambah" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Manual
                        </a>
                    </div>
                </div>

                <div class="well" style="background: #f1f2f6; border: 1px solid #ddd; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                    <form method="GET" action="pendaftar_ppdb.php">
                        <h5 style="margin-top: 0; margin-bottom: 15px; font-weight: bold; color: #555;"><i class="fa fa-filter"></i> Filter & Pencarian</h5>
                        <div class="row">
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Provinsi Sekolah</label>
                                    <select name="provinsi" class="form-control">
                                        <option value="">- Semua Provinsi -</option>
                                        <?php if(!empty($list_provinsi)): ?>
                                            <?php foreach($list_provinsi as $prov): ?>
                                                <option value="<?php echo $prov; ?>" <?php echo ($prov_selected == $prov) ? 'selected' : ''; ?>>
                                                    <?php echo $prov; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kabupaten/Kota</label>
                                    <select name="kabupaten" class="form-control">
                                        <option value="">- Semua Kab/Kota -</option>
                                        <?php if(!empty($list_kabupaten)): ?>
                                            <?php foreach($list_kabupaten as $kab): ?>
                                                <option value="<?php echo $kab; ?>" <?php echo ($kab_selected == $kab) ? 'selected' : ''; ?>>
                                                    <?php echo $kab; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cari (Nama / NISN / No. Reg)</label>
                                    <div class="input-group">
                                        <input type="text" name="q" class="form-control" placeholder="Kata kunci..." value="<?php echo htmlspecialchars($q); ?>">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <a href="pendaftar_ppdb.php" class="btn btn-default btn-block" title="Reset Filter"><i class="fa fa-refresh"></i> Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">No</th>
                                <th>No. Reg</th>
                                <th>Nama Siswa</th>
                                <th>Asal Sekolah</th>
                                <th>Tgl Daftar</th>
                                <th class="text-center">Status</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            if (!empty($data_pendaftar)) {
                                foreach ($data_pendaftar as $d) {
                                    // Logic Warna Badge
                                    $badge_color = 'warning'; 
                                    if($d['status_seleksi'] == 'Diterima') $badge_color = 'success';
                                    if($d['status_seleksi'] == 'Ditolak') $badge_color = 'danger';
                                    if($d['status_seleksi'] == 'Cadangan') $badge_color = 'info';
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><span class="badge badge-default" style="color: #333; border: 1px solid #ccc;"><?php echo $d['no_registrasi']; ?></span></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($d['nama_lengkap']); ?></strong> <br>
                                    <small class="text-muted">NISN: <?php echo $d['nisn']; ?></small>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($d['nama_sekolah_asal']); ?><br>
                                    <small class="text-muted"><?php echo $d['kabupaten_smp']; ?></small>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($d['tanggal_daftar'])); ?></td>
                                <td class="text-center">
                                    <span class="label label-<?php echo $badge_color; ?>" style="padding: 5px 10px; border-radius: 4px;">
                                        <?php echo $d['status_seleksi']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="pendaftar_ppdb.php?aksi=detail&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-info" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                    <a href="pendaftar_ppdb.php?aksi=hapus&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data siswa ini?')" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>Data tidak ditemukan atau belum ada pendaftar.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div> 
        </div> 
        <?php endif; ?>

    </div> 
</div> 

<?php require_once 'template/footer.php'; ?>