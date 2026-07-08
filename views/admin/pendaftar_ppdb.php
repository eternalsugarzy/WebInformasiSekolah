<?php
// Fix Path
$rootPath = dirname(__DIR__, 2);
require_once $rootPath . '/models/PPDBModel.php';

$ppdbModel = new PPDBModel();
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// --- 1. LOGIKA ACTION (HAPUS, UPDATE STATUS, EDIT, TAMBAH) ---

// A. HAPUS
if ($aksi == 'hapus' && isset($_GET['id'])) {
    if ($ppdbModel->hapusPendaftar($_GET['id'])) {
        echo "<script>alert('Data berhasil dihapus'); window.location='pendaftar_ppdb.php';</script>";
        exit;
    }
}

// B. UPDATE STATUS
if ($aksi == 'update_status' && isset($_POST['id_pendaftar'])) {
    $status = $_POST['status_seleksi'];
    $id = $_POST['id_pendaftar'];
    if ($ppdbModel->updateStatus($id, $status)) {
        echo "<script>alert('Status berhasil diubah menjadi $status'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    }
}

// C. PROSES EDIT DATA (DENGAN VALIDASI DUPLIKASI)
if ($aksi == 'proses_edit' && isset($_POST['id_pendaftar'])) {
    $id = $_POST['id_pendaftar'];
    $data = $_POST;
    
    // [VALIDASI] Cek Duplikasi Dulu!
    // Kita kirim ID ($id) agar sistem tahu ini sedang EDIT (exclude diri sendiri)
    $duplikat = $ppdbModel->cekDuplikasiData($data['nisn'], $data['nik'], $data['no_akte_lahir'], $id);
    
    if ($duplikat) {
        // Jika ditemukan data kembar
        $pesan = "GAGAL UPDATE! Data duplikat ditemukan.\\n";
        $pesan .= "Data bentrok dengan siswa bernama: " . $duplikat['nama_lengkap'] . "\\n";
        
        if ($duplikat['nisn'] == $data['nisn']) $pesan .= "- NISN sudah terpakai\\n";
        if ($duplikat['nik'] == $data['nik']) $pesan .= "- NIK sudah terpakai\\n";
        if ($duplikat['no_akte_lahir'] == $data['no_akte_lahir']) $pesan .= "- No Akte Lahir sudah terpakai\\n";
        
        echo "<script>alert('$pesan'); history.back();</script>";
        exit; // Stop proses, jangan simpan!
    }

    // Jika aman, lanjut proses upload foto
    $data['foto_siswa'] = ''; 
    if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] === 0) {
        $target_dir = "uploads/peserta/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        $file_ext = strtolower(pathinfo($_FILES["foto_baru"]["name"], PATHINFO_EXTENSION));
        $new_name = time() . '_' . rand(100, 999) . '.' . $file_ext;
        $target_file = $target_dir . $new_name;
        if (move_uploaded_file($_FILES["foto_baru"]["tmp_name"], $target_file)) {
            $data['foto_siswa'] = $new_name;
        }
    }

    // Simpan ke Database
    if ($ppdbModel->updatePendaftar($data, $id)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='pendaftar_ppdb.php?aksi=detail&id=$id';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal update data.'); history.back();</script>";
        exit;
    }
}

// D. PROSES TAMBAH DATA MANUAL (ADMIN)
if ($aksi == 'proses_tambah' && isset($_POST['nisn'])) {
    $data = $_POST;
    
    // [VALIDASI] Cek Duplikasi (Tanpa ID karena data baru)
    $duplikat = $ppdbModel->cekDuplikasiData($data['nisn'], $data['nik'], $data['no_akte_lahir'], null);
    
    if ($duplikat) {
        $pesan = "GAGAL SIMPAN! Data duplikat ditemukan.\\n";
        $pesan .= "Data bentrok dengan siswa bernama: " . $duplikat['nama_lengkap'] . "\\n";
        
        if ($duplikat['nisn'] == $data['nisn']) $pesan .= "- NISN sudah terpakai\\n";
        if ($duplikat['nik'] == $data['nik']) $pesan .= "- NIK sudah terpakai\\n";
        if ($duplikat['no_akte_lahir'] == $data['no_akte_lahir']) $pesan .= "- No Akte Lahir sudah terpakai\\n";
        
        echo "<script>alert('$pesan'); history.back();</script>";
        exit;
    }

    // Proses upload foto jika ada
    $data['foto_siswa'] = '';
    if (isset($_FILES['foto_siswa']) && $_FILES['foto_siswa']['error'] === 0) {
        $target_dir = "uploads/peserta/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        
        // Validasi ukuran file (max 2MB)
        if ($_FILES['foto_siswa']['size'] > 2097152) {
            echo "<script>alert('Ukuran foto terlalu besar! Maksimal 2MB'); history.back();</script>";
            exit;
        }
        
        // Validasi tipe file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($_FILES["foto_siswa"]["name"], PATHINFO_EXTENSION));
        
        if (!in_array($file_ext, $allowed_types)) {
            echo "<script>alert('Format foto tidak valid! Gunakan JPG, PNG, atau GIF'); history.back();</script>";
            exit;
        }
        
        $new_name = time() . '_' . rand(100, 999) . '.' . $file_ext;
        $target_file = $target_dir . $new_name;
        
        if (move_uploaded_file($_FILES["foto_siswa"]["tmp_name"], $target_file)) {
            $data['foto_siswa'] = $new_name;
        }
    }

    // Simpan ke database menggunakan method tambahPendaftar
    if ($ppdbModel->tambahPendaftar($data)) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='pendaftar_ppdb.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal menyimpan data. Silakan coba lagi.'); history.back();</script>";
        exit;
    }
}

// --- 2. PERSIAPAN DATA ---
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
        // TAMPILAN 0: FORM TAMBAH DATA (BARU)
        // ==========================================================
        if ($aksi == 'tambah'):
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box" style="background: #fff; padding: 25px; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        <div class="row">
                            <div class="col-md-6"><h4><i class="fa fa-plus-circle"></i> Tambah Data Siswa Baru</h4></div>
                            <div class="col-md-6 text-right"><a href="pendaftar_ppdb.php" class="btn btn-default">Batal</a></div>
                        </div>
                        <hr>

                        <form action="pendaftar_ppdb.php?aksi=proses_tambah" method="POST" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 style="border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 15px;"><i class="fa fa-user"></i> Data Pribadi</h5>
                                    
                                    <div class="form-group">
                                        <label>NISN <span class="text-danger">*</span></label>
                                        <input type="number" name="nisn" class="form-control" placeholder="Masukkan NISN" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota/Kabupaten" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" name="tanggal_lahir" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Agama <span class="text-danger">*</span></label>
                                        <select name="agama" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Buddha">Buddha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jalur Seleksi <span class="text-danger">*</span></label>
                                        <select name="jalur_seleksi" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="Zonasi">Zonasi</option>
                                            <option value="Afirmasi">Afirmasi</option>
                                            <option value="Prestasi">Prestasi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" class="form-control" rows="3" placeholder="Jalan, RT/RW, Kelurahan, Kecamatan" required></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5 style="border-bottom: 2px solid #28a745; padding-bottom: 5px; margin-bottom: 15px;"><i class="fa fa-phone"></i> Kontak & Berkas</h5>
                                    
                                    <div class="form-group">
                                        <label>No HP Siswa</label>
                                        <input type="text" name="no_hp_siswa" class="form-control" placeholder="08xxxxxxxxxx">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Siswa</label>
                                        <input type="email" name="email_siswa" class="form-control" placeholder="email@example.com">
                                    </div>
                                    <div class="form-group">
                                        <label>No. Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                        <input type="text" name="no_kk" class="form-control" placeholder="16 digit" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control" placeholder="16 digit" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Akte Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="no_akte_lahir" class="form-control" placeholder="Nomor akte kelahiran" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Siswa</label>
                                        <input type="file" name="foto_siswa" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: JPG, PNG, JPEG (Max 2MB)</small>
                                    </div>

                                    <h5 style="border-bottom: 2px solid #ffc107; padding-bottom: 5px; margin-bottom: 15px; margin-top: 25px;"><i class="fa fa-graduation-cap"></i> Data Sekolah Asal</h5>
                                    
                                    <div class="form-group">
                                        <label>Nama Sekolah Asal (SMP/MTs) <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_sekolah_asal" class="form-control" placeholder="Nama lengkap sekolah" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NPSN Sekolah Asal</label>
                                        <input type="text" name="npsn_smp" class="form-control" placeholder="8 digit NPSN">
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="provinsi_smp" class="form-control" placeholder="Nama provinsi" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kabupaten/Kota Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="kabupaten_smp" class="form-control" placeholder="Nama kabupaten/kota" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="kecamatan_smp" class="form-control" placeholder="Nama kecamatan" required>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="min-width: 200px;"><i class="fa fa-save"></i> Simpan Data</button>
                                <a href="pendaftar_ppdb.php" class="btn btn-default btn-lg" style="min-width: 150px;">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php 
    
        // ==========================================================
        // TAMPILAN 1: FORM EDIT DATA (LENGKAP)
        // ==========================================================
        elseif ($aksi == 'edit' && isset($_GET['id'])):
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
                                    <h5 style="border-bottom: 2px solid #007bff; padding-bottom: 5px; margin-bottom: 15px;"><i class="fa fa-user"></i> Data Pribadi</h5>
                                    
                                    <div class="form-group">
                                        <label>NISN <span class="text-danger">*</span></label>
                                        <input type="number" name="nisn" class="form-control" value="<?php echo htmlspecialchars($d['nisn']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($d['nama_lengkap']); ?>" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tempat Lahir <span class="text-danger">*</span></label>
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($d['tempat_lahir']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($d['tanggal_lahir']); ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <option value="Laki-laki" <?php echo ($d['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php echo ($d['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Agama <span class="text-danger">*</span></label>
                                        <select name="agama" class="form-control" required>
                                            <option value="">- Pilih -</option>
                                            <?php 
                                            $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                                            foreach($agamas as $agm) {
                                                $sel = ($d['agama'] == $agm) ? 'selected' : '';
                                                echo "<option value='$agm' $sel>$agm</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jalur Seleksi <span class="text-danger">*</span></label>
                                        <select name="jalur_seleksi" class="form-control" required>
                                            <?php 
                                            $jalurs = ['Zonasi', 'Afirmasi', 'Prestasi'];
                                            foreach($jalurs as $jl) {
                                                $sel = ($d['jalur_seleksi'] == $jl) ? 'selected' : '';
                                                echo "<option value='$jl' $sel>$jl</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea name="alamat_lengkap" class="form-control" rows="3" required><?php echo htmlspecialchars($d['alamat_lengkap']); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h5 style="border-bottom: 2px solid #28a745; padding-bottom: 5px; margin-bottom: 15px;"><i class="fa fa-phone"></i> Kontak & Berkas</h5>
                                    
                                    <div class="form-group">
                                        <label>No HP Siswa</label>
                                        <input type="text" name="no_hp_siswa" class="form-control" value="<?php echo htmlspecialchars($d['no_hp_siswa']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Siswa</label>
                                        <input type="email" name="email_siswa" class="form-control" value="<?php echo htmlspecialchars($d['email_siswa']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>No. Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                        <input type="text" name="no_kk" class="form-control" value="<?php echo htmlspecialchars($d['no_kk']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control" value="<?php echo htmlspecialchars($d['nik']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>No. Akte Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="no_akte_lahir" class="form-control" value="<?php echo htmlspecialchars($d['no_akte_lahir']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Ganti Foto Siswa</label>
                                        <input type="file" name="foto_baru" class="form-control" accept="image/*">
                                        <?php if(!empty($d['foto_siswa'])): ?>
                                            <small class="text-muted">Foto saat ini: <?php echo $d['foto_siswa']; ?></small>
                                        <?php endif; ?>
                                        <small class="text-muted d-block">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, PNG, JPEG (Max 2MB)</small>
                                    </div>

                                    <h5 style="border-bottom: 2px solid #ffc107; padding-bottom: 5px; margin-bottom: 15px; margin-top: 25px;"><i class="fa fa-graduation-cap"></i> Data Sekolah Asal</h5>
                                    
                                    <div class="form-group">
                                        <label>Nama Sekolah Asal (SMP/MTs) <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_sekolah_asal" class="form-control" value="<?php echo htmlspecialchars($d['nama_sekolah_asal']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>NPSN Sekolah Asal</label>
                                        <input type="text" name="npsn_smp" class="form-control" value="<?php echo htmlspecialchars($d['npsn_smp']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Provinsi Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="provinsi_smp" class="form-control" value="<?php echo htmlspecialchars($d['provinsi_smp']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kabupaten/Kota Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="kabupaten_smp" class="form-control" value="<?php echo htmlspecialchars($d['kabupaten_smp']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Kecamatan Sekolah Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="kecamatan_smp" class="form-control" value="<?php echo htmlspecialchars($d['kecamatan_smp']); ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="min-width: 200px;"><i class="fa fa-save"></i> Simpan Perubahan</button>
                                <a href="pendaftar_ppdb.php" class="btn btn-default btn-lg" style="min-width: 150px;">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php 
        // ==========================================================
        // TAMPILAN 2: DETAIL SISWA
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
                    <?php if ($siswa['status_seleksi'] == 'Diterima'): ?>
                    <a href="cetak_surat_lulus.php?id=<?php echo $siswa['id_pendaftar']; ?>" target="_blank" class="btn btn-success pull-right" style="margin-right: 10px;"><i class="fa fa-file-pdf-o"></i> Cetak Surat Kelulusan</a>
                    <?php endif; ?>
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
                            <tr><th>Jalur Seleksi</th><td><span class="label label-info" style="padding:4px 10px;"><?php echo htmlspecialchars($siswa['jalur_seleksi']); ?></span></td></tr>
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
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <select name="provinsi" class="form-control">
                                        <option value="">- Semua -</option>
                                        <?php if(!empty($list_provinsi)): ?>
                                            <?php foreach($list_provinsi as $prov): ?>
                                                <option value="<?php echo $prov; ?>" <?php echo ($prov_selected == $prov) ? 'selected' : ''; ?>><?php echo $prov; ?></option>
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
                                                <option value="<?php echo $kab; ?>" <?php echo ($kab_selected == $kab) ? 'selected' : ''; ?>><?php echo $kab; ?></option>
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
                                    <div class="btn-group">
                                        <a href="pendaftar_ppdb.php?aksi=detail&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-info" title="Lihat"><i class="fa fa-eye"></i></a>
                                        <a href="pendaftar_ppdb.php?aksi=edit&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-warning" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <?php if ($d['status_seleksi'] == 'Diterima'): ?>
                                        <a href="cetak_surat_lulus.php?id=<?php echo $d['id_pendaftar']; ?>" target="_blank" class="btn btn-sm btn-success" title="Cetak Surat Keterangan Lulus"><i class="fa fa-file-pdf-o"></i></a>
                                        <?php endif; ?>
                                        <a href="pendaftar_ppdb.php?aksi=hapus&id=<?php echo $d['id_pendaftar']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')" title="Hapus"><i class="fa fa-trash"></i></a>
                                    </div>
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