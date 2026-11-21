<?php
require_once __DIR__ . '/template/header.php';
require_once __DIR__ . '/template/sidebar.php';

$is_edit = !empty($prestasi);
$v = function ($kolom, $default = '') use ($prestasi) {
    return htmlspecialchars($prestasi[$kolom] ?? $default);
};
$pesan_map = [
    'siswa_tidak_valid' => 'Pilih siswa yang valid (sudah diterima dan sudah daftar ulang).',
    'tidak_lengkap'     => 'Lengkapi semua kolom wajib dengan pilihan yang valid.',
    'tahun_tidak_valid' => 'Tahun prestasi tidak valid (2000 s/d ' . date('Y') . ').',
    'file_besar'        => 'Ukuran file sertifikat maksimal 2 MB.',
    'file_tidak_valid'  => 'Format sertifikat harus JPG, PNG, atau PDF.',
    'upload_gagal'      => 'Gagal mengunggah sertifikat, silakan coba lagi.',
];
?>

<div class="main-content">
    <?php require_once __DIR__ . '/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;"><i class="fa fa-trophy"></i> <?= $is_edit ? 'Edit' : 'Tambah'; ?> Prestasi Siswa</h4>

            <?php if (isset($pesan_map[$pesan])): ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> <?= $pesan_map[$pesan]; ?></div>
            <?php endif; ?>

            <?php if (count($siswa_aktif) === 0): ?>
                <div class="alert alert-warning">
                    <i class="fa fa-info-circle"></i> Belum ada siswa aktif. Prestasi hanya bisa dicatat untuk pendaftar yang berstatus
                    <b>Diterima</b> dan sudah <b>Daftar Ulang</b> (atur di menu <a href="daftar_ulang.php">Daftar Ulang</a>).
                </div>
            <?php endif; ?>

            <form method="POST" action="prestasi.php?aksi=<?= $is_edit ? 'update' : 'simpan'; ?>" enctype="multipart/form-data">
                <?php if ($is_edit): ?>
                    <input type="hidden" name="id_prestasi" value="<?= (int) $prestasi['id_prestasi']; ?>">
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Siswa <span class="text-danger">*</span></label>
                            <select name="id_pendaftar" class="form-control" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php foreach ($siswa_aktif as $s): ?>
                                    <option value="<?= (int) $s['id_pendaftar']; ?>" <?= ($is_edit && $prestasi['id_pendaftar'] == $s['id_pendaftar']) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($s['nama_lengkap']); ?> (NISN <?= htmlspecialchars($s['nisn']); ?>, angkatan <?= (int) $s['angkatan']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelas saat meraih prestasi <span class="text-danger">*</span></label>
                            <select name="kelas" class="form-control" required>
                                <?php foreach (PrestasiModel::KELAS as $k): ?>
                                    <option value="<?= $k; ?>" <?= ($v('kelas', 'X') === $k) ? 'selected' : ''; ?>><?= $k; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Prestasi / Lomba <span class="text-danger">*</span></label>
                    <input type="text" name="nama_prestasi" class="form-control" maxlength="150" required
                           placeholder="Contoh: Olimpiade Sains Nasional Bidang Matematika" value="<?= $v('nama_prestasi'); ?>">
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jenis <span class="text-danger">*</span></label>
                            <select name="jenis" class="form-control" required>
                                <?php foreach (PrestasiModel::JENIS as $j): ?>
                                    <option value="<?= $j; ?>" <?= ($v('jenis') === $j) ? 'selected' : ''; ?>><?= $j; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tingkat <span class="text-danger">*</span></label>
                            <select name="tingkat" class="form-control" required>
                                <?php foreach (PrestasiModel::TINGKAT as $t): ?>
                                    <option value="<?= $t; ?>" <?= ($v('tingkat') === htmlspecialchars($t)) ? 'selected' : ''; ?>><?= $t; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Peringkat / Juara <span class="text-danger">*</span></label>
                            <input type="text" name="peringkat" class="form-control" maxlength="50" required
                                   placeholder="Contoh: Juara 1, Medali Perak" value="<?= $v('peringkat'); ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" class="form-control" min="2000" max="<?= date('Y'); ?>" required
                                   value="<?= $v('tahun', date('Y')); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Penyelenggara <span class="text-danger">*</span></label>
                    <input type="text" name="penyelenggara" class="form-control" maxlength="150" required
                           placeholder="Contoh: Kemendikbudristek / Dinas Pendidikan Prov. Kalsel" value="<?= $v('penyelenggara'); ?>">
                </div>

                <div class="form-group">
                    <label>Bukti Sertifikat <small class="text-muted">(JPG, PNG, atau PDF, maks. 2 MB)</small></label>
                    <input type="file" name="bukti_sertifikat" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                    <?php if ($is_edit && !empty($prestasi['bukti_sertifikat'])): ?>
                        <small>Sertifikat saat ini: <a href="uploads/prestasi/<?= rawurlencode($prestasi['bukti_sertifikat']); ?>" target="_blank">lihat file</a>.
                            Kosongkan jika tidak ingin mengganti.</small>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Verifikasi</label>
                            <select name="status_verifikasi" class="form-control">
                                <?php foreach (PrestasiModel::STATUS as $st): ?>
                                    <option value="<?= $st; ?>" <?= ($v('status_verifikasi', 'Menunggu') === $st) ? 'selected' : ''; ?>><?= $st; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Catatan Verifikasi <small class="text-muted">(opsional)</small></label>
                            <input type="text" name="catatan_verifikasi" class="form-control" maxlength="255" value="<?= $v('catatan_verifikasi'); ?>">
                        </div>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-success" <?= count($siswa_aktif) === 0 ? 'disabled' : ''; ?>><i class="fa fa-save"></i> Simpan Data</button>
                <a href="prestasi.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/template/footer.php'; ?>
