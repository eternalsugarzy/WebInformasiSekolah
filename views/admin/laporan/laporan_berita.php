<h5><i class="fa fa-print"></i> Laporan Rekap Berita</h5>
<p>Pilih periode tanggal berita yang ingin dicetak:</p>

<form action="cetak_berita.php" method="GET" target="_blank" class="form-inline">
    <div class="form-group" style="margin-right: 10px;">
        <label style="margin-right: 5px;">Dari</label>
        <input type="date" name="tgl_awal" class="form-control input-sm" required>
    </div>
    <div class="form-group" style="margin-right: 10px;">
        <label style="margin-right: 5px;">Sampai</label>
        <input type="date" name="tgl_akhir" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary btn-sm" style="margin-right: 10px;">
        <i class="fa fa-print"></i> Cetak Periode
    </button>
    <a href="cetak_berita.php?tgl_awal=2000-01-01&tgl_akhir=3099-12-31" target="_blank" class="btn btn-success btn-sm">
        <i class="fa fa-file-pdf-o"></i> Cetak Semua Data
    </a>
</form>