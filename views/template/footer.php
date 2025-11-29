<style>
        /* Layout Utama Footer */
        #footer {
            background-color: #0b102b; /* Biru Sangat Gelap */
            color: #aab6d3; /* Teks Abu Kebiruan */
            padding-top: 60px;
            font-size: 14px;
            position: relative;
            border-top: 5px solid #FF6700; /* Aksen Garis Oranye */
            margin-top: auto; /* Agar footer selalu di bawah */
        }

        /* Judul Kolom */
        .footer-title {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 25px;
            text-transform: uppercase;
            border-left: 3px solid #FF6700;
            padding-left: 10px;
            letter-spacing: 1px;
        }

        /* Logo & Deskripsi */
        .footer-logo img {
            max-height: 55px;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .footer-desc {
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* Link Navigasi */
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { 
            margin-bottom: 10px; 
            border-bottom: 1px solid rgba(255,255,255,0.05); 
            padding-bottom: 8px; 
        }
        .footer-links li:last-child { border-bottom: none; }
        
        .footer-links a { 
            color: #aab6d3; 
            text-decoration: none; 
            transition: 0.3s; 
            display: block; 
        }
        .footer-links a:hover { 
            color: #FF6700; 
            padding-left: 5px; 
        }
        .footer-links i { 
            color: #FF6700; 
            margin-right: 10px; 
            font-size: 12px; 
        }

        /* Kontak List */
        .footer-contact li { display: flex; margin-bottom: 15px; align-items: flex-start; border: none; padding: 0; }
        .footer-contact i { color: #FF6700; margin-right: 12px; font-size: 16px; margin-top: 3px; flex-shrink: 0; }

        /* Social Icons */
        .sub-title-footer { color: #fff; font-weight: 700; margin-bottom: 10px; font-size: 14px; margin-top: 10px; }
        .social-icons a {
            display: inline-flex; width: 32px; height: 32px; background: rgba(255,255,255,0.1);
            color: #fff; border-radius: 50%; margin-right: 5px; align-items: center; justify-content: center; 
            transition: 0.3s; text-decoration: none; border: 1px solid rgba(255,255,255,0.1);
        }
        .social-icons a:hover { background: #FF6700; border-color: #FF6700; transform: translateY(-3px); }

        /* Copyright */
        .footer-copyright {
            background-color: #070a1b; padding: 20px 0; margin-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.05); font-size: 12px;
        }
    </style>

    <footer id="footer">
        <div class="container">
            <div class="row">
                
                <div class="col-md-4 col-sm-12">
                    <div class="footer-logo">
                        <img src="./img/logo.png" alt="Logo Sekolah">
                    </div>
                    <p class="footer-desc">
                        Membangun generasi cerdas, berkarakter, dan beriman untuk masa depan yang lebih baik bersama SMA Frater Don Bosco Banjarmasin.
                    </p>
                    
                    <h5 class="sub-title-footer">Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/groups/274628445896269/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="https://x.com/DonBosco_bjm" target="_blank" title="X (Twitter)"><i class="fa fa-twitter"></i></a>
                        <a href="https://www.instagram.com/official_donboscobjm/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@donboscotv4430" target="_blank" title="YouTube"><i class="fa fa-youtube-play"></i></a>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <h4 class="footer-title">Tautan Cepat</h4>
                    <ul class="footer-links">
                        <li><a href="index.php"><i class="fa fa-angle-right"></i> Beranda</a></li>
                        <li><a href="profil.php"><i class="fa fa-angle-right"></i> Profil Sekolah</a></li>
                        <li><a href="berita.php"><i class="fa fa-angle-right"></i> Berita & Info</a></li>
                        <li><a href="ppdb.php"><i class="fa fa-angle-right"></i> Info PPDB</a></li>
                        <li><a href="galeri.php"><i class="fa fa-angle-right"></i> Galeri Foto</a></li>
                        <li><a href="index.php#contact"><i class="fa fa-angle-right"></i> Kontak Kami</a></li>
                    </ul>
                </div>

                <div class="col-md-4 col-sm-6">
                    <h4 class="footer-title">Hubungi Kami</h4>
                    <ul class="footer-links footer-contact">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <span>Jl. Rantauan Darat No.24, Pekauman,<br>Kec. Banjarmasin Sel., Kota Banjarmasin,<br>Kalimantan Selatan 70246</span>
                        </li>
                        <li><i class="fa fa-phone"></i> (0511) 1234567</li>
                        <li><i class="fa fa-envelope"></i> info@smafraterdb.sch.id</li>
                        <li><i class="fa fa-clock-o"></i> Senin - Jumat: 07:00 - 15:00</li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        © <?php echo date('Y'); ?> <b>SMA Frater Don Bosco</b>. All Rights Reserved.
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="admin/login.php" target="_blank" style="color: #555; text-decoration: none; transition: 0.3s;">
                            <i class="fa fa-lock"></i> Admin Panel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id='preloader'><div class='preloader'></div></div>
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>