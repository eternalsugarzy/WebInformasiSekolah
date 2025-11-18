<?php 
require_once '../views/admin/template/header.php'; 
require_once '../views/admin/template/sidebar.php'; 
?>
<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-print"></i> Laporan Rekap Berita</h4>
            <hr>
            <p>Pilih periode tanggal berita yang ingin dicetak:</p>
            
            <form action="cetak_berita.php" method="GET" target="_blank">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dari Tanggal</label>
                            <input type="date" name="tgl_awal" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sampai Tanggal</label>
                            <input type="date" name="tgl_akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak Laporan</button>
            </form>
        </div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>