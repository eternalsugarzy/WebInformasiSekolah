<div class="card-box">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-6"><h4>Proses Seleksi & Kelulusan SAW</h4></div>
        <div class="col-md-6 text-right">
            <a href="proses_saw.php?aksi=jalankan" class="btn btn-orange" onclick="return confirm('Jalankan perhitungan SAW & Update Status?')">
                <i class="fa fa-refresh"></i> PROSES SELEKSI & STATUS
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Nama Pendaftar</th>
                    <th>Nilai Akhir (Vi)</th>
                    <th>Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_pendaftar as $p) : ?>
                <tr>
                    <td><?= $p['peringkat'] ? '#'.$p['peringkat'] : '-'; ?></td>
                    <td style="font-weight: 600;"><?= htmlspecialchars($p['nama_lengkap']); ?></td>
                    <td><?= ($p['nilai_akhir_saw'] != '') ? number_format($p['nilai_akhir_saw'], 4) : '-'; ?></td>
                    <td>
                        <?php 
                        // Logika Warna Status
                        $class = 'default';
                        if ($p['status_seleksi'] == 'Diterima') $class = 'success';
                        elseif ($p['status_seleksi'] == 'Cadangan') $class = 'warning';
                        elseif ($p['status_seleksi'] == 'Ditolak') $class = 'danger';
                        ?>
                        <span class="label label-<?= $class; ?>"><?= $p['status_seleksi'] ?? 'Menunggu'; ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>