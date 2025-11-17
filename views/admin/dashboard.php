<?php 
// Memanggil Bagian-bagian Template
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" style="border-left: 4px solid #FF6700; background: #fff; color: #555;">
                    Selamat Datang di Panel Administrator SMA Frater Don Bosco. Anda login sebagai <b><?php echo $_SESSION['admin_level']; ?></b>.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stat-card card-orange">
                    <div class="stat-content">
                        <h3><?php echo $total_berita; ?></h3> 
                        <p>Total Berita</p>
                        <a href="berita.php" style="font-size:11px; color:#FF6700; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card card-blue">
                    <div class="stat-content">
                        <h3><?php echo $total_pengumuman; ?></h3>
                        <p>Pengumuman</p>
                        <a href="pengumuman.php" style="font-size:11px; color:#374050; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-bullhorn"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card card-green">
                    <div class="stat-content">
                        <h3><?php echo $total_guru; ?></h3>
                        <p>Data Guru</p>
                        <a href="#" style="font-size:11px; color:#2ecc71; font-weight:bold; text-decoration:none;">KELOLA DATA &rarr;</a>
                    </div>
                    <div class="stat-icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div style="background: #fff; padding: 30px; border-radius: 8px; text-align:center; color:#aaa; border: 2px dashed #eee;">
                    <i class="fa fa-bar-chart" style="font-size: 50px; margin-bottom: 10px;"></i>
                    <p>Area Statistik Pengunjung (Coming Soon)</p>
                </div>
            </div>
        </div>

    </div>
    </div>
<?php require_once 'template/footer.php'; ?>