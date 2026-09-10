<?php
require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4><i class="fa fa-table"></i> Laporan Rekap Pendaftaran PPDB</h4>
            <hr>
            <p>Laporan ini menampilkan daftar seluruh pendaftar PPDB secara lengkap satu baris per siswa: Nama, NISN, Jalur, Asal Sekolah, Nilai Rapor, Nilai Tes, Prestasi, Jarak, dan Status seleksi. Gunakan filter di bawah untuk mempersempit data sebelum mencetak.</p>

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> Kosongkan filter untuk mencetak seluruh data pendaftar dari semua tahun.
            </div>

            <form action="cetak_rekap_ppdb.php" method="GET" target="_blank" class="form-inline" style="gap: 10px; display:flex; flex-wrap: wrap; align-items:flex-end;">
                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Tahun Ajaran</label>
                    <select name="tahun" class="form-control">
                        <option value="">-- Semua Tahun --</option>
                        <?php foreach ($daftar_tahun as $th): ?>
                            <option value="<?php echo htmlspecialchars($th); ?>"><?php echo htmlspecialchars($th); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Jalur Seleksi</label>
                    <select name="jalur" class="form-control">
                        <option value="">-- Semua Jalur --</option>
                        <option value="Zonasi">Zonasi</option>
                        <option value="Prestasi">Prestasi</option>
                        <option value="Afirmasi">Afirmasi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label style="display:block; font-size:12px; font-weight:600;">Status Seleksi</label>
                    <select name="status" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diterima">Diterima</option>
                        <option value="Cadangan">Cadangan</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa fa-file-pdf-o"></i> Cetak Laporan Rekap Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
