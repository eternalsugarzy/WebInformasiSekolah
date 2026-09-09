<div class="card-box">
    <h4 style="margin-bottom: 5px;"><i class="fa fa-user-plus"></i> Daftar Ulang</h4>
    <p style="color:#888; margin-bottom: 20px;">
        Status <b>Diterima</b> dari hasil seleksi SAW baru berarti lolos seleksi, belum tentu benar-benar akan bersekolah di sini.
        Gunakan halaman ini untuk mencatat siapa yang benar-benar <b>daftar ulang</b> dan siapa yang <b>mengundurkan diri</b> --
        supaya kursi yang kosong bisa diisi dari daftar Cadangan berikutnya.
    </p>

    <?php if ($pesan == 'sukses'): ?>
        <div class="alert alert-success"><i class="fa fa-check"></i> Status daftar ulang berhasil diperbarui.</div>
    <?php elseif ($pesan == 'sukses_promosi'): ?>
        <div class="alert alert-success"><i class="fa fa-check"></i> Kandidat Cadangan berhasil dipromosikan menjadi Diterima.</div>
    <?php elseif ($pesan == 'gagal' || $pesan == 'gagal_promosi'): ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Terjadi kegagalan, silakan coba lagi.</div>
    <?php endif; ?>

    <!-- Ringkasan: hasil seleksi vs realisasi penerimaan -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card card-blue">
                <div class="stat-content">
                    <h3><?php echo $ringkasan['Total Diterima']; ?></h3>
                    <p>Total Diterima (Seleksi)</p>
                </div>
                <div class="stat-icon"><i class="fa fa-user-plus"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card-green">
                <div class="stat-content">
                    <h3><?php echo $ringkasan['Daftar Ulang']; ?></h3>
                    <p>Sudah Daftar Ulang</p>
                </div>
                <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card-red">
                <div class="stat-content">
                    <h3><?php echo $ringkasan['Mengundurkan Diri']; ?></h3>
                    <p>Mengundurkan Diri</p>
                </div>
                <div class="stat-icon"><i class="fa fa-times-circle"></i></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card card-yellow">
                <div class="stat-content">
                    <h3><?php echo $ringkasan['Belum Konfirmasi']; ?></h3>
                    <p>Belum Konfirmasi</p>
                </div>
                <div class="stat-icon"><i class="fa fa-clock-o"></i></div>
            </div>
        </div>
    </div>

    <!-- Panel Promosi Cadangan -->
    <div class="alert alert-info" style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
        <div>
            <i class="fa fa-info-circle"></i>
            Cadangan menunggu: <b><?php echo $ringkasan['Cadangan Menunggu']; ?></b> orang.
            <?php if ($cadangan_terbaik): ?>
                Kandidat berikutnya (peringkat SAW terbaik):
                <b><?php echo htmlspecialchars($cadangan_terbaik['nama_lengkap']); ?></b>
                (Peringkat #<?php echo $cadangan_terbaik['peringkat']; ?>, Jalur <?php echo htmlspecialchars($cadangan_terbaik['jalur_seleksi']); ?>).
                Promosikan hanya jika memang ada kursi Diterima yang kosong (lihat angka "Mengundurkan Diri" di atas).
            <?php else: ?>
                Tidak ada lagi kandidat Cadangan yang bisa dipromosikan.
            <?php endif; ?>
        </div>
        <?php if ($cadangan_terbaik): ?>
        <form action="daftar_ulang.php?aksi=promosi" method="POST" onsubmit="return confirm('Promosikan <?php echo htmlspecialchars($cadangan_terbaik['nama_lengkap']); ?> dari Cadangan menjadi Diterima?');">
            <input type="hidden" name="id_pendaftar" value="<?php echo $cadangan_terbaik['id_pendaftar']; ?>">
            <button type="submit" class="btn btn-orange"><i class="fa fa-arrow-up"></i> Promosikan ke Diterima</button>
        </form>
        <?php endif; ?>
    </div>

    <!-- Filter -->
    <form action="daftar_ulang.php" method="GET" class="row" style="margin: 15px 0; align-items:flex-end;">
        <div class="col-md-3">
            <label style="font-size:12px; font-weight:600;">Status Daftar Ulang</label>
            <select name="status_daftar_ulang" class="form-control">
                <option value="">-- Semua Status --</option>
                <option value="Belum Konfirmasi" <?php echo (($_GET['status_daftar_ulang'] ?? '') === 'Belum Konfirmasi') ? 'selected' : ''; ?>>Belum Konfirmasi</option>
                <option value="Daftar Ulang" <?php echo (($_GET['status_daftar_ulang'] ?? '') === 'Daftar Ulang') ? 'selected' : ''; ?>>Daftar Ulang</option>
                <option value="Mengundurkan Diri" <?php echo (($_GET['status_daftar_ulang'] ?? '') === 'Mengundurkan Diri') ? 'selected' : ''; ?>>Mengundurkan Diri</option>
            </select>
        </div>
        <div class="col-md-3">
            <label style="font-size:12px; font-weight:600;">Jalur Seleksi</label>
            <select name="jalur" class="form-control">
                <option value="">-- Semua Jalur --</option>
                <option value="Zonasi" <?php echo (($_GET['jalur'] ?? '') === 'Zonasi') ? 'selected' : ''; ?>>Zonasi</option>
                <option value="Prestasi" <?php echo (($_GET['jalur'] ?? '') === 'Prestasi') ? 'selected' : ''; ?>>Prestasi</option>
                <option value="Afirmasi" <?php echo (($_GET['jalur'] ?? '') === 'Afirmasi') ? 'selected' : ''; ?>>Afirmasi</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-orange"><i class="fa fa-filter"></i> Terapkan</button>
        </div>
    </form>

    <!-- Tabel Pendaftar Diterima -->
    <div style="overflow-x:auto;">
    <table class="table table-bordered" style="background:#fff;">
        <thead style="background:#f5f6fa;">
            <tr>
                <th>No</th>
                <th>Nama / NISN</th>
                <th>Jalur</th>
                <th>Peringkat SAW</th>
                <th>Status Daftar Ulang</th>
                <th>Tgl Konfirmasi</th>
                <th style="min-width: 260px;">Ubah Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; if (count($daftar) > 0) { foreach ($daftar as $d):
                $badge = 'warning'; $bg = '#f0ad4e';
                if ($d['status_daftar_ulang'] === 'Daftar Ulang') { $badge = 'success'; $bg = '#5cb85c'; }
                if ($d['status_daftar_ulang'] === 'Mengundurkan Diri') { $badge = 'danger'; $bg = '#d9534f'; }
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($d['nama_lengkap']); ?><br><small style="color:#888;"><?php echo htmlspecialchars($d['nisn']); ?></small></td>
                <td><?php echo htmlspecialchars($d['jalur_seleksi']); ?></td>
                <td>#<?php echo $d['peringkat'] ?? '-'; ?></td>
                <td>
                    <span class="label label-<?php echo $badge; ?>" style="padding:5px 10px; border-radius:4px; color:#fff; background-color:<?php echo $bg; ?>;">
                        <?php echo htmlspecialchars($d['status_daftar_ulang']); ?>
                    </span>
                    <?php if (!empty($d['catatan_daftar_ulang'])): ?>
                        <br><small style="color:#888;"><?php echo htmlspecialchars($d['catatan_daftar_ulang']); ?></small>
                    <?php endif; ?>
                </td>
                <td><?php echo $d['tanggal_daftar_ulang'] ? date('d/m/Y H:i', strtotime($d['tanggal_daftar_ulang'])) : '-'; ?></td>
                <td>
                    <form action="daftar_ulang.php?aksi=update" method="POST" style="display:flex; gap:5px; flex-wrap:wrap;">
                        <input type="hidden" name="id_pendaftar" value="<?php echo $d['id_pendaftar']; ?>">
                        <select name="status_daftar_ulang" class="form-control" style="width:auto; font-size:12px;">
                            <option value="Belum Konfirmasi" <?php echo ($d['status_daftar_ulang'] === 'Belum Konfirmasi') ? 'selected' : ''; ?>>Belum Konfirmasi</option>
                            <option value="Daftar Ulang" <?php echo ($d['status_daftar_ulang'] === 'Daftar Ulang') ? 'selected' : ''; ?>>Daftar Ulang</option>
                            <option value="Mengundurkan Diri" <?php echo ($d['status_daftar_ulang'] === 'Mengundurkan Diri') ? 'selected' : ''; ?>>Mengundurkan Diri</option>
                        </select>
                        <input type="text" name="catatan_daftar_ulang" class="form-control" placeholder="Catatan (opsional)" style="width:140px; font-size:12px;" value="<?php echo htmlspecialchars($d['catatan_daftar_ulang'] ?? ''); ?>">
                        <button type="submit" class="btn btn-orange btn-sm"><i class="fa fa-save"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; } else { echo '<tr><td colspan="7" style="padding:20px; text-align:center;">Belum ada pendaftar berstatus Diterima untuk filter ini.</td></tr>'; } ?>
        </tbody>
    </table>
    </div>
</div>
