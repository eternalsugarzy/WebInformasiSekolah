<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
$model = new PPDBModel();

// Filter opsional via query string: ?tahun=2026&jalur=Zonasi&status=Diterima
$filters = [
    'tahun'  => isset($_GET['tahun']) ? $_GET['tahun'] : '',
    'jalur'  => isset($_GET['jalur']) ? $_GET['jalur'] : '',
    'status' => isset($_GET['status']) ? $_GET['status'] : '',
];

$data = $model->getRekapPendaftaran($filters);

// Helper Tanggal Indo
function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

// Label keterangan filter yang sedang aktif, ditampilkan di bawah judul laporan
$keterangan_filter = [];
if (!empty($filters['tahun']))  $keterangan_filter[] = 'Tahun Ajaran ' . htmlspecialchars($filters['tahun']);
if (!empty($filters['jalur']))  $keterangan_filter[] = 'Jalur ' . htmlspecialchars($filters['jalur']);
if (!empty($filters['status'])) $keterangan_filter[] = 'Status ' . htmlspecialchars($filters['status']);
$teks_filter = count($keterangan_filter) > 0 ? implode(' | ', $keterangan_filter) : 'Seluruh Data Pendaftar';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Pendaftaran PPDB</title>
    <style>
        /* CSS Cetak Standar */
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; font-size: 11pt; }

        /* Kop Surat */
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img { height: 90px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        /* Judul Laporan */
        .judul { text-align: center; margin-bottom: 5px; font-weight: bold; text-decoration: underline; text-transform: uppercase; font-size: 14px; }
        .sub-judul { text-align: center; margin-bottom: 15px; font-size: 11px; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 6px; text-align: center; font-weight: bold; font-size: 10pt; }
        td { padding: 5px; text-align: center; font-size: 10pt; }
        td.nama, td.asal-sekolah { text-align: left; }

        .status-Diterima { font-weight: bold; }

        /* Tanda Tangan */
        .ttd-wrapper { margin-top: 40px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 250px; }

        @media print {
            @page { size: A4 landscape; margin: 1.5cm; } /* Landscape agar 10 kolom muat */
            body { margin: 0; }
            table { break-inside: avoid; }
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

    <div class="judul">Laporan Rekap Pendaftaran PPDB</div>
    <div class="sub-judul"><?php echo $teks_filter; ?></div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Jalur</th>
                <th>Asal Sekolah</th>
                <th>Nilai Rapor</th>
                <th>Nilai Tes</th>
                <th>Prestasi</th>
                <th>Jarak (km)</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; if (count($data) > 0) { foreach ($data as $d): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td class="nama"><?php echo htmlspecialchars($d['nama_lengkap']); ?></td>
                <td><?php echo htmlspecialchars($d['nisn']); ?></td>
                <td><?php echo htmlspecialchars($d['jalur_seleksi']); ?></td>
                <td class="asal-sekolah"><?php echo htmlspecialchars($d['nama_sekolah_asal']); ?></td>
                <td><?php echo ($d['nilai_raport'] !== null) ? number_format($d['nilai_raport'], 1) : '-'; ?></td>
                <td><?php echo ($d['nilai_tes'] !== null) ? number_format($d['nilai_tes'], 1) : '-'; ?></td>
                <td><?php echo ($d['nilai_prestasi'] !== null) ? number_format($d['nilai_prestasi'], 1) : '-'; ?></td>
                <td><?php echo ($d['jarak_rumah'] !== null) ? number_format($d['jarak_rumah'], 1) : '-'; ?></td>
                <td class="status-<?php echo htmlspecialchars($d['status_seleksi']); ?>"><?php echo strtoupper($d['status_seleksi']); ?></td>
            </tr>
            <?php endforeach; } else { echo "<tr><td colspan='10' style='padding:20px;'>Tidak ada data pendaftar untuk filter ini.</td></tr>"; } ?>
        </tbody>
    </table>

    <div style="font-size: 11px; margin-top: 10px;">
        <i>* Total Pendaftar: <?php echo count($data); ?> Siswa</i>
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
