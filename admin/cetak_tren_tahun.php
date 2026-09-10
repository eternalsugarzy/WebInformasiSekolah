<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
$model = new PPDBModel();
$tren = $model->getTrenPPDBAntarTahun();

// Total keseluruhan (semua tahun)
$total = ['pendaftar' => 0, 'diterima' => 0, 'cadangan' => 0, 'ditolak' => 0, 'menunggu' => 0];
foreach ($tren as $t) {
    $total['pendaftar'] += (int) $t['pendaftar'];
    $total['diterima']  += (int) $t['diterima'];
    $total['cadangan']  += (int) $t['cadangan'];
    $total['ditolak']   += (int) $t['ditolak'];
    $total['menunggu']  += (int) $t['menunggu'];
}

// Helper Tanggal Indo
function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tren PPDB Antar Tahun</title>
    <style>
        /* CSS Cetak Standar */
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; font-size: 12pt; }

        /* Kop Surat */
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img { height: 90px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        /* Judul Laporan */
        .judul { text-align: center; margin-bottom: 20px; font-weight: bold; text-decoration: underline; text-transform: uppercase; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 10px; text-align: center; font-weight: bold; }
        td { padding: 10px; text-align: center; }
        td.tahun { font-weight: bold; }
        tr.total-row { background-color: #f2f2f2; font-weight: bold; }

        /* Tanda Tangan */
        .ttd-wrapper { margin-top: 50px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 250px; }

        @media print {
            @page { size: A4 portrait; margin: 2cm; }
            body { margin: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png" onerror="this.style.display='none'">
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <div class="judul">
        Laporan Tren Pendaftaran PPDB Antar Tahun
    </div>

    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Pendaftar</th>
                <th>Diterima</th>
                <th>Cadangan</th>
                <th>Ditolak</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($tren) > 0) { foreach ($tren as $t): ?>
            <tr>
                <td class="tahun"><?php echo htmlspecialchars($t['tahun']); ?></td>
                <td><?php echo (int) $t['pendaftar']; ?></td>
                <td><?php echo (int) $t['diterima']; ?></td>
                <td><?php echo (int) $t['cadangan']; ?></td>
                <td><?php echo (int) $t['ditolak']; ?></td>
            </tr>
            <?php endforeach; } else { echo "<tr><td colspan='5' style='padding:20px;'>Belum ada data pendaftar PPDB.</td></tr>"; } ?>
            <?php if (count($tren) > 0): ?>
            <tr class="total-row">
                <td class="tahun">TOTAL KESELURUHAN</td>
                <td><?php echo $total['pendaftar']; ?></td>
                <td><?php echo $total['diterima']; ?></td>
                <td><?php echo $total['cadangan']; ?></td>
                <td><?php echo $total['ditolak']; ?></td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="font-size: 11px; margin-top: 10px;">
        <i>* Kolom "Pendaftar" adalah total seluruh pendaftar tahun tersebut, termasuk yang masih berstatus Menunggu (belum diproses seleksi).</i><br>
        <i>* Total pendaftar berstatus Menunggu di semua tahun: <?php echo $total['menunggu']; ?> siswa.</i>
    </div>

    <div class="ttd-wrapper">
        <div class="ttd">
            <p>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></p>
            <p>Ketua Panitia PPDB,</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">( .................................... )</p>
        </div>
    </div>

</body>
</html>
