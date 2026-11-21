<div class="card-box">
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-6"><h4>Proses Seleksi & Kelulusan SAW</h4></div>
        <div class="col-md-6 text-right">
            <a href="proses_saw.php?aksi=jalankan" class="btn btn-orange" onclick="return confirm('Jalankan perhitungan SAW & Update Status?')">
                <i class="fa fa-refresh"></i> PROSES SELEKSI & STATUS
            </a>
        </div>
    </div>

    <div class="alert alert-info" style="margin-bottom: 15px;">
        <strong>Cara Kerja SAW:</strong> Setiap kriteria penilaian diberi bobot lalu nilainya dinormalisasi (dibandingkan dengan nilai tertinggi/terendah antar pendaftar). Nilai yang sudah dinormalisasi dikalikan bobotnya masing-masing, kemudian dijumlahkan menjadi <strong>Nilai Akhir (Vi)</strong>.
        Pendaftar kemudian diurutkan <strong>di dalam jalur seleksinya masing-masing</strong> (<strong>Rank di Jalur</strong>), dan status kelulusan ditentukan dari rank tersebut sesuai kuota jalur yang diatur di menu <a href="kelulusan.php">Kuota Kelulusan</a>.
        <strong>Rank Umum</strong> hanya sebagai informasi urutan nilai akhir seluruh pendaftar.
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Rank Umum</th>
                    <th>Rank di Jalur</th>
                    <th>Nama Pendaftar</th>
                    <th>Jalur Seleksi</th>
                    <th>Nilai Akhir (Vi)</th>
                    <th>Status Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_pendaftar as $p) : ?>
                <tr>
                    <td><?= $p['peringkat'] ? '#'.$p['peringkat'] : '-'; ?></td>
                    <td><b><?= $p['peringkat_jalur'] ? '#'.$p['peringkat_jalur'] : '-'; ?></b></td>
                    <td style="font-weight: 600;"><?= htmlspecialchars($p['nama_lengkap']); ?></td>
                    <td><span class="label label-default"><?= htmlspecialchars($p['jalur_seleksi']); ?></span></td>
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