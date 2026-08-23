<div class="card-box">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-6">
            <h4>Notifikasi Email Hasil Kelulusan</h4>
        </div>
        <div class="col-md-6 text-right">
            <a href="notifikasi_email.php?aksi=kirim_semua" class="btn btn-orange" onclick="return confirm('Kirim/kirim ulang email notifikasi ke semua pendaftar berstatus final?')">
                <i class="fa fa-paper-plane"></i> Kirim Semua Notifikasi
            </a>
        </div>
    </div>

    <p class="text-muted">
        Email dikirim ke alamat <b>email_siswa</b> yang diisi pendaftar di formulir pendaftaran PPDB.
        Notifikasi otomatis terkirim setiap kali admin menjalankan <b>Proses Seleksi SAW</b>; hanya pendaftar
        yang statusnya berubah atau belum pernah dinotifikasi yang dikirimi ulang. Gunakan tombol
        <i>Kirim Ulang</i> di tabel untuk mengirim ulang satu per satu secara manual.
    </p>

    <?php if($pesan == "sukses"): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Email berhasil dikirim.</div>
    <?php elseif($pesan == "gagal"): ?>
        <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Gagal mengirim email. Lihat kolom Status Email untuk detail, atau cek konfigurasi SMTP di <code>Koneksi Database/mail_config.php</code>.</div>
    <?php elseif($pesan == "massal"): ?>
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> Selesai: <b><?= $ringkasan_terkirim; ?></b> terkirim, <b><?= $ringkasan_gagal; ?></b> gagal, <b><?= $ringkasan_dilewati; ?></b> dilewati (sudah terkirim sebelumnya).
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pendaftar</th>
                    <th>Email Tujuan</th>
                    <th>Jalur</th>
                    <th>Status Kelulusan</th>
                    <th>Status Email</th>
                    <th>Terakhir Terkirim</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; if (count($data_notifikasi) > 0) { foreach ($data_notifikasi as $d): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td style="font-weight: 600;"><?= htmlspecialchars($d['nama_lengkap']); ?></td>
                    <td><?= htmlspecialchars($d['email_siswa']); ?></td>
                    <td><?= htmlspecialchars($d['jalur_seleksi']); ?></td>
                    <td>
                        <?php
                        $class = 'default';
                        if ($d['status_seleksi'] == 'Diterima') $class = 'success';
                        elseif ($d['status_seleksi'] == 'Cadangan') $class = 'warning';
                        elseif ($d['status_seleksi'] == 'Ditolak') $class = 'danger';
                        ?>
                        <span class="label label-<?= $class; ?>"><?= $d['status_seleksi']; ?></span>
                    </td>
                    <td>
                        <?php
                        $eclass = 'default';
                        if ($d['status_email_notifikasi'] == 'Terkirim') $eclass = 'success';
                        elseif ($d['status_email_notifikasi'] == 'Gagal') $eclass = 'danger';
                        $sudahBerubah = $d['status_email_notifikasi'] == 'Terkirim' && $d['status_seleksi_saat_email'] !== $d['status_seleksi'];
                        ?>
                        <span class="label label-<?= $eclass; ?>"><?= $d['status_email_notifikasi']; ?></span>
                        <?php if ($sudahBerubah): ?>
                            <br><small class="text-warning">Status berubah sejak dikirim</small>
                        <?php endif; ?>
                    </td>
                    <td><?= $d['email_terkirim_at'] ? htmlspecialchars($d['email_terkirim_at']) : '-'; ?></td>
                    <td>
                        <a href="notifikasi_email.php?aksi=kirim&id=<?= $d['id_pendaftar']; ?>" class="btn btn-sm btn-orange" onclick="return confirm('Kirim ulang email ke <?= htmlspecialchars($d['nama_lengkap']); ?>?')">
                            <i class="fa fa-paper-plane"></i> Kirim Ulang
                        </a>
                    </td>
                </tr>
                <?php endforeach; } else { echo "<tr><td colspan='8' style='padding:20px;'>Belum ada pendaftar berstatus final (Diterima/Cadangan/Ditolak).</td></tr>"; } ?>
            </tbody>
        </table>
    </div>
</div>