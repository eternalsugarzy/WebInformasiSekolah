<?php
session_start();
// Ekspor Laporan Penerimaan PPDB ke Excel (.xls berbasis tabel HTML, bisa dibuka langsung di Microsoft Excel)
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

$ket = [];
$ket[] = $filters['tahun'] ? 'Tahun Ajaran ' . $filters['tahun'] . '/' . ($filters['tahun'] + 1) : 'Semua Tahun';
if ($filters['jalur']) $ket[] = 'Jalur ' . $filters['jalur'];
if ($filters['gelombang'] === 'tanpa') {
    $ket[] = 'Tanpa Gelombang';
} elseif ($filters['gelombang'] !== '') {
    $g = $gelombangModel->getById($filters['gelombang']);
    if ($g) $ket[] = $g['nama_gelombang'] . ' ' . date('Y', strtotime($g['tanggal_mulai']));
}

$nama_file = 'Laporan_Penerimaan_PPDB_' . ($filters['tahun'] ?: 'Semua') . '_' . date('Ymd') . '.xls';
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$nama_file\"");
header("Cache-Control: max-age=0");

$e = function ($v) { return htmlspecialchars((string) $v); };

function tabel_sebaran($judul, $kolom, $rows, $e) {
    echo "<tr><td colspan='7'></td></tr>";
    echo "<tr><td colspan='7'><b>{$e($judul)}</b></td></tr>";
    echo "<tr><th>No</th><th>{$e($kolom)}</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>% Diterima</th></tr>";
    $no = 1;
    foreach ($rows as $r) {
        echo "<tr><td>" . $no++ . "</td><td>{$e($r['label'])}</td><td>{$r['pendaftar']}</td><td>{$r['diterima']}</td><td>{$r['cadangan']}</td><td>{$r['ditolak']}</td><td>{$r['persen_diterima']}%</td></tr>";
    }
}
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
<table border="1">
    <tr><td colspan="10"><b>LAPORAN REKAPITULASI PENERIMAAN PESERTA DIDIK BARU - SMA FRATER DON BOSCO BANJARMASIN</b></td></tr>
    <tr><td colspan="10"><?= $e(implode(' | ', $ket)); ?> &mdash; Dicetak <?= date('d/m/Y H:i'); ?></td></tr>
    <tr><td colspan="10"></td></tr>

    <tr><td colspan="10"><b>Ringkasan</b></td></tr>
    <tr><th>Total Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>Menunggu</th><th>Sudah Daftar Ulang</th><th>% Penerimaan</th></tr>
    <tr>
        <td><?= $lap['ringkasan']['pendaftar']; ?></td><td><?= $lap['ringkasan']['diterima']; ?></td><td><?= $lap['ringkasan']['cadangan']; ?></td>
        <td><?= $lap['ringkasan']['ditolak']; ?></td><td><?= $lap['ringkasan']['menunggu']; ?></td><td><?= $lap['ringkasan']['daftar_ulang']; ?></td>
        <td><?= $lap['ringkasan']['persen_diterima']; ?>%</td>
    </tr>

    <tr><td colspan="10"></td></tr>
    <tr><td colspan="10"><b>A. Rekapitulasi per Jalur Seleksi &amp; Pemenuhan Kuota</b></td></tr>
    <tr><th>Jalur</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>Menunggu</th><th>% Diterima</th><th>Kuota Diterima</th><th>Kuota Terisi</th><th>Keterangan Kuota</th></tr>
    <?php foreach ($lap['per_jalur'] as $jalur => $r): ?>
    <tr>
        <td><?= $e($jalur); ?></td><td><?= $r['pendaftar']; ?></td><td><?= $r['diterima']; ?></td><td><?= $r['cadangan']; ?></td>
        <td><?= $r['ditolak']; ?></td><td><?= $r['menunggu']; ?></td><td><?= $r['persen_diterima']; ?>%</td>
        <td><?= $r['kuota_diterima']; ?></td><td><?= $r['kuota_terisi']; ?></td><td><?= $e($r['status_kuota']); ?></td>
    </tr>
    <?php endforeach; ?>

    <tr><td colspan="10"></td></tr>
    <tr><td colspan="10"><b>B. Rekapitulasi per Gelombang</b></td></tr>
    <tr><th>Gelombang</th><th>Periode</th><th>Pendaftar</th><th>Diterima</th><th>Cadangan</th><th>Tidak Diterima</th><th>Menunggu</th><th>% Diterima</th></tr>
    <?php foreach ($lap['per_gelombang'] as $r): ?>
    <tr>
        <td><?= $e($r['label']); ?></td><td><?= $e($r['periode']); ?></td><td><?= $r['pendaftar']; ?></td><td><?= $r['diterima']; ?></td>
        <td><?= $r['cadangan']; ?></td><td><?= $r['ditolak']; ?></td><td><?= $r['menunggu']; ?></td><td><?= $r['persen_diterima']; ?>%</td>
    </tr>
    <?php endforeach; ?>

    <?php
    tabel_sebaran('C. Sebaran berdasarkan Jenis Kelamin', 'Jenis Kelamin', $lap['sebaran_jk'], $e);
    tabel_sebaran('D. Sebaran berdasarkan Asal Sekolah', 'Asal Sekolah', $lap['sebaran_sekolah'], $e);
    tabel_sebaran('E. Sebaran berdasarkan Kecamatan Sekolah Asal', 'Kecamatan', $lap['sebaran_kecamatan'], $e);
    ?>
</table>
</body>
</html>
