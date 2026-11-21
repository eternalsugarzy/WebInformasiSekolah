<?php require_once __DIR__ . '/../../../models/PrestasiModel.php'; ?>
<h5><i class="fa fa-trophy"></i> Laporan Data Siswa Berprestasi</h5>
<p>Daftar prestasi akademik &amp; non-akademik siswa beserta ringkasan jumlah per tingkat. <small class="text-muted">Bawaan: hanya prestasi Terverifikasi.</small></p>

<form action="cetak_prestasi.php" method="GET" target="_blank" class="form-inline">
    <select name="tahun" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Tahun</option>
        <?php foreach (($daftar_tahun_prestasi ?? []) as $th): ?>
            <option value="<?= (int) $th; ?>"><?= (int) $th; ?></option>
        <?php endforeach; ?>
    </select>
    <select name="jenis" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Jenis</option>
        <?php foreach (PrestasiModel::JENIS as $v): ?><option value="<?= $v; ?>"><?= $v; ?></option><?php endforeach; ?>
    </select>
    <select name="tingkat" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Tingkat</option>
        <?php foreach (PrestasiModel::TINGKAT as $v): ?><option value="<?= $v; ?>"><?= $v; ?></option><?php endforeach; ?>
    </select>
    <select name="kelas" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="">Semua Kelas</option>
        <?php foreach (PrestasiModel::KELAS as $v): ?><option value="<?= $v; ?>">Kelas <?= $v; ?></option><?php endforeach; ?>
    </select>
    <select name="status" class="form-control input-sm" style="margin: 0 5px 5px 0;">
        <option value="Terverifikasi">Terverifikasi</option>
        <option value="">Semua Status</option>
        <option value="Menunggu">Menunggu</option>
        <option value="Ditolak">Ditolak</option>
    </select>
    <br>
    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> Cetak Laporan Siswa Berprestasi</button>
</form>
