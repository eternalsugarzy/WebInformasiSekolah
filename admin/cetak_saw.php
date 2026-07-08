<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/SawModel.php';
$model = new SawModel();
$hasil = $model->getRincianPerhitungan();
$kriteria = $hasil['kriteria'];
$mm = $hasil['minmax'];
$data = $hasil['data'];

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
    <title>Laporan Rincian Perhitungan SAW</title>
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

        h5.section-title { margin-top: 22px; margin-bottom: 8px; font-size: 12pt; font-weight: bold; background: #f2f2f2; padding: 6px 10px; border-left: 4px solid #FF6700; }

        /* Tabel Data */
        table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        table, th, td { border: 1px solid #000; }
        th { background-color: #f2f2f2; padding: 6px; text-align: center; font-weight: bold; font-size: 10pt; }
        td { padding: 5px; text-align: center; font-size: 10pt; }
        td.nama { text-align: left; font-weight: 600; }

        .keterangan { font-size: 9pt; margin-top: 5px; font-style: italic; }

        /* Tanda Tangan */
        .ttd-wrapper { margin-top: 40px; width: 100%; display: flex; justify-content: flex-end; }
        .ttd { text-align: center; width: 250px; }

        @media print {
            @page { size: A4 landscape; margin: 1.5cm; } /* Landscape agar muat banyak kolom */
            body { margin: 0; }
            h5.section-title { break-inside: avoid; }
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

    <div class="judul">Laporan Rincian Perhitungan Seleksi Metode SAW</div>
    <div class="sub-judul">(Simple Additive Weighting) &mdash; Tahun Ajaran <?php echo date('Y') . '/' . (date('Y')+1); ?></div>

    <h5 class="section-title">1. Kriteria &amp; Bobot Penilaian</h5>
    <table>
        <thead>
            <tr><th>Kode</th><th>Nama Kriteria</th><th>Tipe</th><th>Bobot (%)</th></tr>
        </thead>
        <tbody>
            <?php foreach ($kriteria as $k): ?>
            <tr>
                <td><?= htmlspecialchars($k['kode_kriteria']) ?></td>
                <td class="nama"><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                <td><?= htmlspecialchars($k['tipe']) ?></td>
                <td><?= htmlspecialchars($k['bobot']) ?>%</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p class="keterangan">* Nilai acuan normalisasi &mdash; Max C1: <?= $mm['max_c1'] ?>, Max C2: <?= $mm['max_c2'] ?>, Max C3: <?= $mm['max_c3'] ?>, Min C4: <?= $mm['min_c4'] ?></p>

    <h5 class="section-title">2. Matriks Keputusan (Nilai Asli Pendaftar)</h5>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Pendaftar</th>
                <th rowspan="2">No. Registrasi</th>
                <th colspan="4">Nilai per Kriteria</th>
            </tr>
            <tr>
                <th>C1 (Raport)</th><th>C2 (Tes)</th><th>C3 (Prestasi)</th><th>C4 (Jarak)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; if (count($data) > 0) { foreach ($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td class="nama"><?= htmlspecialchars($d['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($d['no_registrasi']) ?></td>
                <td><?= number_format($d['raw_c1'], 1) ?></td>
                <td><?= number_format($d['raw_c2'], 1) ?></td>
                <td><?= number_format($d['raw_c3'], 1) ?></td>
                <td><?= number_format($d['raw_c4'], 1) ?></td>
            </tr>
            <?php endforeach; } else { echo "<tr><td colspan='7' style='padding:20px;'>Belum ada data nilai pendaftar.</td></tr>"; } ?>
        </tbody>
    </table>

    <h5 class="section-title">3. Matriks Ternormalisasi (R) &amp; Nilai Terbobot</h5>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama Pendaftar</th>
                <th colspan="4">Normalisasi (r<sub>ij</sub>)</th>
                <th colspan="4">Terbobot (w<sub>i</sub> &times; r<sub>ij</sub>)</th>
            </tr>
            <tr>
                <th>R1</th><th>R2</th><th>R3</th><th>R4</th>
                <th>W1</th><th>W2</th><th>W3</th><th>W4</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; if (count($data) > 0) { foreach ($data as $d): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td class="nama"><?= htmlspecialchars($d['nama_lengkap']) ?></td>
                <td><?= number_format($d['r1'], 4) ?></td>
                <td><?= number_format($d['r2'], 4) ?></td>
                <td><?= number_format($d['r3'], 4) ?></td>
                <td><?= number_format($d['r4'], 4) ?></td>
                <td><?= number_format($d['wt1'], 4) ?></td>
                <td><?= number_format($d['wt2'], 4) ?></td>
                <td><?= number_format($d['wt3'], 4) ?></td>
                <td><?= number_format($d['wt4'], 4) ?></td>
            </tr>
            <?php endforeach; } else { echo "<tr><td colspan='10' style='padding:20px;'>Belum ada data nilai pendaftar.</td></tr>"; } ?>
        </tbody>
    </table>

    <h5 class="section-title">4. Hasil Akhir &amp; Peringkat</h5>
    <table>
        <thead>
            <tr><th>Peringkat</th><th>Nama Pendaftar</th><th>Nilai Akhir (V<sub>i</sub>)</th><th>Status Seleksi</th></tr>
        </thead>
        <tbody>
            <?php if (count($data) > 0) { foreach ($data as $d): ?>
            <tr>
                <td><?= $d['peringkat'] ? '#'.$d['peringkat'] : '-' ?></td>
                <td class="nama"><?= htmlspecialchars($d['nama_lengkap']) ?></td>
                <td><?= ($d['nilai_akhir_saw'] !== null) ? number_format($d['nilai_akhir_saw'], 4) : '-' ?></td>
                <td><?= strtoupper($d['status_seleksi']) ?></td>
            </tr>
            <?php endforeach; } else { echo "<tr><td colspan='4' style='padding:20px;'>Belum ada data nilai pendaftar.</td></tr>"; } ?>
        </tbody>
    </table>

    <div style="font-size: 11px; margin-top: 10px;">
        <i>* Total Pendaftar Ternilai: <?php echo count($data); ?> Siswa</i>
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