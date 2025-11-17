<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Edit Data Guru</h4>
            
            <form method="POST" action="guru.php?aksi=update" enctype="multipart/form-data">
                
                <input type="hidden" name="id_guru" value="<?php echo $guru['id_guru']; ?>">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIP / NUPTK</label>
                            <input type="text" name="nip" class="form-control" value="<?php echo htmlspecialchars($guru['nip']); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap (Gelar)</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($guru['nama_lengkap']); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control">
                                <option value="Guru Mapel" <?php if($guru['jabatan'] == 'Guru Mapel') echo 'selected'; ?>>Guru Mapel</option>
                                <option value="Wali Kelas" <?php if($guru['jabatan'] == 'Wali Kelas') echo 'selected'; ?>>Wali Kelas</option>
                                <option value="Kepala Sekolah" <?php if($guru['jabatan'] == 'Kepala Sekolah') echo 'selected'; ?>>Kepala Sekolah</option>
                                <option value="Staf TU" <?php if($guru['jabatan'] == 'Staf TU') echo 'selected'; ?>>Staf TU</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bidang Studi (Mapel)</label>
                            <input type="text" name="mapel" class="form-control" value="<?php echo htmlspecialchars($guru['bidang_studi']); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($guru['email']); ?>">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ganti Foto Profil (Opsional)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-danger">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Foto Saat Ini:</label><br>
                        <?php 
                            $img_path = "uploads/guru/" . $guru['foto'];
                            if(!empty($guru['foto']) && file_exists($img_path)): 
                        ?>
                            <img src="<?php echo $img_path; ?>" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid #eee;">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada foto.</span>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Data</button>
                <a href="guru.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>