<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

require_once '../models/BeritaModel.php';

// Ambil Data dari URL (GET)
$tgl_awal = $_GET['tgl_awal'];
$tgl_akhir = $_GET['tgl_akhir'];

$model = new BeritaModel();
// Panggil fungsi filter tanggal yang kita buat di langkah 1
$data_berita = $model->getBeritaByDate($tgl_awal, $tgl_akhir);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Berita</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; margin: 40px; }
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img { height: 80px; position: absolute; left: 0; top: 0; filter: grayscale(100%); }
        .kop-surat h2 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .kop-surat h4 { margin: 5px 0; font-size: 18px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 12px; font-style: italic; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px 10px; text-align: left; font-size: 12px; }
        th { background-color: #f0f0f0; text-align: center; }
        .ttd { width: 100%; margin-top: 50px; }
        .ttd-box { float: right; width: 250px; text-align: center; }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png">
        <h2>SMA MAJU JAYA</h2>
        <h4>Laporan Rekapitulasi Berita & Kegiatan</h4>
        <p>Periode: <?php echo date('d/m/Y', strtotime($tgl_awal)); ?> s/d <?php echo date('d/m/Y', strtotime($tgl_akhir)); ?></p>
    </div>

    <h3 style="text-align: center; margin-bottom: 20px;">LAPORAN ARSIP BERITA</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Judul Berita</th>
                <th width="15%">Kategori</th>
                <th width="15%">Penulis</th>
                <th width="15%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (count($data_berita) > 0) {
                foreach ($data_berita as $b) {
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($b['judul']); ?></td>
                <td><?php echo htmlspecialchars($b['kategori']); ?></td>
                <td><?php echo htmlspecialchars($b['penulis']); ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($b['tanggal_publikasi'])); ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada berita pada periode ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Kota Harapan, <?php echo date('d F Y'); ?></p>
            <p>Mengetahui, Kepala Sekolah</p>
            <br><br><br>
            <p><b>Dr. Budi Santoso, M.Pd</b></p>
            <p>NIP. 19800101 200501 1 001</p>
        </div>
    </div>

</body>
</html>