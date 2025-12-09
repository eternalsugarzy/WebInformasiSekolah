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
        /* CSS untuk Tampilan Cetak */
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; }
        
        /* Kop Surat */
        .kop-surat { 
            border-bottom: 3px solid #000; 
            padding-bottom: 25px; 
            margin-bottom: 30px; 
            text-align: center; 
            position: relative; 
        }
        .kop-surat img { 
            height: 90px; 
            position: absolute; 
            left: 10px; 
            top: 0; 
            /* filter: grayscale(100%); Hapus komentar ini jika ingin logo hitam putih */
        }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        /* Judul Laporan */
        .judul-laporan { text-align: center; margin-bottom: 20px; text-decoration: underline; font-weight: bold; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px 10px; text-align: left; font-size: 12px; vertical-align: middle; }
        th { background-color: #e0e0e0; text-align: center; font-weight: bold; }
        
        /* Tanda Tangan */
        .ttd { width: 100%; margin-top: 50px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 250px; text-align: center; }
        
        /* Print Settings */
        @media print {
            @page { size: A4; margin: 2cm; }
            body { margin: 0; }
            -webkit-print-color-adjust: exact;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png">
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Laporan Arsip Pengumuman & Informasi Penting</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
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