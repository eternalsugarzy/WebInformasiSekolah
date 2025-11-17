<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Profil Sekolah</li>
                </ul>
                <h1 class="white-text">Tentang SMA Frater Don Bosco Bjm</h1>
            </div>
        </div>
    </div>
</div>

<div id="about-school" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="section-header">
                    <h2>Sejarah Sekolah</h2>
                </div>
                <p><?php echo htmlspecialchars($data_profil['sejarah'] ?? 'Data sejarah belum diatur.'); ?></p>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="section-header">
                            <h2>Visi</h2>
                        </div>
                        <blockquote class="blockquote-visi">
                            <p>"<?php echo htmlspecialchars($data_profil['visi'] ?? 'Visi belum diatur.'); ?>"</p>
                        </blockquote>
                    </div>

                    <div class="col-md-6">
                        <div class="section-header">
                            <h2>Misi</h2>
                        </div>
                        <ul class="list-style-misi">
                            <?php 
                            if (!empty($data_profil['misi'])) {
                                foreach ($data_profil['misi'] as $misi) {
                                    echo '<li><i class="fa fa-check"></i> ' . htmlspecialchars($misi) . '</li>';
                                }
                            } else {
                                echo '<li><i class="fa fa-info-circle"></i> Misi belum diatur.</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <div class="section-header">
                    <h2>Fasilitas Utama</h2>
                </div>
                <ul class="list-style-fasilitas">
                    <?php 
                    if (!empty($data_profil['fasilitas'])) {
                        foreach ($data_profil['fasilitas'] as $fasilitas) {
                            echo '<div class="col-md-3"><li><i class="fa fa-building-o"></i> ' . htmlspecialchars($fasilitas) . '</li></div>';
                        }
                    } else {
                        echo '<div class="col-md-12"><li><i class="fa fa-info-circle"></i> Data fasilitas belum diatur.</li></div>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>