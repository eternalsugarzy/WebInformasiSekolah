<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PrestasiModel.php';
$model = new PrestasiModel();

// Filter opsional: ?tahun=2026&jenis=Akademik&tingkat=Nasional&kelas=XI&status=Terverifikasi
// Parameter status yang tidak dikirim sama sekali dianggap 'Terverifikasi'.
$filters = [
    'tahun'   => $_GET['tahun'] ?? '',
    'jenis'   => $_GET['jenis'] ?? '',
    'tingkat' => $_GET['tingkat'] ?? '',
    'kelas'   => $_GET['kelas'] ?? '',
    'status'  => array_key_exists('status', $_GET) ? $_GET['status'] : 'Terverifikasi',
];

$data = $model->getAll($filters);
$ringkasan = $model->getRingkasan($filters);

function tgl_indo($tanggal){
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $p = explode('-', $tanggal);
    return $p[2] . ' ' . $bulan[(int) $p[1]] . ' ' . $p[0];
}

$ket = [];
if (!empty($filters['tahun']))   $ket[] = 'Tahun ' . intval($filters['tahun']);
if (!empty($filters['jenis']))   $ket[] = 'Jenis ' . $filters['jenis'];
if (!empty($filters['tingkat'])) $ket[] = 'Tingkat ' . $filters['tingkat'];
if (!empty($filters['kelas']))   $ket[] = 'Kelas ' . $filters['kelas'];
$ket[] = !empty($filters['status']) ? 'Status ' . $filters['status'] : 'Semua Status Verifikasi';
$teks_filter = implode(' | ', $ket);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Siswa Berprestasi</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; font-size: 11pt; }
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img { height: 90px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }
        .judul { text-align: center; margin-bottom: 5px; font-weight: bold; text-decoration: underline; text-transform: uppercase; font-size: 14px; }
        .sub-judul { text-align: center; margin-bottom: 15px; font-size: 11px; }
        h5 { margin: 18px 0 5px; font-size: 12pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 6px; text-align: center; font-weight: bold; }
        td { padding: 6px; }
        td.c { text-align: center; }
        tr.total td { background-color: #f2f2f2; font-weight: bold; }
        .ringkasan { width: auto; min-width: 60%; }
        .ttd-wrapper { margin-top: 40px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 260px; }
        @media print {
            @page { size: A4 landscape; margin: 1.5cm; }
            body { margin: 0; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png" onerror="this.style.display='none'">
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>BANJARMASIN</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <div class="judul">Laporan Data Siswa Berprestasi</div>
    <div class="sub-judul"><?= htmlspecialchars($teks_filter); ?></div>

    <h5>A. Ringkasan Jumlah Prestasi</h5>
    <table class="ringkasan">
        <thead>
            <tr>
                <th>Tingkat</th>
                <?php foreach (PrestasiModel::JENIS as $j): ?><th><?= $j; ?></th><?php endforeach; ?>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Matriks tingkat x jenis dari data detail (sudah terfilter)
            $matriks = [];
            foreach (array_reverse(PrestasiModel::TINGKAT) as $t) $matriks[$t] = array_fill_keys(PrestasiModel::JENIS, 0);
            foreach ($data as $d) $matriks[$d['tingkat']][$d['jenis']]++;
            foreach ($matriks as $t => $per_jenis):
            ?>
            <tr>
                <td><?= htmlspecialchars($t); ?></td>
                <?php foreach ($per_jenis as $n): ?><td class="c"><?= $n; ?></td><?php endforeach; ?>
                <td class="c"><b><?= array_sum($per_jenis); ?></b></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td>TOTAL</td>
                <?php foreach (PrestasiModel::JENIS as $j): ?><td class="c"><?= $ringkasan['per_jenis'][$j]; ?></td><?php endforeach; ?>
                <td class="c"><?= $ringkasan['total']; ?></td>
            </tr>
        </tbody>
    </table>
    <div style="font-size: 11px; margin-top: 5px;"><i>Jumlah siswa berprestasi: <?= $ringkasan['jumlah_siswa']; ?> siswa.</i></div>

    <h5>B. Daftar Prestasi Siswa</h5>
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Nama Prestasi</th>
                <th>Jenis</th>
                <th>Tingkat</th>
                <th>Peringkat</th>
                <th>Penyelenggara</th>
                <th>Tahun</th>
                <?php if (empty($filters['status'])): ?><th>Status</th><?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0): $no = 1; foreach ($data as $d): ?>
            <tr>
                <td class="c"><?= $no++; ?></td>
                <td><?= htmlspecialchars($d['nama_lengkap']); ?></td>
                <td class="c"><?= htmlspecialchars($d['nisn']); ?></td>
                <td class="c"><?= htmlspecialchars($d['kelas']); ?></td>
                <td><?= htmlspecialchars($d['nama_prestasi']); ?></td>
                <td class="c"><?= htmlspecialchars($d['jenis']); ?></td>
                <td class="c"><?= htmlspecialchars($d['tingkat']); ?></td>
                <td class="c"><?= htmlspecialchars($d['peringkat']); ?></td>
                <td><?= htmlspecialchars($d['penyelenggara']); ?></td>
                <td class="c"><?= htmlspecialchars($d['tahun']); ?></td>
                <?php if (empty($filters['status'])): ?><td class="c"><?= htmlspecialchars($d['status_verifikasi']); ?></td><?php endif; ?>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="11" class="c">Tidak ada data prestasi untuk filter ini.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="ttd-wrapper">
        <div class="ttd">
            <p>Banjarmasin, <?= tgl_indo(date('Y-m-d')); ?></p>
            <p>Wakil Kepala Sekolah Bidang Kesiswaan,</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">( .................................... )</p>
        </div>
    </div>

</body>
</html>
