<?php
session_start();

// 1. Cek Login (Keamanan)
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

// 2. Panggil Model Guru
require_once '../models/GuruModel.php';
$model = new GuruModel();

// Ambil Data List Guru
$data_guru = $model->getAllGuruList();

// [BARU] Ambil Data Kepala Sekolah
$kepsek = $model->getKepalaSekolah();

// Setup Default jika data Kepsek belum diinput di database
$nama_kepsek = !empty($kepsek['nama_lengkap']) ? $kepsek['nama_lengkap'] : '( Belum Ada Data Kepsek )';
$nip_kepsek  = !empty($kepsek['nip']) ? $kepsek['nip'] : '-';

// [BARU] Helper Tanggal Indonesia
function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    // $pecahkan[0] = tahun, [1] = bulan, [2] = tanggal
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Guru</title>
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
        .ttd-box { width: 280px; text-align: center; } /* Lebar sedikit ditambah */
        
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
        <img src="../img/logo.png" onerror="this.style.display='none'"> 
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Laporan Arsip Pengumuman & Informasi Penting</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <h3 class="judul-laporan">DATA GURU & STAF PENGAJAR</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">NIP / NUPTK</th>
                <th>Nama Lengkap</th>
                <th width="20%">Jabatan</th>
                <th width="20%">Bidang Studi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (count($data_guru) > 0) {
                foreach ($data_guru as $g) {
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($g['nip'] ?? '-'); ?></td>
                <td style="font-weight: bold;"><?php echo htmlspecialchars($g['nama_lengkap']); ?></td>
                <td><?php echo htmlspecialchars($g['jabatan']); ?></td>
                <td><?php echo htmlspecialchars($g['bidang_studi']); ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Belum ada data guru.</td></tr>";
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