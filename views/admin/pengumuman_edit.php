<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Edit Pengumuman</h4>
            <form method="POST" action="pengumuman.php?aksi=update">
                
                <input type="hidden" name="id_pengumuman" value="<?php echo $pengumuman['id_pengumuman']; ?>">

                <div class="form-group">
                    <label>Judul Pengumuman</label>
                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($pengumuman['judul']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Penting / Event</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo $pengumuman['tanggal_penting']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="Aktif" <?php echo ($pengumuman['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Arsip" <?php echo ($pengumuman['status'] == 'Arsip') ? 'selected' : ''; ?>>Arsip</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi Pengumuman</label>
                    <textarea name="isi" class="form-control" rows="5" required><?php echo htmlspecialchars($pengumuman['isi_pengumuman']); ?></textarea>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Pengumuman</button>
                <a href="pengumuman.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>