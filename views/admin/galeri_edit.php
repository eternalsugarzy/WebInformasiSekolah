<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Edit Album Galeri</h4>
            
            <form method="POST" action="galeri.php?aksi=update" enctype="multipart/form-data">
                
                <input type="hidden" name="id_album" value="<?php echo $galeri['id_album']; ?>">

                <div class="form-group">
                    <label>Judul Kegiatan / Album</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($galeri['judul_album']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo $galeri['tanggal_event']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Media</label>
                            <select name="tipe" class="form-control">
                                <option value="Foto" <?php if($galeri['tipe_media'] == 'Foto') echo 'selected'; ?>>Foto</option>
                                <option value="Video" <?php if($galeri['tipe_media'] == 'Video') echo 'selected'; ?>>Video</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?php echo htmlspecialchars($galeri['deskripsi']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ganti File Foto (Opsional)</label>
                            <input type="file" name="file" class="form-control" accept="image/*">
                            <small class="text-danger">Biarkan kosong jika tidak ingin mengganti foto.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Foto Saat Ini:</label><br>
                        <?php 
                            $img_path = "uploads/galeri/" . $galeri['file_path'];
                            if(!empty($galeri['file_path']) && file_exists($img_path)): 
                        ?>
                            <img src="<?php echo $img_path; ?>" style="max-width: 200px; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada foto.</span>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Data</button>
                <a href="galeri.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>