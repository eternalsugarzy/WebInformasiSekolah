<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>
<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>
    <div class="content-wrapper">
        <div class="card-box" style="box-shadow: none; border: 1px solid #ccc; padding: 25px; margin-top: 20px;">
    
    <h5><i class="fa fa-print"></i> Laporan Rekap Berita</h5>
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
            <div class="col-md-4">
                </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" style="margin-right: 10px;">
                    <i class="fa fa-print"></i> Cetak Berdasarkan Periode
                </button>
                
                <a href="cetak_berita.php?tgl_awal=2000-01-01&tgl_akhir=3099-12-31" 
                   target="_blank" 
                   class="btn btn-success">
                    <i class="fa fa-file-pdf-o"></i> Cetak Seluruh Data (Semua Periode)
                </a>
            </div>
        </div>
        
    </form>
</div>
    </div>
</div>
<?php require_once '../views/admin/template/footer.php'; ?>