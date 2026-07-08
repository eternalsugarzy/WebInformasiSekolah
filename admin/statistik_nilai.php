<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/SawModel.php';
$sawModel = new SawModel();

$tahun_filter = (isset($_GET['tahun']) && $_GET['tahun'] !== '') ? intval($_GET['tahun']) : null;
$statistik = $sawModel->getStatistikNilai($tahun_filter);

// Helper Tanggal Indo (untuk footer cetak)
function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

$title = "Laporan Statistik Nilai Rata-Rata Pendaftar";
$nama_admin = $_SESSION['admin_nama'];

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

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            .admin-sidebar, .toggle-sidebar-btn, .admin-header { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .content-wrapper { padding: 0 !important; }
            .card-box { box-shadow: none !important; padding: 0 !important; }
            body { background: #fff !important; }
            @page { size: A4 portrait; margin: 1.5cm; }
            canvas { max-width: 100% !important; }
            .row { page-break-inside: avoid; }
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
            <div class="print-only" style="text-align:center; font-weight:bold; text-decoration:underline; text-transform:uppercase; margin-bottom:20px;">
                Laporan Statistik Nilai Rata-Rata Pendaftar<?php echo $tahun_filter ? ' Tahun ' . $tahun_filter : ' (Semua Tahun)'; ?>
            </div>

            <div class="row no-print" style="margin-bottom: 20px;">
                <div class="col-md-6"><h4><i class="fa fa-bar-chart"></i> Laporan Statistik Nilai Rata-Rata Pendaftar</h4></div>
                <div class="col-md-6 text-right">
                    <form action="statistik_nilai.php" method="GET" style="display:inline-block;">
                        <select name="tahun" class="form-control" style="display:inline-block; width:auto; margin-right:5px;" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            <?php foreach ($statistik['daftar_tahun'] as $th): ?>
                            <option value="<?= $th ?>" <?= ($tahun_filter == $th) ? 'selected' : '' ?>><?= $th ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-orange"><i class="fa fa-filter"></i> Terapkan</button>
                        <button type="button" class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Cetak PDF</button>
                    </form>
                </div>
            </div>

            <?php if ($statistik['rata_rata']['total_ternilai'] == 0): ?>

                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Belum ada data nilai pendaftar untuk periode ini.</div>

            <?php else: ?>

                <!-- Ringkasan Angka -->
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <div class="stat-card card-orange">
                            <div class="stat-content">
                                <h3><?= number_format($statistik['rata_rata']['avg_raport'], 1) ?></h3>
                                <p>Rata-rata Raport</p>
                            </div>
                            <div class="stat-icon"><i class="fa fa-book"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card card-blue">
                            <div class="stat-content">
                                <h3><?= number_format($statistik['rata_rata']['avg_tes'], 1) ?></h3>
                                <p>Rata-rata Nilai Tes</p>
                            </div>
                            <div class="stat-icon"><i class="fa fa-pencil-square-o"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card card-green">
                            <div class="stat-content">
                                <h3><?= number_format($statistik['rata_rata']['avg_prestasi'], 1) ?></h3>
                                <p>Rata-rata Prestasi</p>
                            </div>
                            <div class="stat-icon"><i class="fa fa-trophy"></i></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card card-orange">
                            <div class="stat-content">
                                <h3><?= number_format($statistik['rata_rata']['avg_jarak'], 1) ?> km</h3>
                                <p>Rata-rata Jarak Rumah</p>
                            </div>
                            <div class="stat-icon"><i class="fa fa-map-marker"></i></div>
                        </div>
                    </div>
                </div>

                <p style="color:#888; font-size: 13px;">
                    Total pendaftar ternilai pada periode ini: <b><?= $statistik['rata_rata']['total_ternilai'] ?></b> siswa
                    &mdash; Rata-rata Nilai Akhir SAW: <b><?= number_format($statistik['rata_rata']['avg_akhir'], 4) ?></b>
                </p>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Performa Rata-Rata per Kriteria</h5>
                        <canvas id="chartKriteria" height="240"></canvas>
                    </div>
                    <div class="col-md-6">
                        <h5>Sebaran Nilai Akhir SAW</h5>
                        <canvas id="chartSebaran" height="240"></canvas>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <h5>Tren Rata-Rata Nilai Akhir SAW per Tahun Ajaran</h5>
                        <canvas id="chartTren" height="100"></canvas>
                    </div>
                </div>

                <div class="print-only" style="margin-top: 40px; width: 100%; display: flex; justify-content: flex-end;">
                    <div style="text-align: center; width: 280px;">
                        <p>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></p>
                        <p>Ketua Panitia PPDB,</p>
                        <br><br><br>
                        <p style="font-weight: bold; text-decoration: underline;">( .................................... )</p>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
<?php if ($statistik['rata_rata']['total_ternilai'] > 0): ?>
// Chart 1: Rata-rata per Kriteria
new Chart(document.getElementById('chartKriteria'), {
    type: 'bar',
    data: {
        labels: ['C1: Raport', 'C2: Tes', 'C3: Prestasi', 'C4: Jarak (km)'],
        datasets: [{
            label: 'Rata-rata Nilai',
            data: [
                <?= (float) $statistik['rata_rata']['avg_raport'] ?>,
                <?= (float) $statistik['rata_rata']['avg_tes'] ?>,
                <?= (float) $statistik['rata_rata']['avg_prestasi'] ?>,
                <?= (float) $statistik['rata_rata']['avg_jarak'] ?>
            ],
            backgroundColor: ['#FF6700', '#374050', '#2ecc71', '#e74c3c']
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
});

// Chart 2: Sebaran Nilai Akhir SAW
new Chart(document.getElementById('chartSebaran'), {
    type: 'bar',
    data: {
        labels: [<?php foreach (array_keys($statistik['sebaran']) as $label) echo "'" . $label . "',"; ?>],
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: [<?php foreach ($statistik['sebaran'] as $count) echo $count . ","; ?>],
            backgroundColor: '#FF6700'
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

// Chart 3: Tren per Tahun Ajaran
new Chart(document.getElementById('chartTren'), {
    type: 'line',
    data: {
        labels: [<?php foreach ($statistik['tren_tahunan'] as $t) echo "'" . $t['tahun'] . "',"; ?>],
        datasets: [{
            label: 'Rata-rata Nilai Akhir SAW',
            data: [<?php foreach ($statistik['tren_tahunan'] as $t) echo (float) $t['rata_akhir'] . ","; ?>],
            borderColor: '#FF6700',
            backgroundColor: 'rgba(255,103,0,0.15)',
            tension: 0.3,
            fill: true
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
<?php endif; ?>
</script>

<?php require_once '../views/admin/template/footer.php'; ?>