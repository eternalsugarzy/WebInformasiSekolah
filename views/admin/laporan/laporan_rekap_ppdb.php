<h5><i class="fa fa-table"></i> Laporan Rekap Pendaftaran PPDB</h5>
<p>Daftar lengkap seluruh pendaftar, satu baris per siswa: Nama, NISN, Jalur, Asal Sekolah, nilai kriteria, dan Status seleksi. <small class="text-muted">Kosongkan filter untuk mencetak semua data.</small></p>

<form action="cetak_rekap_ppdb.php" method="GET" target="_blank" class="form-inline">
    <select name="tahun" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Tahun</option>
        <?php foreach (($daftar_tahun ?? []) as $th): ?>
            <option value="<?php echo htmlspecialchars($th); ?>"><?php echo htmlspecialchars($th); ?></option>
        <?php endforeach; ?>
    </select>
    <select name="jalur" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Jalur</option>
        <option value="Zonasi">Zonasi</option>
        <option value="Prestasi">Prestasi</option>
        <option value="Afirmasi">Afirmasi</option>
    </select>
    <select name="status" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Status</option>
        <option value="Menunggu">Menunggu</option>
        <option value="Diterima">Diterima</option>
        <option value="Cadangan">Cadangan</option>
        <option value="Ditolak">Ditolak</option>
    </select>
    <br>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> Cetak Laporan Rekap Pendaftaran</button>
</form>
