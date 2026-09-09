<?php
session_start();
// 1. Cek Login
if (!isset($_SESSION['user_admin'])) {
    header("Location: login.php");
    exit;
}

require_once '../models/HistoriSawModel.php';
$model = new HistoriSawModel();

$filters = [
    'jenis'  => isset($_GET['jenis']) ? $_GET['jenis'] : '',
    'dari'   => isset($_GET['dari']) ? $_GET['dari'] : '',
    'sampai' => isset($_GET['sampai']) ? $_GET['sampai'] : '',
];

$histori = $model->getHistori($filters);

// Ubah JSON data_lama/data_baru jadi teks "Key: nilai; Key2: nilai2" yang mudah dibaca
function format_snapshot($json) {
    if ($json === null || $json === '') return '-';
    $decoded = json_decode($json, true);
    if (!is_array($decoded)) return htmlspecialchars($json);

    $parts = [];
    foreach ($decoded as $key => $val) {
        $val_txt = ($val === null || $val === '') ? '-' : $val;
        $parts[] = htmlspecialchars($key) . ': ' . htmlspecialchars($val_txt);
    }
    return implode('<br>', $parts);
}

function tgl_jam_indo($datetime) {
    $bulan = array(
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
    );
    $ts = strtotime($datetime);
    return date('d', $ts) . ' ' . $bulan[(int) date('n', $ts)] . ' ' . date('Y H:i', $ts);
}

$title = "Histori Perubahan Seleksi SAW";
$nama_admin = $_SESSION['admin_nama'];

require_once '../views/admin/template/header.php';
require_once '../views/admin/template/sidebar.php';
?>

<div class="main-content">
    <?php require_once '../views/admin/template/topbar.php'; ?>

    <style>
        .print-only { display: none; }
        .kop-surat { border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 15px; text-align: center; position: relative; }
        .kop-surat img { height: 80px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 20px; text-transform: uppercase; font-weight: bold; }
        .kop-surat h4 { margin: 5px 0; font-size: 14px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 12px; font-style: italic; }

        .jenis-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; color: #fff; }
        .jenis-Bobot-SAW { background: #374050; }
        .jenis-Nilai-Pendaftar { background: #FF6700; }
        .jenis-Kuota-Kelulusan { background: #2ecc71; }
        .jenis-Status-Manual { background: #d9534f; }
        .jenis-Daftar-Ulang { background: #8e44ad; }

        table.histori-table { width: 100%; border-collapse: collapse; }
        table.histori-table th, table.histori-table td { border: 1px solid #e2e2e2; padding: 8px 10px; font-size: 13px; vertical-align: top; }
        table.histori-table th { background: #f5f6fa; text-align: left; }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            .admin-sidebar, .toggle-sidebar-btn, .admin-header { display: none !important; }
            .main-content { margin-left: 0 !important; padding: 0 !important; }
            .content-wrapper { padding: 0 !important; }
            .card-box { box-shadow: none !important; padding: 0 !important; }
            body { background: #fff !important; }
            @page { size: A4 landscape; margin: 1.5cm; }
        }
    </style>

    <div class="content-wrapper">
        <div class="card-box">

            <!-- Kop Surat (hanya tampil saat dicetak) -->
            <div class="print-only kop-surat">
                <img src="../img/logo.png" onerror="this.style.display='none'">
                <h2>SMA FRATER DON BOSCO</h2>
                <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</h4>
                <p>Jl. Tugu Pahlawan No. 123, Banjarmasin | Telp: (0511) 1234567</p>
            </div>
            <div class="print-only" style="text-align:center; font-weight:bold; text-decoration:underline; text-transform:uppercase; margin-bottom:20px;">
                Histori Perubahan Parameter Seleksi SAW
            </div>

            <div class="row no-print" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <h4><i class="fa fa-history"></i> Histori Perubahan Seleksi SAW</h4>
                    <p style="color:#888;">Jejak audit: siapa mengubah bobot SAW, nilai pendaftar, kuota kelulusan, atau status kelulusan manual — dan kapan. Berguna saat sidang kelulusan agar setiap perubahan bisa dipertanggungjawabkan.</p>
                </div>
            </div>

            <form action="histori_saw.php" method="GET" class="row no-print" style="margin-bottom: 20px; align-items:flex-end;">
                <div class="col-md-3">
                    <label style="font-size:12px; font-weight:600;">Jenis Perubahan</label>
                    <select name="jenis" class="form-control">
                        <option value="">-- Semua Jenis --</option>
                        <?php foreach (HistoriSawModel::JENIS_LIST as $j): ?>
                            <option value="<?php echo htmlspecialchars($j); ?>" <?php echo ($filters['jenis'] === $j) ? 'selected' : ''; ?>><?php echo htmlspecialchars($j); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label style="font-size:12px; font-weight:600;">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="<?php echo htmlspecialchars($filters['dari']); ?>">
                </div>
                <div class="col-md-3">
                    <label style="font-size:12px; font-weight:600;">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="<?php echo htmlspecialchars($filters['sampai']); ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-orange"><i class="fa fa-filter"></i> Terapkan</button>
                    <button type="button" class="btn btn-success" onclick="window.print()"><i class="fa fa-print"></i> Cetak</button>
                </div>
            </form>

            <?php if (count($histori) === 0): ?>
                <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Belum ada histori perubahan untuk filter ini.</div>
            <?php else: ?>
                <div style="overflow-x:auto;">
                <table class="histori-table">
                    <thead>
                        <tr>
                            <th style="width:30px;">No</th>
                            <th>Waktu</th>
                            <th>Diubah Oleh</th>
                            <th>Jenis</th>
                            <th>Keterangan</th>
                            <th>Nilai Lama</th>
                            <th>Nilai Baru</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($histori as $h): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo tgl_jam_indo($h['waktu_perubahan']); ?></td>
                            <td><?php echo htmlspecialchars($h['nama_admin']); ?></td>
                            <td><span class="jenis-badge jenis-<?php echo str_replace(' ', '-', $h['jenis_perubahan']); ?>"><?php echo htmlspecialchars($h['jenis_perubahan']); ?></span></td>
                            <td><?php echo htmlspecialchars($h['keterangan']); ?></td>
                            <td><?php echo format_snapshot($h['data_lama']); ?></td>
                            <td><?php echo format_snapshot($h['data_baru']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>

                <p style="color:#888; font-size:12px; margin-top:15px;">Total <?php echo count($histori); ?> perubahan tercatat.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php require_once '../views/admin/template/footer.php'; ?>
