<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

require_once '../models/GaleriModel.php';
$model = new GaleriModel();
$data = $model->getAllGaleri();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Galeri</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; margin: 40px; }
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img { height: 80px; position: absolute; left: 10px; top: 0;  }
        .kop-surat h2 { margin: 0; font-size: 22px; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 10px; text-align: left; font-size: 12px; vertical-align: middle; }
        th { background-color: #eee; text-align: center; }
        
        .ttd { width: 100%; margin-top: 50px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 250px; text-align: center; }

        @media print { @page { size: A4; margin: 2cm; } body { margin: 0; } -webkit-print-color-adjust: exact; }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png">
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Laporan Dokumentasi & Galeri Kegiatan</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <h3 style="text-align: center; text-decoration: underline;">INVENTARIS DOKUMENTASI</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Bukti Foto</th>
                <th>Nama Kegiatan / Album</th>
                <th>Deskripsi</th>
                <th width="15%">Tanggal Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (count($data) > 0) {
                foreach ($data as $d) {
                    $img_path = "uploads/galeri/" . $d['file_path'];
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td style="text-align: center; padding: 5px;">
                    <?php if(file_exists($img_path)): ?>
                        <img src="<?php echo $img_path; ?>" style="width: 80px; height: auto;">
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><b><?php echo htmlspecialchars($d['judul_album']); ?></b></td>
                <td><?php echo htmlspecialchars($d['deskripsi']); ?></td>
                <td style="text-align: center;"><?php echo date('d/m/Y', strtotime($d['tanggal_event'])); ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Belum ada dokumentasi.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Banjarmasin, <?php echo date('d F Y'); ?></p>
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p style="text-decoration: underline; font-weight: bold;">Fr. M. Paul, CMM, M.Pd</p>
        </div>
    </div>
</body>
</html>