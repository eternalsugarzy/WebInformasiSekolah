<?php
require_once __DIR__ . '/template/header.php';
require_once __DIR__ . '/template/sidebar.php';

$pesan_map = [
    'sukses'           => ['success', 'Data gelombang berhasil disimpan. Pendaftar sudah dipetakan ulang sesuai tanggal daftarnya.'],
    'terhapus'         => ['success', 'Gelombang berhasil dihapus. Pendaftar di rentang tanggal tersebut kini tercatat "Tanpa Gelombang".'],
    'tidak_valid'      => ['danger', 'Nama gelombang dan tanggal wajib diisi dengan benar.'],
    'tanggal_terbalik' => ['danger', 'Tanggal akhir tidak boleh lebih awal dari tanggal mulai.'],
    'bentrok'          => ['danger', 'Rentang tanggal bertabrakan dengan ' . htmlspecialchars($info_bentrok) . '. Setiap tanggal hanya boleh masuk ke satu gelombang.'],
    'gagal'            => ['danger', 'Terjadi kegagalan, silakan coba lagi.'],
];
?>

<div class="main-content">
    <?php require_once __DIR__ . '/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom:5px;"><i class="fa fa-calendar"></i> Gelombang Pendaftaran PPDB</h4>
            <p style="color:#888; margin-bottom:20px;">
                Gelombang membagi periode pendaftaran dalam satu tahun ajaran (mis. Gelombang 1: Januari&ndash;Maret, Gelombang 2: April&ndash;Juni).
                Pendaftar <b>otomatis</b> masuk ke gelombang yang rentang tanggalnya mencakup tanggal pendaftarannya.
                Gelombang dipakai untuk pengelompokan dan <b>Laporan Penerimaan</b>; perhitungan SAW tidak berubah.
            </p>

            <?php if (isset($pesan_map[$pesan])): ?>
                <div class="alert alert-<?= $pesan_map[$pesan][0]; ?>"><?= $pesan_map[$pesan][1]; ?></div>
            <?php endif; ?>

            <div class="alert alert-<?= $gelombang_aktif ? 'success' : 'warning'; ?>">
                <i class="fa fa-info-circle"></i>
                <?php if ($gelombang_aktif): ?>
                    Gelombang yang sedang dibuka hari ini: <b><?= htmlspecialchars($gelombang_aktif['nama_gelombang']); ?></b>
                    (<?= date('d/m/Y', strtotime($gelombang_aktif['tanggal_mulai'])); ?> &ndash; <?= date('d/m/Y', strtotime($gelombang_aktif['tanggal_akhir'])); ?>).
                <?php else: ?>
                    Tidak ada gelombang yang sedang dibuka hari ini. Pendaftar baru akan tercatat <b>Tanpa Gelombang</b> sampai gelombang yang sesuai dibuat.
                <?php endif; ?>
            </div>

            <div class="row">
                <!-- Form Tambah / Edit -->
                <div class="col-md-4">
                    <div style="background:#f5f6fa; padding:15px; border-radius:6px;">
                        <h5 style="margin-top:0;"><?= $edit ? 'Edit Gelombang' : 'Tambah Gelombang'; ?></h5>
                        <form action="gelombang.php?aksi=simpan" method="POST">
                            <input type="hidden" name="id_gelombang" value="<?= $edit ? (int) $edit['id_gelombang'] : ''; ?>">
                            <div class="form-group">
                                <label>Nama Gelombang</label>
                                <input type="text" name="nama_gelombang" class="form-control" maxlength="50" required
                                       placeholder="Contoh: Gelombang 1"
                                       value="<?= $edit ? htmlspecialchars($edit['nama_gelombang']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" required
                                       value="<?= $edit ? htmlspecialchars($edit['tanggal_mulai']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control" required
                                       value="<?= $edit ? htmlspecialchars($edit['tanggal_akhir']) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label>Keterangan <small class="text-muted">(opsional)</small></label>
                                <input type="text" name="keterangan" class="form-control" maxlength="255"
                                       placeholder="Contoh: Potongan biaya pendaftaran 50%"
                                       value="<?= $edit ? htmlspecialchars($edit['keterangan'] ?? '') : ''; ?>">
                            </div>
                            <button type="submit" class="btn btn-orange"><i class="fa fa-save"></i> Simpan</button>
                            <?php if ($edit): ?>
                                <a href="gelombang.php" class="btn btn-default">Batal</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <!-- Daftar Gelombang -->
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead style="background:#f5f6fa;">
                                <tr>
                                    <th>Tahun</th>
                                    <th>Nama Gelombang</th>
                                    <th>Periode</th>
                                    <th class="text-center">Pendaftar</th>
                                    <th class="text-center" width="110">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($daftar_gelombang) > 0): foreach ($daftar_gelombang as $g): ?>
                                <tr>
                                    <td><?= htmlspecialchars($g['tahun']); ?></td>
                                    <td>
                                        <b><?= htmlspecialchars($g['nama_gelombang']); ?></b>
                                        <?php if (!empty($g['keterangan'])): ?>
                                            <br><small style="color:#888;"><?= htmlspecialchars($g['keterangan']); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($g['tanggal_mulai'])); ?> &ndash; <?= date('d/m/Y', strtotime($g['tanggal_akhir'])); ?></td>
                                    <td class="text-center"><?= (int) $g['jumlah_pendaftar']; ?></td>
                                    <td class="text-center">
                                        <a href="gelombang.php?edit=<?= (int) $g['id_gelombang']; ?>" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <form action="gelombang.php?aksi=hapus" method="POST" style="display:inline;"
                                              onsubmit="return confirm('Hapus gelombang ini? Pendaftar di rentang tanggalnya akan menjadi Tanpa Gelombang.');">
                                            <input type="hidden" name="id_gelombang" value="<?= (int) $g['id_gelombang']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center" style="padding:20px;">Belum ada gelombang pendaftaran.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/template/footer.php'; ?>
