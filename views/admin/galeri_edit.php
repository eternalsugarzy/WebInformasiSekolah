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
                        <input type="hidden" name="tipe" value="Foto"> 
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3"><?php echo htmlspecialchars($galeri['deskripsi']); ?></textarea>
                </div>
                
                <hr>
                
                <h5><b>Foto dalam Album ini:</b></h5>
                <div class="row">
                    <?php if(isset($fotos) && count($fotos) > 0): ?>
                        <?php foreach($fotos as $f): ?>
                        <div class="col-md-2 col-xs-6" style="margin-bottom: 15px;">
                            <div style="position: relative; border: 1px solid #ddd; padding: 3px; border-radius: 4px; background: #fff;">
                                <img src="uploads/galeri/<?php echo $f['file_foto']; ?>" style="width: 100%; height: 100px; object-fit: cover;">
                                
                                <a href="galeri.php?aksi=hapus_foto&id_foto=<?php echo $f['id_foto']; ?>&id_album=<?php echo $galeri['id_album']; ?>" 
                                   onclick="return confirm('Hapus foto ini?')"
                                   style="position: absolute; top: -8px; right: -8px; background: #ff4d4d; color: white; border-radius: 50%; width: 22px; height: 22px; text-align: center; line-height: 22px; font-size: 12px; text-decoration: none; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                    X
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <p class="text-muted" style="font-style: italic;">Belum ada foto di album ini.</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <hr>

                <div class="form-group">
                    <label>Tambah Foto Baru (Opsional)</label>
                    <input type="file" name="foto[]" class="form-control" multiple accept="image/*">
                    <small class="text-muted">Anda bisa memilih banyak foto sekaligus untuk ditambahkan ke album ini.</small>
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
                <a href="galeri.php" class="btn btn-default">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>