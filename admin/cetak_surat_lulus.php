<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/PPDBModel.php';
require_once '../models/SawModel.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$ppdbModel = new PPDBModel();
$sawModel = new SawModel();

$siswa = $ppdbModel->getPendaftarById($id);

if (!$siswa) {
    die("Data pendaftar tidak ditemukan.");
}

// Surat kelulusan hanya boleh dicetak untuk pendaftar yang berstatus Diterima
if ($siswa['status_seleksi'] !== 'Diterima') {
    die("Surat Keterangan Lulus hanya bisa dicetak untuk pendaftar berstatus <b>Diterima</b>. Status pendaftar ini saat ini: <b>" . htmlspecialchars($siswa['status_seleksi']) . "</b>.");
}

$nilai = $sawModel->getNilaiByPendaftarId($id);

$tahun_ini = date('Y');
$nomor_surat = '421.7/' . str_pad($id, 3, '0', STR_PAD_LEFT) . '/PPDB-SMAFDB/' . $tahun_ini;

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
    <title>Surat Keterangan Lulus Seleksi - <?php echo htmlspecialchars($siswa['nama_lengkap']); ?></title>
    <style>
        body { font-family: "Times New Roman", Times, serif; margin: 50px; color: #000; font-size: 12pt; line-height: 1.6; }

        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 25px; text-align: center; position: relative; }
        .kop-surat img { height: 90px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 13px; font-style: italic; }

        .judul { text-align: center; margin: 20px 0 5px 0; font-weight: bold; text-decoration: underline; text-transform: uppercase; font-size: 15px; }
        .nomor { text-align: center; margin-bottom: 25px; font-size: 12pt; }

        table.biodata { margin: 15px 0 20px 40px; width: 85%; }
        table.biodata td { padding: 3px 5px; vertical-align: top; }
        table.biodata td.label { width: 220px; }

        .isi p { text-align: justify; margin-bottom: 12px; }
        .status-diterima { font-weight: bold; text-decoration: underline; }

        .ttd-wrapper { margin-top: 50px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 280px; }

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

    <div class="judul">Surat Keterangan Hasil Seleksi PPDB</div>
    <div class="nomor">Nomor: <?php echo $nomor_surat; ?></div>

    <div class="isi">
        <p>Yang bertanda tangan di bawah ini, Ketua Panitia Penerimaan Peserta Didik Baru (PPDB) SMA Frater Don Bosco Banjarmasin Tahun Ajaran <?php echo $tahun_ini . '/' . ($tahun_ini + 1); ?>, dengan ini menerangkan bahwa:</p>

        <table class="biodata">
            <tr><td class="label">Nama Lengkap</td><td>: <b><?php echo htmlspecialchars($siswa['nama_lengkap']); ?></b></td></tr>
            <tr><td class="label">NISN</td><td>: <?php echo htmlspecialchars($siswa['nisn']); ?></td></tr>
            <tr><td class="label">No. Registrasi</td><td>: <?php echo htmlspecialchars($siswa['no_registrasi']); ?></td></tr>
            <tr><td class="label">Tempat, Tanggal Lahir</td><td>: <?php echo htmlspecialchars($siswa['tempat_lahir']) . ', ' . tgl_indo($siswa['tanggal_lahir']); ?></td></tr>
            <tr><td class="label">Asal Sekolah</td><td>: <?php echo htmlspecialchars($siswa['nama_sekolah_asal']); ?></td></tr>
            <?php if ($nilai): ?>
            <tr><td class="label">Nilai Akhir Seleksi</td><td>: <?php echo number_format($nilai['nilai_akhir_saw'], 4); ?></td></tr>
            <tr><td class="label">Peringkat</td><td>: <?php echo $nilai['peringkat'] ? '#' . $nilai['peringkat'] : '-'; ?></td></tr>
            <?php endif; ?>
        </table>

        <p>Berdasarkan hasil proses seleksi Penerimaan Peserta Didik Baru yang telah dilaksanakan menggunakan metode <i>Simple Additive Weighting</i> (SAW), dengan ini dinyatakan <span class="status-diterima">DITERIMA</span> sebagai peserta didik baru SMA Frater Don Bosco Banjarmasin Tahun Ajaran <?php echo $tahun_ini . '/' . ($tahun_ini + 1); ?>.</p>

        <p>Peserta didik yang bersangkutan diwajibkan untuk melakukan daftar ulang sesuai dengan jadwal dan ketentuan yang telah ditetapkan oleh pihak sekolah. Apabila hingga batas waktu yang ditentukan belum melakukan daftar ulang, maka status penerimaan dapat dibatalkan dan digantikan oleh peserta cadangan.</p>

        <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
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