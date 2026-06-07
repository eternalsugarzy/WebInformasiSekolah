<div class="card-box">
    <h4 style="margin-bottom: 20px;"><i class="fa fa-cogs"></i> Pengaturan Kuota Kelulusan</h4>
    
    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Pengaturan kuota berhasil diperbarui!
        </div>
    <?php endif; ?>

    <form action="kelulusan.php?aksi=simpan" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kuota Siswa Diterima</label>
                    <input type="number" name="kuota_diterima" class="form-control" 
                           value="<?= $model->getSetting('kuota_diterima'); ?>" 
                           min="0" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kuota Siswa Cadangan</label>
                    <input type="number" name="kuota_cadangan" class="form-control" 
                           value="<?= $model->getSetting('kuota_cadangan'); ?>" 
                           min="0" required>
                </div>
            </div>
        </div>
        
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-12 text-right">
                <button type="submit" name="simpan" class="btn btn-orange">
                    <i class="fa fa-save"></i> Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
</div>  