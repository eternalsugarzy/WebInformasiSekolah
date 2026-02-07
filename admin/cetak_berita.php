<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

// 1. Load Model Berita (Data Utama)
require_once '../models/BeritaModel.php';

// Ambil Data dari URL (GET)
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

$model = new BeritaModel();
$data_berita = $model->getBeritaByDate($tgl_awal, $tgl_akhir);

// 2. [BARU] Load Model Guru (Data Kepsek)
require_once '../models/GuruModel.php';
$guruModel = new GuruModel();
$kepsek = $guruModel->getKepalaSekolah();

// Siapkan Variabel TTD
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
    <title>Laporan Berita</title>
    <style>
        /* CSS Reset & Print Config */
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
        }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        /* Judul Laporan */
        .judul-laporan { text-align: center; margin-bottom: 5px; text-decoration: underline; font-weight: bold; }
        .periode-laporan { text-align: center; margin-bottom: 20px; font-size: 14px; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px 10px; text-align: left; font-size: 12px; vertical-align: middle; }
        th { background-color: #e0e0e0; text-align: center; font-weight: bold; }
        
        /* Tanda Tangan */
        .ttd { width: 100%; margin-top: 50px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 280px; text-align: center; }
        
        @media print {
            @page { size: A4; margin: 2cm; }
            body { margin: 0; }
            -webkit-print-color-adjust: exact;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png" onerror="this.style.display='none'">
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Laporan Arsip Pengumuman & Informasi Penting</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <h3 class="judul-laporan">LAPORAN ARSIP BERITA</h3>
    <p class="periode-laporan">
        Periode: <?php echo tgl_indo($tgl_awal); ?> s/d <?php echo tgl_indo($tgl_akhir); ?>
    </p>

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
                    $tgl = date('Y-m-d', strtotime($b['tanggal_publikasi']));
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($b['judul']); ?></td>
                <td><?php echo htmlspecialchars($b['kategori']); ?></td>
                <td><?php echo htmlspecialchars($b['penulis']); ?></td>
                <td style="text-align: center;"><?php echo tgl_indo($tgl); ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Tidak ada berita pada periode ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></p>
            <p>Kepala Sekolah</p>
            <br><br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">
                <?php echo htmlspecialchars($nama_kepsek); ?>
            </p>
            <p>NIP. <?php echo htmlspecialchars($nip_kepsek); ?></p>
        </div>
    </div>

</body>
</html>