<?php
// views/prestasi.php -- Halaman publik Siswa Berprestasi
$ikon_tingkat = [
    'Internasional' => 'fa-globe', 'Nasional' => 'fa-flag', 'Provinsi' => 'fa-map',
    'Kabupaten/Kota' => 'fa-building', 'Kecamatan' => 'fa-map-marker', 'Sekolah' => 'fa-graduation-cap',
];
?>
<style>
    .prestasi-page { padding: 40px 0 60px; background: #f7f9fc; }
    .ringkas-wrap { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-bottom: 30px; }
    .ringkas-item { background: #fff; border-radius: 10px; padding: 14px 18px; min-width: 130px; text-align: center; box-shadow: 0 3px 10px rgba(0,0,0,0.06); }
    .ringkas-item .angka { font-size: 26px; font-weight: 700; color: #FF6700; line-height: 1.1; }
    .ringkas-item .label-t { font-size: 13px; color: #555; }
    .ringkas-item.utama { background: #001f3f; }
    .ringkas-item.utama .angka, .ringkas-item.utama .label-t { color: #fff; }
    .filter-prestasi { background: #fff; border-radius: 10px; padding: 15px; margin-bottom: 25px; box-shadow: 0 3px 10px rgba(0,0,0,0.06); }
    .filter-prestasi .form-control { margin-bottom: 8px; }
    .kartu-prestasi { background: #fff; border-radius: 12px; padding: 18px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.07);
                      border-left: 5px solid #FF6700; min-height: 170px; }
    .kartu-prestasi .tingkat { display: inline-block; font-size: 12px; font-weight: 700; color: #fff; background: #001f3f; padding: 3px 10px; border-radius: 20px; }
    .kartu-prestasi .jenis { display: inline-block; font-size: 12px; color: #FF6700; font-weight: 600; margin-left: 6px; }
    .kartu-prestasi h4 { font-size: 16px; font-weight: 700; margin: 10px 0 6px; color: #222; }
    .kartu-prestasi .juara { font-weight: 700; color: #001f3f; }
    .kartu-prestasi .meta { font-size: 13px; color: #777; margin: 0; }
    .kartu-prestasi .siswa { font-size: 14px; margin-top: 8px; }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 370px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita" style="max-height:130px;">
                <h1 class="white-text">Siswa Berprestasi</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Prestasi</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="prestasi-page">
    <div class="container">

        <div class="ringkas-wrap">
            <div class="ringkas-item utama">
                <div class="angka"><?= $ringkasan['total']; ?></div>
                <div class="label-t">Prestasi &middot; <?= $ringkasan['jumlah_siswa']; ?> siswa</div>
            </div>
            <?php foreach ($ringkasan['per_tingkat'] as $tk => $n): if ($n == 0) continue; ?>
            <div class="ringkas-item">
                <div class="angka"><?= $n; ?></div>
                <div class="label-t"><i class="fa <?= $ikon_tingkat[$tk] ?? 'fa-trophy'; ?>"></i> <?= htmlspecialchars($tk); ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <form method="GET" action="prestasi.php" class="filter-prestasi row">
            <div class="col-md-4 col-sm-6">
                <input type="text" name="q" class="form-control" placeholder="Cari nama siswa atau prestasi..." value="<?= htmlspecialchars($filters['q']); ?>">
            </div>
            <div class="col-md-2 col-sm-6">
                <select name="tahun" class="form-control">
                    <option value="">Semua Tahun</option>
                    <?php foreach ($daftar_tahun as $th): ?>
                        <option value="<?= (int) $th; ?>" <?= ($filters['tahun'] == $th) ? 'selected' : ''; ?>><?= (int) $th; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-6">
                <select name="jenis" class="form-control">
                    <option value="">Semua Jenis</option>
                    <?php foreach (PrestasiModel::JENIS as $v): ?>
                        <option value="<?= $v; ?>" <?= ($filters['jenis'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-6">
                <select name="tingkat" class="form-control">
                    <option value="">Semua Tingkat</option>
                    <?php foreach (PrestasiModel::TINGKAT as $v): ?>
                        <option value="<?= $v; ?>" <?= ($filters['tingkat'] === $v) ? 'selected' : ''; ?>><?= $v; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-12">
                <button type="submit" class="btn btn-block" style="background:#FF6700; color:#fff; font-weight:600;"><i class="fa fa-search"></i> Tampilkan</button>
            </div>
        </form>

        <div class="row">
            <?php if (count($data_prestasi) > 0): foreach ($data_prestasi as $p): ?>
            <div class="col-md-4 col-sm-6">
                <div class="kartu-prestasi">
                    <span class="tingkat"><i class="fa <?= $ikon_tingkat[$p['tingkat']] ?? 'fa-trophy'; ?>"></i> <?= htmlspecialchars($p['tingkat']); ?></span>
                    <span class="jenis"><?= htmlspecialchars($p['jenis']); ?></span>
                    <h4><?= htmlspecialchars($p['nama_prestasi']); ?></h4>
                    <p class="meta"><span class="juara"><i class="fa fa-trophy"></i> <?= htmlspecialchars($p['peringkat']); ?></span> &middot; <?= htmlspecialchars($p['tahun']); ?></p>
                    <p class="meta"><?= htmlspecialchars($p['penyelenggara']); ?></p>
                    <div class="siswa"><i class="fa fa-user"></i> <b><?= htmlspecialchars($p['nama_lengkap']); ?></b> &middot; Kelas <?= htmlspecialchars($p['kelas']); ?></div>
                </div>
            </div>
            <?php endforeach; else: ?>
            <div class="col-md-12 text-center" style="padding: 40px 0; color:#888;">
                <i class="fa fa-trophy" style="font-size:40px;"></i>
                <p style="margin-top:10px;">Belum ada data prestasi yang dipublikasikan<?= (array_filter([$filters['q'], $filters['tahun'], $filters['jenis'], $filters['tingkat']])) ? ' untuk filter ini' : ''; ?>.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
