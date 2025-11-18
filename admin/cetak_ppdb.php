<?php
session_start();
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
$model = new PPDBModel();
$data_ppdb = $model->getAllPPDB();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi PPDB</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; line-height: 1.6; }
        
        /* Kop Surat */
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 15px; margin-bottom: 30px; text-align: center; position: relative; }
        .kop-surat img { height: 90px; position: absolute; left: 10px; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 24px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 18px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        /* Judul */
        .judul-dokumen { text-align: center; border: 2px solid #333; padding: 10px; margin-bottom: 30px; background: #f9f9f9; }
        .judul-dokumen h3 { margin: 0; text-transform: uppercase; }

        /* Item Informasi */
        .info-item { margin-bottom: 30px; border-bottom: 1px dashed #ccc; padding-bottom: 20px; }
        .info-title { font-size: 18px; font-weight: bold; color: #000; margin-bottom: 10px; display: block; text-decoration: underline; }
        .info-date { font-size: 12px; color: #555; margin-bottom: 10px; display: block; font-style: italic; }
        .info-content { text-align: justify; white-space: pre-line; /* Agar enter terbaca */ }

        /* Link */
        .link-box { margin-top: 10px; background: #eee; padding: 10px; font-weight: bold; font-size: 12px; border-radius: 4px; display: inline-block; }

        @media print {
            @page { size: A4; margin: 2cm; }
            body { margin: 0; }
            .link-box { background: #fff; border: 1px solid #ccc; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <img src="../img/logo.png" style="filter: invert(1);"> 
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Penerimaan Peserta Didik Baru (PPDB)</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567 | Web: www.smafraterdb.sch.id</p>
    </div>

    <div class="judul-dokumen">
        <h3>PANDUAN INFORMASI PENDAFTARAN</h3>
        <small>Tahun Ajaran <?php echo date('Y') . "/" . (date('Y')+1); ?></small>
    </div>

    <?php 
    if (count($data_ppdb) > 0) {
        foreach ($data_ppdb as $item) {
    ?>
        <div class="info-item">
            <span class="info-title"><?php echo htmlspecialchars($item['jenis_informasi']); ?></span>
            
            <span class="info-date">
                Periode: <?php echo date('d M Y', strtotime($item['tanggal_mulai'])); ?> 
                s/d <?php echo date('d M Y', strtotime($item['tanggal_akhir'])); ?>
            </span>

            <div class="info-content">
                <?php echo htmlspecialchars($item['isi_detail']); ?>
            </div>

            <?php if(!empty($item['tautan_formulir'])): ?>
            <div class="link-box">
                Link Pendaftaran: <?php echo htmlspecialchars($item['tautan_formulir']); ?>
            </div>
            <?php endif; ?>
        </div>
    <?php 
        }
    } else {
        echo "<p style='text-align:center'>Belum ada informasi PPDB yang dipublikasikan.</p>";
    }
    ?>

    <div style="text-align: center; margin-top: 50px; font-size: 12px; color: #777;">
        <i>Dokumen ini dicetak otomatis dari sistem informasi sekolah pada tanggal <?php echo date('d F Y'); ?>.</i>
    </div>

</body>
</html>