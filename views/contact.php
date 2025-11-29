<style>
    /* Karena Hero Area dihapus, kita perlu memberi jarak atas agar tidak tertutup Navbar Fixed */
    #contact {
        padding-top: 120px; /* Jarak dari atas agar pas di bawah navbar */
        padding-bottom: 80px;
        background-color: #fff;
    }

    .section-header h2 {
        color: #001f3f;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 0;
    }

    /* Styling Peta */
    .map-title {
        font-size: 20px;
        font-weight: 700;
        color: #001f3f;
        margin-bottom: 15px;
        border-left: 5px solid #FF6700;
        padding-left: 15px;
    }
    
    .map-wrapper {
        height: 100%;
        min-height: 350px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #ddd;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    /* Styling Info Kontak */
    .contact-info-box {
        background: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        height: 100%;
    }
    
    .contact-details li {
        display: flex;
        margin-bottom: 20px;
        align-items: flex-start;
        font-size: 15px;
        color: #555;
    }
    .contact-details i {
        color: #FF6700;
        font-size: 22px;
        margin-right: 15px;
        width: 30px;
        text-align: center;
        flex-shrink: 0;
        margin-top: 3px;
    }
    .contact-details strong {
        display: block;
        color: #333;
        font-size: 16px;
        margin-bottom: 2px;
    }

    /* Styling Form Full Width */
    .contact-form-wrapper {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: 1px solid #eee;
        margin-top: 40px;
    }
    .form-header {
        margin-bottom: 30px;
        text-align: center;
    }
    .form-header h3 {
        font-weight: 700;
        color: #001f3f;
    }
    
    /* Input Style */
    .input {
        width: 100%;
        height: 50px;
        padding: 0 20px;
        border: 1px solid #e1e1e1;
        border-radius: 4px;
        margin-bottom: 20px;
        background: #fdfdfd;
    }
    textarea.input {
        height: 150px;
        padding: 15px 20px;
        resize: vertical;
    }
    .input:focus {
        border-color: #FF6700;
        outline: none;
    }
</style>

<div id="contact" class="section">
    <div class="container">
        
        <div class="row display-flex">
            
            <div class="col-md-5">
                <div class="contact-info-box">
                    <div class="section-header">
                        <h2>Hubungi Kami</h2>
                        <p>Silakan hubungi kami melalui informasi di bawah ini.</p>
                    </div>

                    <ul class="contact-details">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <div>
                                <strong>Alamat:</strong>
                                <?php echo htmlspecialchars($data_kontak['alamat'] ?? 'Jl. Rantauan Darat No.24, Pekauman, Kec. Banjarmasin Sel., Kota Banjarmasin, Kalimantan Selatan 70246'); ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i>
                            <div>
                                <strong>Telepon:</strong>
                                <?php echo htmlspecialchars($data_kontak['telepon'] ?? '(0511) 1234567'); ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <div>
                                <strong>Email:</strong>
                                <?php echo htmlspecialchars($data_kontak['email'] ?? 'info@smafraterdb.sch.id'); ?>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <div>
                                <strong>Jam Operasional:</strong>
                                Senin - Jumat: 07:00 - 15:00
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-7">
                <h3 class="map-title">Denah Lokasi</h3>
                
                <div class="map-wrapper">
                     <iframe 
                         src="https://maps.google.com/maps?q=-3.3318552,114.5875468&hl=id&z=17&output=embed" 
                         width="100%" 
                         height="100%" 
                         frameborder="0" 
                         style="border:0;" 
                         allowfullscreen="" 
                         loading="lazy">
                     </iframe>
                </div>
            </div>

        </div>
        
        <div class="row">
            <div class="col-md-12"> <div class="contact-form-wrapper">
                    <div class="form-header">
                        <h3>Kirim Pesan / Pertanyaan</h3>
                        <p class="text-muted">Isi formulir di bawah ini untuk mengirim pesan langsung kepada kami.</p>
                    </div>

                    <form action="contact.php?action=submit" method="POST"> 
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="input" type="text" name="nama" placeholder="Masukkan Nama" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="input" type="email" name="email" placeholder="Masukkan Email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Subjek</label>
                                    <input class="input" type="text" name="subjek" placeholder="Judul Pesan" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Isi Pesan</label>
                            <textarea class="input" name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                        
                        <div class="text-right">
                            <button class="main-button icon-button" style="background-color: #FF6700; color: white; border:none; padding: 15px 40px; border-radius: 50px; font-weight: bold; font-size: 16px;">
                                <i class="fa fa-paper-plane"></i> KIRIM PESAN
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>