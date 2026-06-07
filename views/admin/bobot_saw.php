<div class="card-box">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-6">
            <h4>Pengaturan Bobot Kriteria SAW</h4>
        </div>
    </div>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "sukses"): ?>
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> Berhasil memperbarui bobot kriteria!
        </div>
    <?php elseif(isset($_GET['pesan']) && $_GET['pesan'] == "gagal"): ?>
        <div class="alert alert-danger">
            <i class="fa fa-times-circle"></i> Gagal memperbarui bobot.
        </div>
    <?php endif; ?>

    <form action="bobot_saw.php?aksi=update" method="POST">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th width="10%">Kode</th>
                        <th>Nama Kriteria</th>
                        <th width="15%">Tipe</th>
                        <th width="20%">Bobot (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_kriteria as $row) : ?>
                    <tr>
                        <td><b><?= htmlspecialchars($row['kode_kriteria']); ?></b></td>
                        <td><?= htmlspecialchars($row['nama_kriteria']); ?></td>
                        <td>
                            <?php if($row['tipe'] == 'Benefit'): ?>
                                <span class="label label-success">Benefit</span>
                            <?php else: ?>
                                <span class="label label-danger">Cost</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <input type="hidden" name="id_kriteria[]" value="<?= $row['id_kriteria']; ?>">
                            <input type="number" name="bobot[]" value="<?= htmlspecialchars($row['bobot']); ?>" class="form-control" required>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right" style="font-weight: 600; vertical-align: middle;">Total Bobot Saat Ini:</td>
                        <td style="font-weight: 600; vertical-align: middle;">
                            <?php if($total_bobot == 100): ?>
                                <span class="text-success"><?= $total_bobot; ?> %</span>
                            <?php else: ?>
                                <span class="text-danger"><?= $total_bobot; ?> % (Harus 100%)</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12 text-right">
                <button type="submit" name="update_bobot" class="btn btn-orange">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>