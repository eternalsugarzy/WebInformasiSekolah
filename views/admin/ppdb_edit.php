<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Edit Informasi PPDB</h4>
            
            <form method="POST" action="ppdb.php?aksi=update">
                
                <input type="hidden" name="id_info" value="<?php echo $ppdb['id_info']; ?>">

                <div class="form-group">
                    <label>Jenis Informasi</label>
                    <input type="text" name="jenis" class="form-control" value="<?php echo htmlspecialchars($ppdb['jenis_informasi']); ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Mulai Berlaku</label>
                            <input type="date" name="tgl_mulai" class="form-control" value="<?php echo $ppdb['tanggal_mulai']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Berakhir</label>
                            <input type="date" name="tgl_akhir" class="form-control" value="<?php echo $ppdb['tanggal_akhir']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi Detail / Persyaratan</label>
                    <textarea name="isi" class="form-control" rows="5" required><?php echo htmlspecialchars($ppdb['isi_detail']); ?></textarea>
                </div>

                <div class="form-group">
                    <label>Link Formulir Pendaftaran (Jika ada)</label>
                    <input type="text" name="link" class="form-control" value="<?php echo htmlspecialchars($ppdb['tautan_formulir']); ?>">
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Data</button>
                <a href="ppdb.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>