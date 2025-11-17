<?php 
$title = "Tambah Galeri";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Upload Dokumentasi Kegiatan</h4>
            <form method="POST" action="galeri.php?aksi=simpan" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Judul Kegiatan / Album</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: Upacara Hari Kemerdekaan">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipe Media</label>
                            <select name="tipe" class="form-control">
                                <option value="Foto">Foto</option>
                                <option value="Video">Video</option> 
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>File Foto</label>
                    <input type="file" name="file" class="form-control" required accept="image/*">
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                <a href="galeri.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>