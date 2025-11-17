<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="margin-bottom: 20px; text-transform: uppercase; font-weight: 700;">Edit Berita</h4>
                </div>
            </div>
            
            <form method="POST" action="berita.php?aksi=update" enctype="multipart/form-data">
                
                <input type="hidden" name="id_berita" value="<?php echo $berita['id_berita']; ?>">

                <div class="form-group">
                    <label>Judul Berita</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($berita['judul']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="Kegiatan Sekolah" <?php if($berita['kategori'] == 'Kegiatan Sekolah') echo 'selected'; ?>>Kegiatan Sekolah</option>
                                <option value="Prestasi" <?php if($berita['kategori'] == 'Prestasi') echo 'selected'; ?>>Prestasi</option>
                                <option value="Akademik" <?php if($berita['kategori'] == 'Akademik') echo 'selected'; ?>>Akademik</option>
                                <option value="Pengumuman" <?php if($berita['kategori'] == 'Pengumuman') echo 'selected'; ?>>Pengumuman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Publikasi (Info)</label>
                            <input type="text" class="form-control" value="<?php echo $berita['tanggal_publikasi']; ?>" readonly style="background: #eee;">
                            <small class="text-muted">Tanggal tidak dapat diubah.</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi Berita</label>
                    <textarea name="konten" class="form-control" rows="10" required><?php echo htmlspecialchars($berita['konten_lengkap']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ganti Gambar Utama (Opsional)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*">
                            <small class="text-danger">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Gambar Saat Ini:</label><br>
                        <?php 
                            $img_path = "uploads/berita/" . $berita['gambar_utama'];
                            if(!empty($berita['gambar_utama']) && file_exists($img_path)): 
                        ?>
                            <img src="<?php echo $img_path; ?>" style="max-width: 150px; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada gambar.</span>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Perubahan</button>
                <a href="berita.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>