<?php
// Fix Path Root Project (Agar tidak error path)
$rootPath = dirname(__DIR__, 2);
require_once $rootPath . '/models/PPDBModel.php';

$ppdbModel = new PPDBModel();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// ==========================================================
// 1. LOGIKA ACTION (HAPUS, UPDATE STATUS, EDIT)
// ==========================================================

// A. HAPUS
if ($aksi == 'hapus' && isset($_GET['id'])) {
    if ($ppdbModel->hapusPendaftar($_GET['id'])) {
        echo "<script>alert('Data berhasil dihapus'); window.location='pendaftar_ppdb.php';</script>";
        exit;
    }
}

// B. UPDATE STATUS (QUICK)
if ($aksi == 'update_status' && isset($_POST['id_pendaftar'])) {
    $status = $_POST['status_seleksi'];
    $id = $_POST['id_pendaftar'];
    if ($ppdbModel->updateStatus($id, $status)) {
        echo "<script>alert('Status berhasil diubah menjadi $status'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    }
}

// C. PROSES EDIT DATA (LENGKAP)
if ($aksi == 'proses_edit' && isset($_POST['id_pendaftar'])) {
    $id = $_POST['id_pendaftar'];
    $data = $_POST; // Ambil semua data teks dari form
    
    // Handle Upload Foto Baru (Jika Ada)
    $data['foto_siswa'] = ''; // Default kosong (artinya tidak ganti foto)
    
    if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] === 0) {
        $target_dir = "uploads/peserta/";
        // Buat folder jika belum ada
        if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
        
        $file_ext = strtolower(pathinfo($_FILES["foto_baru"]["name"], PATHINFO_EXTENSION));
        // Nama file unik: timestamp + random number
        $new_name = time() . '_' . rand(100, 999) . '.' . $file_ext;
        $target_file = $target_dir . $new_name;

        // Upload
        if (move_uploaded_file($_FILES["foto_baru"]["tmp_name"], $target_file)) {
            $data['foto_siswa'] = $new_name;
        }
    }

    if ($ppdbModel->updatePendaftar($data, $id)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui data.'); history.back();</script>";
        exit;
    }
}

// ==========================================================
// 2. PERSIAPAN DATA VIEW
// ==========================================================
$q = isset($_GET['q']) ? $_GET['q'] : '';
$prov_selected = isset($_GET['provinsi']) ? $_GET['provinsi'] : '';
$kab_selected = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '';

$list_provinsi = $ppdbModel->getListProvinsi(); 
$list_kabupaten = $ppdbModel->getListKabupaten();
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
        // TAMPILAN 1: FORM EDIT DATA (Formulir Edit)
        // ==========================================================
        if ($aksi == 'edit' && isset($_GET['id'])):
            $d = $ppdbModel->getPendaftarById($_GET['id']);
            if (!$d) { echo "<script>alert('Data tidak ditemukan'); window.location='pendaftar_ppdb.php';</script>"; exit; }
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box" style="background: #fff; padding: 25px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        <div class="row">
                            <div class="col-md-6"><h4><i class="fa fa-pencil"></i> Edit Data Siswa</h4></div>
                            <div class="col-md-6 text-right"><a href="pendaftar_ppdb.php" class="btn btn-default">Batal</a></div>
                        </div>
                        <hr>

                        <form action="pendaftar_ppdb.php?aksi=proses_edit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_pendaftar" value="<?php echo $d['id_pendaftar']; ?>">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NISN</label>
                                        <input type="number" name="nisn" class="form-control" value="<?php echo htmlspecialchars($d['nisn']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($d['nama_lengkap']); ?>" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir</label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($d['tempat_lahir']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($d['tanggal_lahir']); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="Laki-laki" <?php echo ($d['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php echo ($d['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select name="agama" class="form-control">
                                            <?php 
                                            $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                                            foreach($agamas as $agm) {
                                                $sel = ($d['agama'] == $agm) ? 'selected' : '';
                                                echo "<option value='$agm' $sel>$agm</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="text" name="no_hp_siswa" class="form-control" value="<?php echo htmlspecialchars($d['no_hp_siswa']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email_siswa" class="form-control" value="<?php echo htmlspecialchars($d['email_siswa']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Asal Sekolah (SMP/MTs)</label>
                                        <input type="text" name="nama_sekolah_asal" class="form-control" value="<?php echo htmlspecialchars($d['nama_sekolah_asal']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NPSN Sekolah Asal</label>
                                        <input type="text" name="npsn_smp" class="form-control" value="<?php echo htmlspecialchars($d['npsn_smp']); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Alamat Lengkap</label>
                                        <textarea name="alamat_lengkap" class="form-control" rows="2"><?php echo htmlspecialchars($d['alamat_lengkap']); ?></textarea>
                                    </div>

                                    <input type="hidden" name="no_kk" value="<?php echo htmlspecialchars($d['no_kk']); ?>">
                                    <input type="hidden" name="nik" value="<?php echo htmlspecialchars($d['nik']); ?>">
                                    <input type="hidden" name="no_akte_lahir" value="<?php echo htmlspecialchars($d['no_akte_lahir']); ?>">
                                    <input type="hidden" name="provinsi_smp" value="<?php echo htmlspecialchars($d['provinsi_smp']); ?>">
                                    <input type="hidden" name="kabupaten_smp" value="<?php echo htmlspecialchars($d['kabupaten_smp']); ?>">
                                    <input type="hidden" name="kecamatan_smp" value="<?php echo htmlspecialchars($d['kecamatan_smp']); ?>">

                                    <div class="form-group">
                                        <label>Ganti Foto (Biarkan kosong jika tidak diganti)</label>
                                        <input type="file" name="foto_baru" class="form-control">
                                        <?php if(!empty($d['foto_siswa'])): ?>
                                            <small class="text-muted">Foto saat ini: <?php echo $d['foto_siswa']; ?></small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>

        <?php 
        // ==========================================================
        // TAMPILAN 2: DETAIL SISWA (READ ONLY)
        // ==========================================================
        elseif ($aksi == 'detail' && isset($_GET['id'])): 
            $siswa = $ppdbModel->getPendaftarById($_GET['id']);
            $foto_url = (!empty($siswa) && !empty($siswa['foto_siswa'])) ? "uploads/peserta/" . $siswa['foto_siswa'] : "../img/default-user.png";
            
            if(!$siswa) {
                echo "<div class='alert alert-danger'>Data siswa tidak ditemukan!</div>";
            } else {
        ?>
            <div class="row">
                <div class="col-md-12 mb-3" style="margin-bottom: 20px;">
                    <a href="pendaftar_ppdb.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="pendaftar_ppdb.php?aksi=edit&id=<?php echo $siswa['id_pendaftar']; ?>" class="btn btn-warning pull-right"><i class="fa fa-pencil"></i> Edit Data</a>
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
                            <tr><th>Asal Sekolah</th><td><?php echo $siswa['nama_sekolah_asal']; ?></td></tr>
                            <tr><th>No. HP</th><td><?php echo $siswa['no_hp_siswa']; ?></td></tr>
                            <tr><th>Alamat</th><td><?php echo $siswa['alamat_lengkap']; ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php else: ?>
        
        <div class="card-box" style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <div class="row" style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
                    <div class="col-md-6"><h4 style="margin:0;">Data Pendaftar Masuk</h4></div>
                    <div class="col-md-6 text-right">
                        <a href="pendaftar_ppdb.php?aksi=tambah" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Manual</a>
                    </div>
                </div>

                <div style="background-color: #f8f9fa; border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <form method="GET" action="pendaftar_ppdb.php">
                        <h5 style="margin-top: 0; margin-bottom: 15px; font-weight: bold; color: #555; border-bottom: 1px dashed #ccc; padding-bottom: 5px;">
                            <i class="fa fa-filter"></i> Filter & Pencarian
                        </h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select name="provinsi" class="form-control">
                                        <option value="">- Semua -</option>
                                        <?php foreach($list_provinsi as $prov): ?>
                                            <option value="<?php echo $prov; ?>" <?php echo ($prov_selected == $prov) ? 'selected' : ''; ?>><?php echo $prov; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <select name="kabupaten" class="form-control">
                                        <option value="">- Semua -</option>
                                        <?php foreach($list_kabupaten as $kab): ?>
                                            <option value="<?php echo $kab; ?>" <?php echo ($kab_selected == $kab) ? 'selected' : ''; ?>><?php echo $kab; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cari Nama / No. Reg</label>
                                    <input type="text" name="q" class="form-control" placeholder="Ketik kata kunci..." value="<?php echo htmlspecialchars($q); ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" class="btn btn-success btn-block" style="margin-bottom: 5px;"><i class="fa fa-search"></i> Cari</button>
                                    <a href="pendaftar_ppdb.php" class="btn btn-default btn-block"><i class="fa fa-refresh"></i> Reset</a>
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
                                <td><span style="font-weight:bold; color: #555;"><?php echo $d['no_registrasi']; ?></span></td>
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
                                    <div class="btn-group">
                                        <a href="pendaftar_ppdb.php?aksi=detail&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-info" title="Lihat"><i class="fa fa-eye"></i></a>
                                        <a href="pendaftar_ppdb.php?aksi=edit&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a href="pendaftar_ppdb.php?aksi=hapus&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center' style='padding: 20px; font-weight: bold;'>Tidak ada data ditemukan.</td></tr>";
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {

    // Fungsi Reusable untuk Cek Data
    function cekData(selectorInput, selectorMsg, tipeKolom) {
        $(selectorInput).on('change keyup', function() {
            var nilai = $(this).val();
            
            // Jika kosong, sembunyikan pesan
            if(nilai == '') {
                $(selectorMsg).html('');
                $(selectorInput).css('border-color', '#ccc');
                return;
            }

            // Panggil API dengan AJAX
            $.ajax({
                url: 'process/api_cek_data.php', // Pastikan path ini benar!
                type: 'POST',
                data: {
                    type: tipeKolom,
                    value: nilai
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'error') {
                        // Data Duplikat Ditemukan
                        $(selectorMsg).html('<i class="fa fa-times-circle"></i> ' + response.message).css('color', 'red');
                        $(selectorInput).css('border-color', 'red');
                        $('#btnSubmit').prop('disabled', true); // Matikan tombol daftar
                    } else {
                        // Data Aman
                        $(selectorMsg).html('<i class="fa fa-check-circle"></i> Tersedia').css('color', 'green');
                        $(selectorInput).css('border-color', 'green');
                        $('#btnSubmit').prop('disabled', false); // Hidupkan tombol daftar
                    }
                },
                error: function() {
                    console.log('Error memanggil API cek data');
                }
            });
        });
    }

    // Jalankan fungsi untuk masing-masing kolom
    cekData('#nisn', '#msg_nisn', 'nisn');
    cekData('#nik', '#msg_nik', 'nik');
    cekData('#no_akte_lahir', '#msg_akte', 'no_akte_lahir');

});
</script>