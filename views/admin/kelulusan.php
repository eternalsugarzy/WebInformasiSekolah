<div class="card-box">
    <h4 style="margin-bottom: 5px;"><i class="fa fa-cogs"></i> Pengaturan Kuota Kelulusan per Jalur Seleksi</h4>
    <p style="color:#888; margin-bottom: 20px;">
        Kuota diatur terpisah untuk setiap jalur. Saat <b>Proses Seleksi SAW</b> dijalankan, pendaftar diurutkan
        berdasarkan nilai akhir SAW <b>di dalam jalurnya masing-masing</b>: peringkat jalur 1 s/d kuota Diterima
        dinyatakan <b>Diterima</b>, peringkat berikutnya sebanyak kuota Cadangan menjadi <b>Cadangan</b>, sisanya <b>Ditolak</b>.
    </p>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
        <div class="alert alert-success">
            <i class="fa fa-check"></i> Pengaturan kuota berhasil diperbarui! Jalankan ulang <b>Proses Seleksi SAW</b> agar status kelulusan mengikuti kuota baru.
        </div>
    <?php endif; ?>

    <form action="kelulusan.php?aksi=simpan" method="POST">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jalur Seleksi</th>
                        <th width="25%">Kuota Diterima</th>
                        <th width="25%">Kuota Cadangan</th>
                        <th width="15%" class="text-center">Total Kursi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_d = 0; $total_c = 0;
                    foreach ($jalur_list as $jalur):
                        $d = $kuota_jalur[$jalur]['kuota_diterima'];
                        $c = $kuota_jalur[$jalur]['kuota_cadangan'];
                        $total_d += $d; $total_c += $c;
                    ?>
                    <tr>
                        <td style="vertical-align:middle; font-weight:600;"><?= htmlspecialchars($jalur); ?></td>
                        <td>
                            <input type="number" name="kuota[<?= htmlspecialchars($jalur); ?>][diterima]" class="form-control kuota-input"
                                   value="<?= $d; ?>" min="0" required>
                        </td>
                        <td>
                            <input type="number" name="kuota[<?= htmlspecialchars($jalur); ?>][cadangan]" class="form-control kuota-input"
                                   value="<?= $c; ?>" min="0" required>
                        </td>
                        <td class="text-center" style="vertical-align:middle;"><?= $d + $c; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="background:#f5f6fa; font-weight:bold;">
                        <td>TOTAL SELURUH JALUR</td>
                        <td><?= $total_d; ?></td>
                        <td><?= $total_c; ?></td>
                        <td class="text-center"><?= $total_d + $total_c; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row" style="margin-top: 15px;">
            <div class="col-md-12 text-right">
                <button type="submit" name="simpan" class="btn btn-orange">
                    <i class="fa fa-save"></i> Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>
</div>
