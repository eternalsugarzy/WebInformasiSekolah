<?php
require_once __DIR__ . '/template/header.php';
require_once __DIR__ . '/template/sidebar.php';

$pesan_map = [
    'tersimpan'       => ['success', 'Data prestasi berhasil ditambahkan.'],
    'diperbarui'      => ['success', 'Data prestasi berhasil diperbarui.'],
    'diverifikasi'    => ['success', 'Status verifikasi berhasil diperbarui.'],
    'terhapus'        => ['success', 'Data prestasi berhasil dihapus.'],
    'tidak_ditemukan' => ['warning', 'Data prestasi tidak ditemukan.'],
    'gagal'           => ['danger', 'Terjadi kegagalan, silakan coba lagi.'],
];
$badge_status = ['Menunggu' => 'warning', 'Terverifikasi' => 'success', 'Ditolak' => 'danger'];
$url_kembali = 'prestasi.php' . (count(array_filter($filters)) ? '?' . http_build_query(array_filter($filters)) : '');
?>

<div class="main-content">
    <?php require_once __DIR__ . '/template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-8">
                    <h4 style="margin-bottom:5px;"><i class="fa fa-trophy"></i> Kelola Prestasi Siswa</h4>
                    <p style="color:#888;">Pencatatan prestasi akademik &amp; non-akademik siswa (peserta didik yang sudah diterima dan melakukan daftar ulang).
                        Prestasi baru tampil di halaman publik dan laporan resmi setelah sertifikatnya <b>diverifikasi</b>.</p>
                </div>
                <div class="col-md-4 text-right">
                    <a href="prestasi.php?aksi=tambah" class="btn btn-orange"><i class="fa fa-plus"></i> Tambah Prestasi</a>
                </div>
            </div>

            <?php if (isset($pesan_map[$pesan])): ?>
                <div class="alert alert-<?= $pesan_map[$pesan][0]; ?>"><?= $pesan_map[$pesan][1]; ?></div>
            <?php endif; ?>

            <!-- Ringkasan per tingkat -->
            <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:15px;">
                <div style="background:#1c1e2f; color:#fff; padding:10px 15px; border-radius:6px; min-width:120px;">
                    <div style="font-size:22px; font-weight:700;"><?= $ringkasan['total']; ?></div>
                    <div style="font-size:12px;">Total Prestasi (<?= $ringkasan['jumlah_siswa']; ?> siswa)</div>
                </div>
                <?php foreach ($ringkasan['per_tingkat'] as $tk => $n): ?>
                <div style="background:#f5f6fa; padding:10px 15px; border-radius:6px; min-width:110px;">
                    <div style="font-size:20px; font-weight:700; color:#FF6700;"><?= $n; ?></div>
                    <div style="font-size:12px; color:#555;"><?= htmlspecialchars($tk); ?></div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Filter -->
            <form action="prestasi.php" method="GET" style="display:flex; flex-wrap:wrap; gap:8px; align-items:flex-end; margin-bottom:15px;">
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Cari</label>
                    <input type="text" name="q" class="form-control" placeholder="Nama siswa / prestasi / NISN" value="<?= htmlspecialchars($filters['q']); ?>">
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Tahun</label>
                    <select name="tahun" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach ($daftar_tahun as $th): ?>
                            <option value="<?= (int) $th; ?>" <?= ($filters['tahun'] == $th) ? 'selected' : ''; ?>><?= (int) $th; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Jenis</label>
                    <select name="jenis" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach (PrestasiModel::JENIS as $v): ?>
                            <option value="<?= $v; ?>" <?= ($filters['jenis'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Tingkat</label>
                    <select name="tingkat" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach (PrestasiModel::TINGKAT as $v): ?>
                            <option value="<?= $v; ?>" <?= ($filters['tingkat'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Kelas</label>
                    <select name="kelas" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach (PrestasiModel::KELAS as $v): ?>
                            <option value="<?= $v; ?>" <?= ($filters['kelas'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:12px; font-weight:600;">Status Verifikasi</label>
                    <select name="status" class="form-control">
                        <option value="">Semua</option>
                        <?php foreach (PrestasiModel::STATUS as $v): ?>
                            <option value="<?= $v; ?>" <?= ($filters['status'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-orange"><i class="fa fa-filter"></i> Terapkan</button>
                    <a href="prestasi.php" class="btn btn-default">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead style="background:#f5f6fa;">
                        <tr>
                            <th width="4%">No</th>
                            <th>Siswa</th>
                            <th>Prestasi</th>
                            <th>Jenis / Tingkat</th>
                            <th>Tahun</th>
                            <th>Sertifikat</th>
                            <th>Verifikasi</th>
                            <th width="190" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; if (count($data_prestasi) > 0): foreach ($data_prestasi as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <b><?= htmlspecialchars($p['nama_lengkap']); ?></b><br>
                                <small style="color:#888;">NISN <?= htmlspecialchars($p['nisn']); ?> &middot; Kelas <?= htmlspecialchars($p['kelas']); ?></small>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['nama_prestasi']); ?><br>
                                <small style="color:#888;"><b><?= htmlspecialchars($p['peringkat']); ?></b> &middot; <?= htmlspecialchars($p['penyelenggara']); ?></small>
                            </td>
                            <td><?= htmlspecialchars($p['jenis']); ?><br><small><b><?= htmlspecialchars($p['tingkat']); ?></b></small></td>
                            <td><?= htmlspecialchars($p['tahun']); ?></td>
                            <td>
                                <?php if (!empty($p['bukti_sertifikat'])): ?>
                                    <a href="uploads/prestasi/<?= rawurlencode($p['bukti_sertifikat']); ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-file"></i> Lihat</a>
                                <?php else: ?>
                                    <small style="color:#c0392b;">Belum ada</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="label label-<?= $badge_status[$p['status_verifikasi']] ?? 'default'; ?>" style="padding:4px 8px;"><?= htmlspecialchars($p['status_verifikasi']); ?></span>
                                <?php if (!empty($p['catatan_verifikasi'])): ?>
                                    <br><small style="color:#888;"><?= htmlspecialchars($p['catatan_verifikasi']); ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-center" style="white-space:nowrap;">
                                <?php if ($p['status_verifikasi'] !== 'Terverifikasi'): ?>
                                <form action="prestasi.php?aksi=verifikasi" method="POST" style="display:inline;">
                                    <input type="hidden" name="id_prestasi" value="<?= (int) $p['id_prestasi']; ?>">
                                    <input type="hidden" name="status_verifikasi" value="Terverifikasi">
                                    <input type="hidden" name="kembali" value="<?= htmlspecialchars($url_kembali); ?>">
                                    <button type="submit" class="btn btn-sm btn-success" title="Verifikasi"
                                        <?= empty($p['bukti_sertifikat']) ? 'onclick="return confirm(\'Prestasi ini belum memiliki sertifikat. Tetap verifikasi?\');"' : ''; ?>><i class="fa fa-check"></i></button>
                                </form>
                                <?php endif; ?>
                                <?php if ($p['status_verifikasi'] !== 'Ditolak'): ?>
                                <form action="prestasi.php?aksi=verifikasi" method="POST" style="display:inline;"
                                      onsubmit="var c = prompt('Alasan penolakan (mis. sertifikat tidak terbaca):', ''); if (c === null) return false; this.catatan_verifikasi.value = c; return true;">
                                    <input type="hidden" name="id_prestasi" value="<?= (int) $p['id_prestasi']; ?>">
                                    <input type="hidden" name="status_verifikasi" value="Ditolak">
                                    <input type="hidden" name="catatan_verifikasi" value="">
                                    <input type="hidden" name="kembali" value="<?= htmlspecialchars($url_kembali); ?>">
                                    <button type="submit" class="btn btn-sm btn-warning" title="Tolak"><i class="fa fa-ban"></i></button>
                                </form>
                                <?php endif; ?>
                                <a href="prestasi.php?aksi=edit&id=<?= (int) $p['id_prestasi']; ?>" class="btn btn-sm btn-default" title="Edit"><i class="fa fa-pencil"></i></a>
                                <form action="prestasi.php?aksi=hapus" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data prestasi ini beserta sertifikatnya?');">
                                    <input type="hidden" name="id_prestasi" value="<?= (int) $p['id_prestasi']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="8" class="text-center" style="padding:20px;">Belum ada data prestasi untuk filter ini.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/template/footer.php'; ?>
