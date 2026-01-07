<?php
// Pastikan variabel dari Controller disiapkan
$data_guru = $data_guru ?? [];
$current_keyword = $current_keyword ?? '';
$data_pagination = $data_pagination ?? ['total_halaman' => 1, 'halaman_aktif' => 1];
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

        
        /* ======================================= */
        /* Tambahan CSS untuk Tampilan Tabel */
        /* ======================================= */

        /* Tambahkan di dalam <style> */
        .img-teacher-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            /* Gunakan 50% jika ingin foto bulat */
            border: 1px solid #ddd;
        }

        .teacher-table {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .teacher-table th,
        .teacher-table td {
            padding: 12px 15px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .teacher-table th {
            background-color: #f8f9fa;
            /* Header Abu-abu Muda */
            color: #333;
            font-weight: 700;
            border-bottom: 2px solid #dee2e6;
        }

        .teacher-table tr:nth-child(even) {
            background-color: #fbfbfb;
            /* Warna zebra striping */
        }

        /* Styling Baris saat Hover */
        .teacher-table tr:hover {
            background-color: #e9ecef;
        }

        .pagination>li>a,
        .pagination>li>span {
            border-radius: 5px;
            /* Sesuaikan dengan gambar pagination */
            margin: 0 2px;
        }

        .pagination>.active>a,
        .pagination>.active>span {
            background-color: #007bff;
            /* Warna biru, seperti di gambar */
            border-color: #007bff;
            color: white;
        }

        .main-button {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        /* Lokasi: <style> di views/detail_guru.php */
        .full-staff-photo {
            margin-bottom: 30px;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .full-staff-photo img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="hero-area section" style="height: 43vh; min-height: 280px;">
        <div class="bg-image bg-parallax overlay" style="background-image:url('./img/page-background2.jpg')"></div>
        <div class="container" style="margin-top: 40px;">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <img src="./img/logo2.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                        style="max-height: 120px;">
                    <h1 class="white-text">Direktori Lengkap Guru dan Staf</h1>
                    <ul class="hero-area-tree">
                        <li><a href="index.php">Beranda</a></li>
                        <li> / </li>
                        <li>Guru dan Staf</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="teachers" class="section" style="padding: 0px 0;">
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <div class="full-staff-photo">
                        <img src="./img/page-background-guru.jpg" alt="Foto Seluruh Guru dan Staf">
                    </div>
                </div>

                <div class="site-heading text-center" style="margin-bottom: 40px;">
                    <h2>Pendidik dan Tenaga Kependidikan</h2>
                </div>

                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-md-8 col-md-offset-2">
                        <form action="detail_guru.php" method="GET" class="form-horizontal">
                            <div class="input-group">
                                <input type="text" name="cari" class="form-control"
                                    placeholder="Cari Guru berdasarkan Nama, Jabatan, atau Mata Pelajaran..."
                                    value="<?php echo htmlspecialchars($current_keyword); ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary main-button" type="submit"
                                        style="height: 40px; line-height: 25px;">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <?php
                        if (count($data_guru) > 0) {
                            // Hitung nomor awal
                            $no = (($data_pagination['halaman_aktif'] - 1) * 10) + 1;
                            ?>

                            <table class="teacher-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Mata Pelajaran</th>
                                        <th>NIP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_guru as $guru): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <?php
                                                // Logika pengecekan foto
                                                $foto_path = "admin/uploads/guru/" . ($guru['foto'] ?? '');
                                                if (!empty($guru['foto']) && file_exists($foto_path)) {
                                                    $src = $foto_path;
                                                } else {
                                                    $src = "img/default-avatar.png"; // Siapkan foto default jika kosong
                                                }
                                                ?>
                                                <img src="<?php echo $src; ?>" class="img-teacher-thumb"
                                                    alt="Foto <?php echo $guru['nama_lengkap']; ?>">
                                            </td>
                                            <td><?php echo htmlspecialchars($guru['nama_lengkap'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($guru['jabatan'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($guru['bidang_studi'] ?? ''); ?></td>
                                            <td><?php echo htmlspecialchars($guru['nip'] ?? '-'); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <?php
                        } else {
                            $message = !empty($current_keyword)
                                ? "Data guru tidak ditemukan untuk pencarian '{$current_keyword}'."
                                : "Data guru dan staf belum tersedia.";

                            echo "<div class='text-center'><h3>{$message}</h3></div>";
                        }
                        ?>

                        <?php if ($data_pagination['total_halaman'] > 1):
                            $halaman_aktif = $data_pagination['halaman_aktif'];
                            $total_halaman = $data_pagination['total_halaman'];
                            $keyword_query = !empty($current_keyword) ? '&cari=' . urlencode($current_keyword) : '';
                            ?>
                            <div class="row">
                                <div class="col-md-12 text-center" style="margin-top: 30px;">
                                    <ul class="pagination">

                                        <li class="<?php echo ($halaman_aktif <= 1) ? 'disabled' : ''; ?>">
                                            <a href="detail_guru.php?halaman=<?php echo $halaman_aktif - 1; ?><?php echo $keyword_query; ?>"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <?php
                                        // Logic untuk menampilkan halaman di sekitar halaman aktif (maks 5 tombol)
                                        $start = max(1, $halaman_aktif - 2);
                                        $end = min($total_halaman, $halaman_aktif + 2);

                                        // Jika range terlalu sempit di awal, lebarkan ke kanan
                                        if ($start == 1 && $total_halaman > 5) {
                                            $end = min($total_halaman, 5);
                                        }
                                        // Jika range terlalu sempit di akhir, lebarkan ke kiri
                                        if ($end == $total_halaman && $total_halaman > 5) {
                                            $start = max(1, $total_halaman - 4);
                                        }

                                        for ($i = $start; $i <= $end; $i++):
                                            ?>
                                            <li class="<?php echo ($i == $halaman_aktif) ? 'active' : ''; ?>">
                                                <a
                                                    href="detail_guru.php?halaman=<?php echo $i; ?><?php echo $keyword_query; ?>">
                                                    <?php echo $i; ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>

                                        <li class="<?php echo ($halaman_aktif >= $total_halaman) ? 'disabled' : ''; ?>">
                                            <a href="detail_guru.php?halaman=<?php echo $halaman_aktif + 1; ?><?php echo $keyword_query; ?>"
                                                aria-label="Next">
                                                <span aria-hidden="true">Next</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>