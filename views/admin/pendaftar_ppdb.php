<?php
// --- PERBAIKAN PATH (FIX) ---
// Mendapatkan folder root: D:\laragon\www\WebInformasiSekolah
$rootPath = dirname(__DIR__, 2);

// Load Model (Gunakan path absolut agar tidak error)
require_once $rootPath . '/models/PPDBModel.php';

// Inisialisasi Model
$ppdbModel = new PPDBModel();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// --- 1. LOGIKA ACTION (HAPUS & UPDATE) ---
if ($aksi == 'hapus' && isset($_GET['id'])) {
    if ($ppdbModel->hapusPendaftar($_GET['id'])) {
        echo "<script>alert('Data berhasil dihapus'); window.location='pendaftar_ppdb.php';</script>";
        exit;
    }
}

if ($aksi == 'update_status' && isset($_POST['id_pendaftar'])) {
    $status = $_POST['status_seleksi'];
    $id = $_POST['id_pendaftar'];
    if ($ppdbModel->updateStatus($id, $status)) {
        echo "<script>alert('Status berhasil diubah menjadi $status'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    }
}

// --- 2. PERSIAPAN DATA ---
$q = isset($_GET['q']) ? $_GET['q'] : '';
$prov_selected = isset($_GET['provinsi']) ? $_GET['provinsi'] : '';
$kab_selected = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '';

// Ambil data dropdown (Pastikan method ini ada di PPDBModel)
$list_provinsi = $ppdbModel->getListProvinsi(); 
$list_kabupaten = $ppdbModel->getListKabupaten();

// Ambil Data Utama dengan Filter
// Kita kirim seluruh $_GET agar Model bisa memilah 'q' (keyword) atau filter lainnya
$data_pendaftar = $ppdbModel->getAllPendaftar($_GET); 

$title = "Data Pendaftar PPDB";
require_once 'template/header.php';
require_once 'template/sidebar.php';
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        
        <?php 
        // ==========================================================
        // TAMPILAN 1: DETAIL SISWA
        // ==========================================================
        if ($aksi == 'detail' && isset($_GET['id'])): 
            $siswa = $ppdbModel->getPendaftarById($_GET['id']);
            $foto_url = (!empty($siswa) && !empty($siswa['foto_siswa'])) ? "uploads/peserta/" . $siswa['foto_siswa'] : "../img/default-user.png";
            
            if(!$siswa) {
                echo "<div class='alert alert-danger'>Data siswa tidak ditemukan!</div>";
            } else {
        ?>
            <div class="row">
                <div class="col-md-12 mb-3" style="margin-bottom: 20px;">
                    <a href="pendaftar_ppdb.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>

                <div class="col-md-4">
                    <div class="card-box text-center" style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
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
                    <div class="card-box" style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
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
        <?php } ?>

        <?php else: ?>
        
        <div class="card-box" style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                
                <div class="row" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                    <div class="col-md-6">
                        <h4 style="margin:0;">Data Pendaftar Masuk</h4>
                    </div>
                    <div class="col-md-6 text-right" style="text-align: right;">
                        <a href="pendaftar_ppdb.php?aksi=tambah" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Pendaftar Manual
                        </a>
                    </div>
                </div>

                <div style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <form method="GET" action="pendaftar_ppdb.php">
                        <h5 style="margin-top: 0; margin-bottom: 15px; font-weight: bold; color: #555; border-bottom: 1px dashed #ccc; padding-bottom: 5px;">
                            <i class="fa fa-filter"></i> Filter & Pencarian
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select name="provinsi" class="form-control">
                                        <option value="">- Semua -</option>
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

                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <select name="kabupaten" class="form-control">
                                        <option value="">- Semua -</option>
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

                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Cari Nama / No. Reg</label>
                                    <input type="text" name="q" class="form-control" placeholder="Ketik kata kunci..." value="<?php echo htmlspecialchars($q); ?>">
                                </div>
                            </div>

                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-success btn-block" style="margin-bottom: 5px;">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                    <a href="pendaftar_ppdb.php" class="btn btn-default btn-block">
                                        <i class="fa fa-refresh"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr style="background: #eee;">
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
                                    $badge_color = 'warning'; 
                                    if($d['status_seleksi'] == 'Diterima') $badge_color = 'success';
                                    if($d['status_seleksi'] == 'Ditolak') $badge_color = 'danger';
                                    if($d['status_seleksi'] == 'Cadangan') $badge_color = 'info';
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td>
                                    <span style="font-weight:bold; color: #555;"><?php echo $d['no_registrasi']; ?></span>
                                </td>
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
                                    <span class="label label-<?php echo $badge_color; ?>" style="padding: 5px 10px; border-radius: 4px; color: #fff; background-color: <?php echo ($badge_color == 'warning' ? '#f0ad4e' : ($badge_color == 'success' ? '#5cb85c' : '#d9534f')); ?>;">
                                        <?php echo $d['status_seleksi']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="pendaftar_ppdb.php?aksi=detail&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-info" title="Lihat"><i class="fa fa-eye"></i></a>
                                    <a href="pendaftar_ppdb.php?aksi=hapus&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')" title="Hapus"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center' style='padding: 20px; font-weight: bold;'>Tidak ada data ditemukan dengan filter tersebut.</td></tr>";
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