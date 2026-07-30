<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
$model = new PPDBModel();

// Boleh override tahun via ?tahun=XXXX, default tahun berjalan
$tahun_ini = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');
$rekap = $model->getRekapJalurSeleksi($tahun_ini);

// Load Model Guru untuk ambil TTD Kepsek
require_once '../models/GuruModel.php';
$guruModel = new GuruModel();
$kepsek = $guruModel->getKepalaSekolah();
$nama_kepsek = !empty($kepsek['nama_lengkap']) ? $kepsek['nama_lengkap'] : '( ...Belum diinput... )';
$nip_kepsek  = !empty($kepsek['nip']) ? $kepsek['nip'] : '-';

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
    <title>Laporan Rekap Jalur Seleksi PPDB <?php echo $tahun_ini; ?></title>
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
        td.nama-jalur { text-align: left; font-weight: bold; }
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
        Laporan Rekapitulasi Pendaftar per Jalur Seleksi<br>
        Tahun Ajaran <?php echo $tahun_ini . "/" . ($tahun_ini + 1); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Jalur Seleksi</th>
                <th>Menunggu</th>
                <th>Diterima</th>
                <th>Cadangan</th>
                <th>Ditolak</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekap['per_jalur'] as $nama_jalur => $data): ?>
            <tr>
                <td class="nama-jalur"><?php echo htmlspecialchars($nama_jalur); ?></td>
                <td><?php echo $data['Menunggu']; ?></td>
                <td><?php echo $data['Diterima']; ?></td>
                <td><?php echo $data['Cadangan']; ?></td>
                <td><?php echo $data['Ditolak']; ?></td>
                <td><b><?php echo $data['Total']; ?></b></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td class="nama-jalur">TOTAL KESELURUHAN</td>
                <td><?php echo $rekap['grand_total']['Menunggu']; ?></td>
                <td><?php echo $rekap['grand_total']['Diterima']; ?></td>
                <td><?php echo $rekap['grand_total']['Cadangan']; ?></td>
                <td><?php echo $rekap['grand_total']['Ditolak']; ?></td>
                <td><?php echo $rekap['grand_total']['Total']; ?></td>
            </tr>
        </tbody>
    </table>

    <div style="font-size: 11px; margin-top: 10px;">
        <i>* Data mencakup seluruh pendaftar pada tahun ajaran <?php echo $tahun_ini; ?>.</i>
    </div>

    <div class="ttd-wrapper">
        <div class="ttd">
            <p>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;"><?php echo htmlspecialchars($nama_kepsek); ?></p>
            <p>NIP. <?php echo htmlspecialchars($nip_kepsek); ?></p>
        </div>
    </div>

</body>
</html>