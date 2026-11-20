<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
require_once '../models/GelombangModel.php';

$ppdbModel = new PPDBModel();
$gelombangModel = new GelombangModel();

$jalur_valid = ['Zonasi', 'Prestasi', 'Afirmasi'];
$filters = [
    'tahun'     => (isset($_GET['tahun']) && $_GET['tahun'] !== '') ? intval($_GET['tahun']) : '',
    'jalur'     => (isset($_GET['jalur']) && in_array($_GET['jalur'], $jalur_valid, true)) ? $_GET['jalur'] : '',
    'gelombang' => (isset($_GET['gelombang']) && $_GET['gelombang'] !== '')
                    ? ($_GET['gelombang'] === 'tanpa' ? 'tanpa' : (string) intval($_GET['gelombang'])) : '',
];

$lap = $ppdbModel->getLaporanPenerimaan($filters);
$daftar_tahun = $ppdbModel->getTahunPendaftaran();
$daftar_gelombang = $gelombangModel->getByTahun($filters['tahun'] ?: null);

// Label filter aktif (untuk judul cetak)
$label_gelombang = '';
if ($filters['gelombang'] === 'tanpa') {
    $label_gelombang = 'Tanpa Gelombang';
} elseif ($filters['gelombang'] !== '') {
    $g = $gelombangModel->getById($filters['gelombang']);
    $label_gelombang = $g ? $g['nama_gelombang'] . ' ' . date('Y', strtotime($g['tanggal_mulai'])) : '';
}
$ket = [];
$ket[] = $filters['tahun'] ? 'Tahun Ajaran ' . $filters['tahun'] . '/' . ($filters['tahun'] + 1) : 'Semua Tahun';
if ($filters['jalur']) $ket[] = 'Jalur ' . $filters['jalur'];
if ($label_gelombang) $ket[] = $label_gelombang;
$teks_filter = implode(' | ', $ket);

function tgl_indo($tanggal){
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $p = explode('-', $tanggal);
    return $p[2] . ' ' . $bulan[(int) $p[1]] . ' ' . $p[0];
}

// Baris tabel sebaran (dipakai untuk JK, asal sekolah, kecamatan)
function baris_sebaran($rows) {
    if (count($rows) === 0) {
        echo '<tr><td colspan="7" class="text-center">Tidak ada data.</td></tr>';
        return;
    }
    $no = 1;
    foreach ($rows as $r) {
        echo '<tr>';
        echo '<td class="text-center">' . $no++ . '</td>';
        echo '<td>' . htmlspecialchars($r['label']) . '</td>';
        echo '<td class="text-center">' . $r['pendaftar'] . '</td>';
        echo '<td class="text-center">' . $r['diterima'] . '</td>';
        echo '<td class="text-center">' . $r['cadangan'] . '</td>';
        echo '<td class="text-center">' . $r['ditolak'] . '</td>';
        echo '<td class="text-center">' . $r['persen_diterima'] . '%</td>';
        echo '</tr>';
    }
}

$title = "Laporan Penerimaan Peserta Didik Baru";
$nama_admin = $_SESSION['admin_nama'] ?? '';
$rk = $lap['ringkasan'];

require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <style>
        .print-only { display: none; }
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 15px; text-align: center; position: relative; }
        .kop-surat img { height: 80px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 20px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 14px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 12px; font-style: italic; }
        .tabel-lap th { background: #f5f6fa; text-align: center; vertical-align: middle !important; }
        .tabel-lap td { vertical-align: middle !important; }
        .tabel-lap tr.total td { background: #f5f6fa; font-weight: bold; }
        .judul-seksi { margin-top: 25px; font-weight: 700; }
        .kuota-ok { color: #2e7d32; font-weight: 600; }
        .kuota-sisa { color: #e67e22; font-weight: 600; }
        .kuota-lebih { color: #c0392b; font-weight: 600; }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            .admin-sidebar, .toggle-sidebar-btn, .admin-header, .topbar { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .content-wrapper { padding: 0 !important; }
            .card-box { box-shadow: none !important; padding: 0 !important; }
            body { background: #fff !important; font-size: 11pt; }
            @page { size: A4 portrait; margin: 1.5cm; }
            canvas { max-width: 100% !important; }
            .row, table { page-break-inside: avoid; }
            .stat-card { border: 1px solid #999; }
        }
    </style>

    <div class="content-wrapper">
        <div class="card-box">

            <!-- Kop Surat (hanya tampil saat dicetak) -->
            <div class="print-only kop-surat">
                <img src="../img/logo.png" onerror="this.style.display='none'">
                <h2>SMA FRATER DON BOSCO</h2>
                <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</h4>
                <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
            </div>
            <div class="print-only" style="text-align:center; margin-bottom:20px;">
                <div style="font-weight:bold; text-decoration:underline; text-transform:uppercase;">Laporan Rekapitulasi Penerimaan Peserta Didik Baru</div>
                <div style="font-size:12px;"><?= htmlspecialchars($teks_filter); ?></div>
            </div>

            <div class="no-print">
                <h4><i class="fa fa-pie-chart"></i> Laporan Penerimaan Peserta Didik Baru</h4>
                <p style="color:#888;">
                    Rekapitulasi total penerimaan: jumlah pendaftar dibanding yang diterima dan tidak diterima, persentase penerimaan
                    per jalur dan per gelombang, sebaran pendaftar, serta pemenuhan kuota tiap jalur.
                    Untuk rincian status per jalur saja, lihat <i>Laporan Rekap Jalur Seleksi</i>.
                </p>

                <form action="laporan_penerimaan.php" method="GET" style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-end; margin-bottom:20px;">
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600;">Tahun Ajaran</label>
                        <select name="tahun" class="form-control" onchange="this.form.gelombang.value=''; this.form.submit();">
                            <option value="">-- Semua Tahun --</option>
                            <?php foreach ($daftar_tahun as $th): ?>
                                <option value="<?= (int) $th; ?>" <?= ($filters['tahun'] == $th) ? 'selected' : ''; ?>><?= (int) $th; ?>/<?= (int) $th + 1; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600;">Jalur Seleksi</label>
                        <select name="jalur" class="form-control">
                            <option value="">-- Semua Jalur --</option>
                            <?php foreach ($jalur_valid as $j): ?>
                                <option value="<?= $j; ?>" <?= ($filters['jalur'] === $j) ? 'selected' : ''; ?>><?= $j; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600;">Gelombang</label>
                        <select name="gelombang" class="form-control">
                            <option value="">-- Semua Gelombang --</option>
                            <?php foreach ($daftar_gelombang as $g): ?>
                                <option value="<?= (int) $g['id_gelombang']; ?>" <?= ($filters['gelombang'] === (string) $g['id_gelombang']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($g['nama_gelombang'] . ' ' . $g['tahun']); ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="tanpa" <?= ($filters['gelombang'] === 'tanpa') ? 'selected' : ''; ?>>Tanpa Gelombang</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-orange"><i class="fa fa-filter"></i> Terapkan</button>
                        <a href="laporan_penerimaan.php" class="btn btn-default">Reset</a>
                        <button type="button" class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Cetak / PDF</button>
                        <a href="cetak_penerimaan_excel.php?<?= htmlspecialchars(http_build_query($filters)); ?>" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Ekspor Excel</a>
                    </div>
                </form>
                <p style="font-size:12px; color:#888;">Filter aktif: <b><?= htmlspecialchars($teks_filter); ?></b></p>
            </div>

            <?php if ($rk['pendaftar'] == 0): ?>
                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Tidak ada data pendaftar untuk filter ini.</div>
            <?php else: ?>

            <!-- 1. Ringkasan -->
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card card-blue"><div class="stat-content"><h3><?= $rk['pendaftar']; ?></h3><p>Total Pendaftar</p></div><div class="stat-icon"><i class="fa fa-users"></i></div></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card card-green"><div class="stat-content"><h3><?= $rk['diterima']; ?></h3><p>Diterima</p></div><div class="stat-icon"><i class="fa fa-check-circle"></i></div></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card card-red"><div class="stat-content"><h3><?= $rk['ditolak']; ?></h3><p>Tidak Diterima</p></div><div class="stat-icon"><i class="fa fa-times-circle"></i></div></div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card card-orange"><div class="stat-content"><h3><?= $rk['persen_diterima']; ?>%</h3><p>Persentase Penerimaan</p></div><div class="stat-icon"><i class="fa fa-percent"></i></div></div>
                </div>
            </div>
            <p style="font-size:13px; color:#555;">
                Cadangan: <b><?= $rk['cadangan']; ?></b> &middot; Masih menunggu seleksi: <b><?= $rk['menunggu']; ?></b>
                &middot; Sudah daftar ulang: <b><?= $rk['daftar_ulang']; ?></b> dari <?= $rk['diterima']; ?> yang diterima.
                <br><small><i>Persentase penerimaan = jumlah diterima &divide; jumlah pendaftar &times; 100%.</i></small>
            </p>

            <!-- 2. Per Jalur + Kuota -->
            <h5 class="judul-seksi">A. Rekapitulasi Penerimaan per Jalur Seleksi &amp; Pemenuhan Kuota</h5>
            <div class="table-responsive">
                <table class="table table-bordered tabel-lap">
                    <thead>
                        <tr>
                            <th rowspan="2">Jalur</th>
                            <th rowspan="2">Pendaftar</th>
                            <th rowspan="2">Diterima</th>
                            <th rowspan="2">Cadangan</th>
                            <th rowspan="2">Tidak Diterima</th>
                            <th rowspan="2">Menunggu</th>
                            <th rowspan="2">% Diterima</th>
                            <th colspan="3">Kuota Diterima</th>
                        </tr>
                        <tr>
                            <th>Kuota</th>
                            <th>Terisi</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tot = ['pendaftar' => 0, 'diterima' => 0, 'cadangan' => 0, 'ditolak' => 0, 'menunggu' => 0];
                        foreach ($lap['per_jalur'] as $jalur => $r):
                            foreach ($tot as $k => $v) $tot[$k] += $r[$k];
                            $cls = 'kuota-sisa';
                            if ($r['status_kuota'] === 'Terpenuhi') $cls = 'kuota-ok';
                            if ($r['status_kuota'] === 'Melebihi kuota') $cls = 'kuota-lebih';
                        ?>
                        <tr>
                            <td><b><?= htmlspecialchars($jalur); ?></b></td>
                            <td class="text-center"><?= $r['pendaftar']; ?></td>
                            <td class="text-center"><?= $r['diterima']; ?></td>
                            <td class="text-center"><?= $r['cadangan']; ?></td>
                            <td class="text-center"><?= $r['ditolak']; ?></td>
                            <td class="text-center"><?= $r['menunggu']; ?></td>
                            <td class="text-center"><?= $r['persen_diterima']; ?>%</td>
                            <td class="text-center"><?= $r['kuota_diterima']; ?></td>
                            <td class="text-center"><?= $r['kuota_terisi']; ?> (<?= $r['persen_kuota']; ?>%)</td>
                            <td class="text-center <?= $cls; ?>"><?= htmlspecialchars($r['status_kuota']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="total">
                            <td>TOTAL</td>
                            <td class="text-center"><?= $tot['pendaftar']; ?></td>
                            <td class="text-center"><?= $tot['diterima']; ?></td>
                            <td class="text-center"><?= $tot['cadangan']; ?></td>
                            <td class="text-center"><?= $tot['ditolak']; ?></td>
                            <td class="text-center"><?= $tot['menunggu']; ?></td>
                            <td class="text-center"><?= $tot['pendaftar'] > 0 ? round($tot['diterima'] / $tot['pendaftar'] * 100, 1) : 0; ?>%</td>
                            <td class="text-center"><?= $lap['total_kuota']['kuota_diterima']; ?></td>
                            <td class="text-center"><?= $lap['total_kuota']['terisi']; ?> (<?= $lap['total_kuota']['persen']; ?>%)</td>
                            <td class="text-center">Sisa <?= $lap['total_kuota']['sisa']; ?> kursi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p style="font-size:11px; color:#888;"><i>* Kolom kuota dihitung dari seluruh gelombang pada tahun terpilih, karena kuota berlaku untuk satu periode penerimaan (tidak dibagi per gelombang). Kuota diatur di menu Kuota Kelulusan.</i></p>

            <div class="row no-break">
                <div class="col-md-6">
                    <h5>Grafik Pendaftar vs Diterima per Jalur</h5>
                    <canvas id="chartJalur" height="230"></canvas>
                </div>
                <div class="col-md-6">
                    <h5>Grafik Pendaftar vs Diterima per Gelombang</h5>
                    <canvas id="chartGelombang" height="230"></canvas>
                </div>
            </div>

            <!-- 3. Per Gelombang -->
            <h5 class="judul-seksi">B. Rekapitulasi Penerimaan per Gelombang</h5>
            <div class="table-responsive">
                <table class="table table-bordered tabel-lap">
                    <thead>
                        <tr><th>Gelombang</th><th>Periode</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>Menunggu</th><th>% Diterima</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lap['per_gelombang'] as $r): ?>
                        <tr>
                            <td><b><?= htmlspecialchars($r['label']); ?></b></td>
                            <td class="text-center"><?= htmlspecialchars($r['periode']); ?></td>
                            <td class="text-center"><?= $r['pendaftar']; ?></td>
                            <td class="text-center"><?= $r['diterima']; ?></td>
                            <td class="text-center"><?= $r['cadangan']; ?></td>
                            <td class="text-center"><?= $r['ditolak']; ?></td>
                            <td class="text-center"><?= $r['menunggu']; ?></td>
                            <td class="text-center"><?= $r['persen_diterima']; ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- 4. Sebaran -->
            <h5 class="judul-seksi">C. Sebaran Pendaftar berdasarkan Jenis Kelamin</h5>
            <div class="table-responsive">
                <table class="table table-bordered tabel-lap">
                    <thead><tr><th width="5%">No</th><th>Jenis Kelamin</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>% Diterima</th></tr></thead>
                    <tbody><?php baris_sebaran($lap['sebaran_jk']); ?></tbody>
                </table>
            </div>

            <h5 class="judul-seksi">D. Sebaran Pendaftar berdasarkan Asal Sekolah</h5>
            <div class="table-responsive">
                <table class="table table-bordered tabel-lap">
                    <thead><tr><th width="5%">No</th><th>Asal Sekolah (SMP/MTs)</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>% Diterima</th></tr></thead>
                    <tbody><?php baris_sebaran($lap['sebaran_sekolah']); ?></tbody>
                </table>
            </div>

            <h5 class="judul-seksi">E. Sebaran Pendaftar berdasarkan Kecamatan Sekolah Asal</h5>
            <div class="table-responsive">
                <table class="table table-bordered tabel-lap">
                    <thead><tr><th width="5%">No</th><th>Kecamatan</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>% Diterima</th></tr></thead>
                    <tbody><?php baris_sebaran($lap['sebaran_kecamatan']); ?></tbody>
                </table>
            </div>

            <div class="print-only" style="margin-top: 40px; width: 100%;">
                <div style="float:right; text-align: center; width: 280px;">
                    <p>Banjarmasin, <?= tgl_indo(date('Y-m-d')); ?></p>
                    <p>Ketua Panitia PPDB,</p>
                    <br><br><br>
                    <p style="font-weight: bold; text-decoration: underline;">( .................................... )</p>
                </div>
            </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($rk['pendaftar'] > 0): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
(function () {
    var opsi = { responsive: true, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } };
    var warnaDaftar = '#374050', warnaTerima = '#FF6700';

    new Chart(document.getElementById('chartJalur'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_keys($lap['per_jalur'])); ?>,
            datasets: [
                { label: 'Pendaftar', data: <?= json_encode(array_values(array_column($lap['per_jalur'], 'pendaftar'))); ?>, backgroundColor: warnaDaftar },
                { label: 'Diterima', data: <?= json_encode(array_values(array_column($lap['per_jalur'], 'diterima'))); ?>, backgroundColor: warnaTerima },
                { label: 'Kuota Diterima', data: <?= json_encode(array_values(array_column($lap['per_jalur'], 'kuota_diterima'))); ?>, backgroundColor: 'rgba(46,125,50,0.35)', borderColor: '#2e7d32', borderWidth: 1 }
            ]
        },
        options: opsi
    });

    new Chart(document.getElementById('chartGelombang'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($lap['per_gelombang'], 'label')); ?>,
            datasets: [
                { label: 'Pendaftar', data: <?= json_encode(array_column($lap['per_gelombang'], 'pendaftar')); ?>, backgroundColor: warnaDaftar },
                { label: 'Diterima', data: <?= json_encode(array_column($lap['per_gelombang'], 'diterima')); ?>, backgroundColor: warnaTerima }
            ]
        },
        options: opsi
    });
})();
</script>
<?php endif; ?>

<?php require_once '../views/admin/template/footer.php'; ?>
