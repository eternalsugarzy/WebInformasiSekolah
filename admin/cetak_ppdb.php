<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
$model = new PPDBModel();

// 2. Tentukan Tahun Ajaran (Ambil tahun saat ini)
$tahun_ini = date('Y');
$data_siswa = $model->getLaporanPendaftar($tahun_ini);

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
    <title>Laporan Pendaftar PPDB <?php echo $tahun_ini; ?></title>
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
        td { padding: 8px; vertical-align: top; }
        
        /* Kolom Spesifik */
        .col-no { width: 5%; text-align: center; }
        .col-reg { width: 15%; text-align: center; }
        .col-nama { width: 30%; }
        .col-asal { width: 25%; }
        .col-status { width: 10%; text-align: center; }

        /* Tanda Tangan */
        .ttd-wrapper { margin-top: 50px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 250px; }

        @media print {
            @page { size: A4 landscape; margin: 2cm; } /* Landscape agar muat banyak kolom */
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
        LAPORAN DATA PENDAFTAR TAHUN AJARAN <?php echo $tahun_ini . "/" . ($tahun_ini+1); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-reg">No. Registrasi</th>
                <th class="col-nama">Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th class="col-asal">Asal Sekolah</th>
                <th>Tanggal Daftar</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if (count($data_siswa) > 0) {
                foreach ($data_siswa as $d) {
                    $tgl_daftar = date('Y-m-d', strtotime($d['tanggal_daftar']));
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $no++; ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($d['no_registrasi']); ?></td>
                <td style="font-weight: bold;"><?php echo htmlspecialchars($d['nama_lengkap']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($d['jenis_kelamin']); ?></td>
                <td><?php echo htmlspecialchars($d['nama_sekolah_asal']); ?></td>
                <td style="text-align: center;"><?php echo tgl_indo($tgl_daftar); ?></td>
                <td style="text-align: center;">
                    <?php echo strtoupper($d['status_seleksi']); ?>
                </td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center; padding:20px;'>Belum ada data pendaftar untuk tahun ini.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div style="font-size: 11px; margin-top: 10px;">
        <i>* Total Pendaftar: <?php echo count($data_siswa); ?> Siswa</i>
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