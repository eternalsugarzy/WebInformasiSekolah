
<div class="hero-area section" style="height: 40vh; min-height: 300px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background1.png)"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <img src="./img/logo.png" alt="Logo SMA Frater Don Bosco Bjm" class="logo-header-berita"
                    style="max-height: 80px; margin-bottom: 15px;">
                <h1 class="white-text">Hubungi Kami</h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Konta</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="contact" class="section">
    <div class="container">
        <div class="row">
            
            <div class="col-md-5 col-md-offset-1">
                <div class="section-header">
                    <h2>Informasi Kontak</h2>
                    <p class="lead">Silakan hubungi kami melalui informasi di bawah ini atau kirimkan pesan melalui formulir di samping.</p>
                </div>

                <ul class="contact-details">
                    <li><i class="fa fa-map-marker"></i> <?php echo htmlspecialchars($data_kontak['alamat'] ?? 'Alamat belum diatur.'); ?></li>
                    <li><i class="fa fa-phone"></i> <?php echo htmlspecialchars($data_kontak['telepon'] ?? 'Telepon belum diatur.'); ?></li>
                    <li><i class="fa fa-envelope"></i> <?php echo htmlspecialchars($data_kontak['email'] ?? 'Email belum diatur.'); ?></li>
                    <li><i class="fa fa-clock-o"></i> <?php echo htmlspecialchars($data_kontak['jam_kerja'] ?? 'Jam kerja belum diatur.'); ?></li>
                </ul>
            </div>

            <div class="col-md-5">
                <div class="contact-form">
                    <form action="contact.php?action=submit" method="POST"> <input class="input" type="text" name="nama" placeholder="Nama Anda" required>
                        <input class="input" type="email" name="email" placeholder="Email Anda" required>
                        <input class="input" type="text" name="subjek" placeholder="Subjek Pesan" required>
                        <textarea class="input" name="pesan" placeholder="Isi Pesan Anda" required></textarea>
                        <button class="main-button icon-button pull-right">Kirim Pesan</button>
                    </form>
                </div>
            </div>

        </div>
        
        <hr class="section-hr">
        
        <div class="row">
             <div class="col-md-12">
                 <div id="map">
                     <iframe 
                         src="https://maps.google.com/maps?q=<?php echo urlencode($data_kontak['alamat']); ?>&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                         width="100%" 
                         height="450" 
                         frameborder="0" 
                         style="border:0" 
                         allowfullscreen="" 
                         aria-hidden="false" 
                         tabindex="0">
                     </iframe>
                 </div>
             </div>
        </div>
    </div>
</div>