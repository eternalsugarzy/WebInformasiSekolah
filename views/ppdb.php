<style>
    /* Styling Tambahan */
    .status-box {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
        margin-bottom: 30px;
        border-top: 5px solid #045bb8;
    }
    .search-input {
        height: 50px;
        font-size: 18px;
        border-radius: 25px;
        padding: 0 25px;
        border: 2px solid #eee;
    }
    .btn-search {
        height: 50px;
        border-radius: 25px;
        padding: 0 30px;
        background-color: #045bb8;
        color: white;
        font-weight: bold;
        border: none;
        transition: 0.3s;
    }
    .btn-search:hover {
        background-color: #034a96;
    }
    .result-card {
        border: 1px solid #eee;
        border-left: 5px solid #ccc;
        padding: 20px;
        margin-bottom: 15px;
        background: #fff;
        text-align: left;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 5px;
    }
    
    /* Warna Status */
    .status-menunggu { border-left-color: #f0ad4e; }
    .status-diterima { border-left-color: #5cb85c; }
    .status-ditolak { border-left-color: #d9534f; }
    .status-cadangan { border-left-color: #5bc0de; }
    
    .badge-status {
        padding: 8px 15px;
        border-radius: 30px;
        color: white;
        font-weight: bold;
        font-size: 12px;
        text-transform: uppercase;
        display: inline-block;
    }
    .bg-menunggu { background-color: #f0ad4e; }
    .bg-diterima { background-color: #5cb85c; }
    .bg-ditolak { background-color: #d9534f; }
    .bg-cadangan { background-color: #5bc0de; }

    /* Form Styles */
    .form-box {
        background: #fff;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border-top: 5px solid #045bb8;
    }
    .form-section-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    .btn-submit-ppdb {
        background-color: #045bb8;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 15px 40px;
        border-radius: 30px;
        border: none;
        transition: 0.3s;
        width: 100%;
        margin-top: 20px;
    }
    .btn-submit-ppdb:hover {
        background-color: #034a96;
        cursor: pointer;
    }
    label { font-weight: 600; color: #555; }
    .form-group { margin-bottom: 20px; }
    .form-control { height: 45px; border-radius: 5px; }
</style>

<div class="hero-area section" style="height: 40vh; min-height: 350px;">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background2.jpg)"></div>
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1 class="white-text">
                    <?php echo ($mode == 'form_daftar') ? "Formulir Pendaftaran Siswa" : "Info Kelulusan & Pendaftaran"; ?>
                </h1>
                <ul class="hero-area-tree">
                    <li><a href="index.php">Beranda</a></li>
                    <li>PPDB</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="ppdb-content" class="section">
    <div class="container">

        <?php if ($mode == 'form_daftar'): ?>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-info" style="border-left: 5px solid #31708f;">
                        <h4><i class="fa fa-info-circle"></i> Petunjuk Pengisian</h4>
                        <p>Silakan isi data diri Anda dengan benar sesuai <b>Kartu Keluarga (KK)</b> dan <b>Ijazah/SKL SMP</b>. Data yang tidak valid dapat menggugurkan pendaftaran.</p>
                    </div>
                    
                    <form action="" method="POST" enctype="multipart/form-data" class="form-box">
                        <h3 class="form-section-title">Formulir Pendaftaran Online</h3>
                        
                        <div class="form-group">
                            <label>Nomor Induk Siswa Nasional (NISN) *</label>
                            <input type="number" name="nisn" class="form-control" placeholder="10 digit angka" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap (Sesuai KK) *</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir *</label>
                                    <input type="text" name="tempat_lahir" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama *</label>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap (Jalan, RT/RW, Kelurahan) *</label>
                            <textarea name="alamat_lengkap" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. HP Siswa (WhatsApp) *</label>
                                    <input type="number" name="no_hp_siswa" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email Siswa Aktif *</label>
                                    <input type="email" name="email_siswa" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nomor Kartu Keluarga (KK) *</label>
                            <input type="number" name="no_kk" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>NIK Siswa *</label>
                            <input type="number" name="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>No. Akte Lahir *</label>
                            <input type="text" name="no_akte_lahir" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>NPSN Sekolah Asal *</label>
                            <input type="number" name="npsn_smp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Sekolah Asal (SMP/MTs) *</label>
                            <input type="text" name="nama_sekolah_asal" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Provinsi *</label>
                                    <input type="text" name="provinsi_smp" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kabupaten/Kota *</label>
                                    <input type="text" name="kabupaten_smp" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kecamatan *</label>
                                    <input type="text" name="kecamatan_smp" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Upload Pas Foto 3x4 (JPG/PNG, Max 2MB) *</label>
                            <input type="file" name="foto_siswa" class="form-control" accept="image/*" required>
                            <small class="text-danger">* Gunakan foto formal berseragam.</small>
                        </div>

                        <br>
                        <button type="submit" class="btn-submit-ppdb">
                            <i class="fa fa-paper-plane"></i> KIRIM DATA PENDAFTARAN
                        </button>
                        <br><br>
                        <div class="text-center">
                            <a href="ppdb.php" class="text-muted"><i class="fa fa-arrow-left"></i> Batal & Kembali ke Cek Status</a>
                        </div>
                    </form>
                </div>
            </div>

        <?php else: ?>
            
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    
                    <div class="status-box">
                        <h2 style="margin-bottom: 20px; font-weight: bold;">Cek Status Penerimaan</h2>
                        <p class="text-muted">Masukkan <b>NISN</b>, <b>Nomor Pendaftaran</b>, atau <b>Nama Lengkap</b> Anda untuk melihat hasil seleksi.</p>
                        
                        <form action="ppdb.php" method="GET" style="margin-top: 30px;">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control search-input" placeholder="Contoh: 0012345678" value="<?php echo htmlspecialchars($keyword); ?>" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-search" type="submit"><i class="fa fa-search"></i> CEK STATUS</button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <?php if (isset($_GET['q'])): ?>
                        <div class="search-results">
                            
                            <?php if (count($hasil_cari) > 0): ?>
                                <h3 class="text-center mb-4">Hasil Pencarian: "<?php echo htmlspecialchars($keyword); ?>"</h3>
                                <?php foreach ($hasil_cari as $d): 
                                    $class = "status-" . strtolower($d['status_seleksi']);
                                    $bg = "bg-" . strtolower($d['status_seleksi']);
                                ?>
                                    <div class="result-card <?php echo $class; ?>">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-8">
                                                <h4 style="margin-top:0; font-weight: bold;"><?php echo htmlspecialchars($d['nama_lengkap']); ?></h4>
                                                <p style="margin-bottom: 5px; color: #555;">
                                                    <i class="fa fa-id-card"></i> No. Reg: <b><?php echo $d['no_registrasi']; ?></b> <br>
                                                    <i class="fa fa-user"></i> NISN: <?php echo $d['nisn']; ?>
                                                </p>
                                                <p class="text-muted"><i class="fa fa-building"></i> Asal: <?php echo $d['nama_sekolah_asal']; ?></p>
                                            </div>
                                            <div class="col-md-4 col-sm-4 text-right">
                                                <span class="badge-status <?php echo $bg; ?>">
                                                    <?php echo strtoupper($d['status_seleksi']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="alert alert-danger text-center" style="padding: 30px;">
                                    <i class="fa fa-times-circle fa-3x" style="margin-bottom: 15px;"></i>
                                    <h4>Data Tidak Ditemukan</h4>
                                    <p>Pastikan NISN atau Nama yang Anda masukkan sudah benar.</p>
                                </div>
                            <?php endif; ?>

                            <div class="text-center" style="margin-top: 25px;">
                                <a href="ppdb.php" class="btn btn-danger btn-lg" style="border-radius: 50px; font-size: 16px; padding: 10px 30px;">
                                    <i class="fa fa-refresh"></i> Reset Pencarian
                                </a>
                            </div>
                        </div>
                        <br><hr><br>
                    <?php endif; ?>

                    <div class="text-center" style="margin-top: 30px; margin-bottom: 50px;">
                        <h3>Belum mendaftar?</h3>
                        <p class="text-muted" style="margin-bottom: 20px;">Bagi calon siswa baru yang belum melakukan pendaftaran online, silakan klik tombol di bawah ini.</p>
                        <a href="ppdb.php?halaman=daftar" class="main-button icon-button" style="padding: 15px 40px; font-size: 16px;">
                            <i class="fa fa-pencil-square-o"></i> ISI FORMULIR PENDAFTARAN
                        </a>
                    </div>

                </div>
            </div>

        <?php endif; ?>

    </div>
</div>