<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
require_once __DIR__ . '/../../../models/PrestasiModel.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-trophy"></i> Laporan Data Siswa Berprestasi</h4>
            <hr>
            <p>Laporan ini menampilkan daftar prestasi akademik dan non-akademik siswa, lengkap dengan ringkasan jumlah prestasi per tingkat
                (Sekolah s/d Internasional) dan per jenis. Gunakan filter di bawah sebelum mencetak.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Secara bawaan hanya prestasi yang sudah <b>Terverifikasi</b> yang dicetak. Data dikelola di menu <b>Prestasi Siswa</b>.
            </div>

            <form action="cetak_prestasi.php" method="GET" target="_blank" style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-end;">
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Tahun</label>
                    <select name="tahun" class="form-control">
                        <option value="">-- Semua Tahun --</option>
                        <?php foreach (($daftar_tahun_prestasi ?? []) as $th): ?>
                            <option value="<?= (int) $th; ?>"><?= (int) $th; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Jenis</label>
                    <select name="jenis" class="form-control">
                        <option value="">-- Semua Jenis --</option>
                        <?php foreach (PrestasiModel::JENIS as $v): ?><option value="<?= $v; ?>"><?= $v; ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Tingkat</label>
                    <select name="tingkat" class="form-control">
                        <option value="">-- Semua Tingkat --</option>
                        <?php foreach (PrestasiModel::TINGKAT as $v): ?><option value="<?= $v; ?>"><?= $v; ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Kelas</label>
                    <select name="kelas" class="form-control">
                        <option value="">-- Semua Kelas --</option>
                        <?php foreach (PrestasiModel::KELAS as $v): ?><option value="<?= $v; ?>"><?= $v; ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Status Verifikasi</label>
                    <select name="status" class="form-control">
                        <option value="Terverifikasi">Terverifikasi</option>
                        <option value="">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-file-pdf-o"></i> Cetak Laporan Siswa Berprestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
