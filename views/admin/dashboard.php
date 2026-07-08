<?php 
// Memanggil Bagian-bagian Template
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" style="border-left: 4px solid #FF6700; background: #fff; color: #555;">
                    Selamat Datang di Panel Administrator SMA Frater Don Bosco. Anda login sebagai <b><?php echo $_SESSION['admin_level']; ?></b>.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stat-card card-orange">
                    <div class="stat-content">
                        <h3><?php echo $total_berita; ?></h3> 
                        <p>Total Berita</p>
                        <a href="berita.php" style="font-size:11px; color:#FF6700; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card card-blue">
                    <div class="stat-content">
                        <h3><?php echo $total_pengumuman; ?></h3>
                        <p>Pengumuman</p>
                        <a href="pengumuman.php" style="font-size:11px; color:#374050; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card card-green">
                    <div class="stat-content">
                        <h3><?php echo $total_guru; ?></h3>
                        <p>Data Guru</p>
                        <a href="guru.php" style="font-size:11px; color:#2ecc71; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="stat-card card-orange">
                    <div class="stat-content">
                        <h3><?php echo $total_pengunjung; ?></h3>
                        <p>Total Pengunjung Website</p>
                        <span style="font-size:11px; color:#888;">Hari ini: <b><?php echo $pengunjung_hari_ini; ?></b> kunjungan</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card card-blue">
                    <div class="stat-content">
                        <h3><?php echo array_sum($statistik_kelulusan); ?></h3>
                        <p>Total Pendaftar PPDB (Semua Tahun)</p>
                        <span style="font-size:11px; color:#888;">Diterima: <b><?php echo $statistik_kelulusan['Diterima']; ?></b> siswa</span>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <h5 style="margin-top:0;"><i class="fa fa-line-chart"></i> Tren Kunjungan Website (14 Hari Terakhir)</h5>
                    <canvas id="chartPengunjung" height="90"></canvas>
                </div>
            </div>
            <div class="col-md-5">
                <div style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <h5 style="margin-top:0;"><i class="fa fa-pie-chart"></i> Statistik Kelulusan PPDB</h5>
                    <canvas id="chartKelulusan" height="150"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 30px;">
                    <h5 style="margin-top:0;"><i class="fa fa-bar-chart"></i> Tren Jumlah Pendaftar PPDB per Tahun Ajaran</h5>
                    <canvas id="chartTrenPendaftar" height="80"></canvas>
                </div>
            </div>
        </div>

    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grafik 1: Tren Kunjungan Website
new Chart(document.getElementById('chartPengunjung'), {
    type: 'line',
    data: {
        labels: [<?php foreach ($tren_pengunjung as $t) echo "'" . date('d/m', strtotime($t['tanggal'])) . "',"; ?>],
        datasets: [{
            label: 'Jumlah Kunjungan',
            data: [<?php foreach ($tren_pengunjung as $t) echo $t['jumlah'] . ","; ?>],
            borderColor: '#FF6700',
            backgroundColor: 'rgba(255,103,0,0.1)',
            tension: 0.3,
            fill: true
        }]
    },
    options: { scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});

// Grafik 2: Statistik Kelulusan (Pie/Doughnut)
new Chart(document.getElementById('chartKelulusan'), {
    type: 'doughnut',
    data: {
        labels: ['Diterima', 'Cadangan', 'Ditolak', 'Menunggu'],
        datasets: [{
            data: [
                <?php echo $statistik_kelulusan['Diterima']; ?>,
                <?php echo $statistik_kelulusan['Cadangan']; ?>,
                <?php echo $statistik_kelulusan['Ditolak']; ?>,
                <?php echo $statistik_kelulusan['Menunggu']; ?>
            ],
            backgroundColor: ['#2ecc71', '#f0ad4e', '#d9534f', '#aaaaaa']
        }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
});

// Grafik 3: Tren Jumlah Pendaftar per Tahun
new Chart(document.getElementById('chartTrenPendaftar'), {
    type: 'bar',
    data: {
        labels: [<?php foreach ($tren_pendaftar as $t) echo "'" . $t['tahun'] . "',"; ?>],
        datasets: [{
            label: 'Jumlah Pendaftar',
            data: [<?php foreach ($tren_pendaftar as $t) echo $t['jumlah'] . ","; ?>],
            backgroundColor: '#374050'
        }]
    },
    options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
});
</script>

<?php require_once 'template/footer.php'; ?>