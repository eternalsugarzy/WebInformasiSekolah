<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

// 2. Load Model Pengumuman
require_once '../models/PengumumanModel.php';
$model = new PengumumanModel();
$data = $model->getAllPengumuman();

// 3. [BARU] Load Model Guru untuk ambil TTD Kepsek
require_once '../models/GuruModel.php';
$guruModel = new GuruModel();
$kepsek = $guruModel->getKepalaSekolah();

// Siapkan data TTD (Antisipasi jika data kosong)
$nama_kepsek = !empty($kepsek['nama_lengkap']) ? $kepsek['nama_lengkap'] : '( ...Belum diinput... )';
$nip_kepsek  = !empty($kepsek['nip']) ? $kepsek['nip'] : '-';

// Helper Tanggal Indo (Agar "August" jadi "Agustus")
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
    <title>Laporan Pengumuman</title>
    <style>
        /* CSS Reset & Print Config */
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; }
        
        /* Kop Surat */
        .kop-surat { 
            border-bottom: 3px solid #000; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
            text-align: center; 
            position: relative; 
        }
        .kop-surat img { 
            height: 80px; 
            position: absolute; 
            left: 10px; 
            top: 0; 
        }
        .kop-surat h2 { margin: 0; font-size: 22px; font-weight: bold; text-transform: uppercase; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }
        
        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 10px; text-align: left; font-size: 12px; vertical-align: top; }
        th { background-color: #eee; text-align: center; font-weight: bold; }
        
        /* Kolom Status Badge (Visual Only) */
        .status-aktif { font-weight: bold; }
        
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

    <h3 style="text-align: center; text-decoration: underline;">REKAPITULASI PENGUMUMAN SEKOLAH</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Judul Pengumuman</th>
                <th>Isi Ringkas</th>
                <th width="15%">Tanggal Berlaku</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (count($data) > 0) {
                foreach ($data as $d) {
                    $tgl = date('Y-m-d', strtotime($d['tanggal_penting']));
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td><b><?php echo htmlspecialchars($d['judul']); ?></b></td>
                <td><?php echo htmlspecialchars(substr($d['isi_pengumuman'], 0, 150)) . '...'; ?></td>
                <td style="text-align: center;"><?php echo tgl_indo($tgl); ?></td>
                <td style="text-align: center;" class="status-aktif"><?php echo $d['status']; ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Belum ada data pengumuman.</td></tr>";
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