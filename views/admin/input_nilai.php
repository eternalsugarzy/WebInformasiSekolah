<div class="card-box">
    <h4 style="margin-bottom: 20px;">Input Nilai Tes Masuk (Kriteria SAW)</h4>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == "sukses"): ?>
        <div class="alert alert-success">Nilai berhasil disimpan!</div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pendaftar</th>
                    <th>Raport (C1)</th>
                    <th>Tes (C2)</th>
                    <th>Prestasi (C3)</th>
                    <th>Jarak (C4)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($data_pendaftar as $p): ?>
                <form action="input_nilai.php?aksi=simpan" method="POST">
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($p['nama_lengkap']); ?></td>
                        <td>
                            <input type="hidden" name="id_pendaftar" value="<?= $p['id_pendaftar']; ?>">
                            <input type="number" name="nilai_raport" value="<?= $p['nilai_raport'] ?? 0; ?>" class="form-control" style="width: 80px;" required>
                        </td>
                        <td><input type="number" name="nilai_tes" value="<?= $p['nilai_tes'] ?? 0; ?>" class="form-control" style="width: 80px;" required></td>
                        <td><input type="number" name="nilai_prestasi" value="<?= $p['nilai_prestasi'] ?? 0; ?>" class="form-control" style="width: 80px;" required></td>
                        <td><input type="number" name="jarak_rumah" value="<?= $p['jarak_rumah'] ?? 0; ?>" class="form-control" style="width: 80px;" step="0.1" required></td>
                        <td>
                            <button type="submit" name="simpan_nilai" class="btn btn-sm btn-orange"><i class="fa fa-save"></i></button>
                        </td>
                    </tr>
                </form>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>