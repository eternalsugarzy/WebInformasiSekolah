<?php
session_start();
if (!isset($_SESSION['user_admin'])) { header("Location: login.php"); exit; }

require_once '../models/GaleriModel.php';
$model = new GaleriModel();
$data = $model->getAllGaleri();

require_once '../models/GuruModel.php';
$guruModel = new GuruModel();
$kepsek = $guruModel->getKepalaSekolah();

$nama_kepsek = !empty($kepsek['nama_lengkap']) ? $kepsek['nama_lengkap'] : '( ...Belum diinput... )';
$nip_kepsek  = !empty($kepsek['nip']) ? $kepsek['nip'] : '-';

function tgl_indo($tanggal){
    $bulan = array(
        1=>'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

/**
 * Konversi gambar ke base64.
 * Nama file bisa dari kolom cover_foto (galeri_fotos) atau file_path (galeri_media).
 * File fisik ada di: admin/uploads/galeri/namafile.png
 */
function imageToBase64($filename) {
    if (empty($filename)) return null;

    $file_name = basename($filename);
    $abs_path  = __DIR__ . "/uploads/galeri/" . $file_name;

    if (!file_exists($abs_path)) return null;

    $mime    = mime_content_type($abs_path);
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $allowed)) return null;

    $binary = file_get_contents($abs_path);
    if ($binary === false) return null;

    return 'data:' . $mime . ';base64,' . base64_encode($binary);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Galeri</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; margin: 40px; color: #000; }

        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; position: relative; }
        .kop-surat img.logo { height: 80px; position: absolute; left: 10px; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 22px; font-weight: bold; text-transform: uppercase; }
        .kop-surat h4 { margin: 5px 0; font-size: 16px; font-weight: normal; }
        .kop-surat p  { margin: 0; font-size: 13px; font-style: italic; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 10px; text-align: left; font-size: 12px; vertical-align: middle; }
        th { background-color: #eee; text-align: center; font-weight: bold; }

        img.bukti-foto {
            width: 120px;
            height: 90px;
            object-fit: cover;
            display: block;
            margin: 0 auto;
            border: 1px solid #ccc;
        }

        .ttd { width: 100%; margin-top: 50px; display: flex; justify-content: flex-end; }
        .ttd-box { width: 280px; text-align: center; }

        @media print {
            @page { size: A4; margin: 2cm; }
            body { margin: 0; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            img { display: block !important; max-width: 100% !important; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="kop-surat">
        <?php
        $logo_abs = __DIR__ . "/../img/logo.png";
        if (file_exists($logo_abs)) {
            $logo_b64 = 'data:' . mime_content_type($logo_abs) . ';base64,' . base64_encode(file_get_contents($logo_abs));
            echo '<img class="logo" src="' . $logo_b64 . '" alt="Logo">';
        }
        ?>
        <h2>SMA FRATER DON BOSCO</h2>
        <h4>Laporan Dokumentasi &amp; Galeri Kegiatan</h4>
        <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
    </div>

    <h3 style="text-align:center; text-decoration:underline;">INVENTARIS DOKUMENTASI SEKOLAH</h3>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="18%">Bukti Foto</th>
                <th width="20%">Nama Kegiatan / Album</th>
                <th>Deskripsi Singkat</th>
                <th width="13%">Tgl Pelaksanaan</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        if (count($data) > 0):
            foreach ($data as $d):
                // PERBAIKAN: Prioritaskan cover_foto (dari galeri_fotos),
                // fallback ke file_path (dari galeri_media) jika ada
                $sumber_foto = !empty($d['cover_foto']) ? $d['cover_foto'] : ($d['file_path'] ?? null);
                $img_src = imageToBase64($sumber_foto);
        ?>
            <tr>
                <td style="text-align:center;"><?php echo $no++; ?></td>
                <td style="text-align:center; padding:5px;">
                    <?php if ($img_src): ?>
                        <img class="bukti-foto" src="<?php echo $img_src; ?>" alt="Foto">
                    <?php else: ?>
                        <span style="font-size:10px; color:#999;">(Tidak ada foto)</span>
                    <?php endif; ?>
                </td>
                <td><b><?php echo htmlspecialchars($d['judul_album']); ?></b></td>
                <td><?php echo htmlspecialchars($d['deskripsi']); ?></td>
                <td style="text-align:center;">
                    <?php echo tgl_indo(date('Y-m-d', strtotime($d['tanggal_event']))); ?>
                </td>
            </tr>
        <?php
            endforeach;
        else:
            echo "<tr><td colspan='5' style='text-align:center; padding:20px;'>Belum ada data dokumentasi.</td></tr>";
        endif;
        ?>
        </tbody>
    </table>

    <div class="ttd">
        <div class="ttd-box">
            <p>Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?></p>
            <p>Kepala Sekolah</p>
            <br><br><br><br>
            <p style="text-decoration:underline; font-weight:bold;">
                <?php echo htmlspecialchars($nama_kepsek); ?>
            </p>
            <p>NIP. <?php echo htmlspecialchars($nip_kepsek); ?></p>
        </div>
    </div>

</body>
</html>