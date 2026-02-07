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
    .btn-submit-ppdb:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
    label { font-weight: 600; color: #555; }
    .form-group { margin-bottom: 20px; }
    .form-control { height: 45px; border-radius: 5px; }
    
    /* Validasi Styling */
    .validation-msg {
        font-weight: bold;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }
    .input-error {
        border-color: #d9534f !important;
        border-width: 2px !important;
    }
    .input-success {
        border-color: #5cb85c !important;
        border-width: 2px !important;
    }
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
                    
                    <form action="" method="POST" enctype="multipart/form-data" class="form-box" id="formPPDB">
                        <h3 class="form-section-title">Formulir Pendaftaran Online</h3>
                        
                        <div class="form-group">
                            <label>Nomor Induk Siswa Nasional (NISN) *</label>
                            <input type="number" name="nisn" id="nisn" class="form-control" placeholder="10 digit angka" required>
                            <small class="validation-msg" id="msg_nisn"></small>
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
                            <input type="number" name="nik" id="nik" class="form-control" placeholder="16 digit" required>
                            <small class="validation-msg" id="msg_nik"></small>
                        </div>
                        
                        <div class="form-group">
                            <label>No. Akte Lahir *</label>
                            <input type="text" name="no_akte_lahir" id="no_akte_lahir" class="form-control" required>
                            <small class="validation-msg" id="msg_akte"></small>
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
                        <button type="submit" class="btn-submit-ppdb" id="btnSubmitPPDB">
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
                
                // Catatan berdasarkan status
                $catatan = '';
                switch($d['status_seleksi']) {
                    case 'Menunggu':
                        $catatan = 'Pendaftaran Anda sedang dalam proses verifikasi oleh panitia. Harap menunggu pengumuman resmi.';
                        break;
                    case 'Diterima':
                        $catatan = 'Selamat! Anda diterima sebagai siswa baru. Silakan melakukan daftar ulang sesuai jadwal yang ditentukan.';
                        break;
                    case 'Ditolak':
                        $catatan = 'Maaf, Anda belum dapat diterima pada periode ini. Terima kasih atas partisipasi Anda.';
                        break;
                    case 'Cadangan':
                        $catatan = 'Anda masuk dalam daftar cadangan. Pantau terus pengumuman untuk kemungkinan pemanggilan berikutnya.';
                        break;
                    default:
                        $catatan = 'Status belum diperbarui.';
                }
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
                    
                    <!-- Catatan Status -->
                    <div class="row" style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ddd;">
                        <div class="col-md-12">
                            <p style="margin: 0; font-size: 14px; color: #666;">
                                <i class="fa fa-info-circle" style="color: <?php 
                                    if($d['status_seleksi'] == 'Menunggu') echo '#f0ad4e';
                                    elseif($d['status_seleksi'] == 'Diterima') echo '#5cb85c';
                                    elseif($d['status_seleksi'] == 'Ditolak') echo '#d9534f';
                                    else echo '#5bc0de';
                                ?>;"></i> 
                                <strong>Catatan:</strong> <?php echo $catatan; ?>
                            </p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    console.log('✅ jQuery loaded!');
    console.log('✅ Current page:', window.location.pathname);
    
    var isValid = {
        nisn: false,
        nik: false,
        akte: false
    };
    
    function checkAllValid() {
        if (isValid.nisn && isValid.nik && isValid.akte) {
            $('#btnSubmitPPDB').prop('disabled', false);
        } else {
            $('#btnSubmitPPDB').prop('disabled', true);
        }
    }
    
    function cekDataPPDB(selectorInput, selectorMsg, tipeKolom, validKey) {
        $(selectorInput).on('input change', function() {
            var nilai = $(this).val();
            
            console.log('🔍 Checking:', tipeKolom, '=', nilai);
            
            if(nilai == '') {
                $(selectorMsg).html('').css('color', '');
                $(selectorInput).removeClass('input-error input-success');
                isValid[validKey] = false;
                checkAllValid();
                return;
            }

            $.ajax({
                url: 'process/api_cek_data.php', // ⭐ UBAH PATH (tanpa ../)
                type: 'POST',
                data: {
                    type: tipeKolom,
                    value: nilai,
                    id: null
                },
                dataType: 'json',
                beforeSend: function() {
                    console.log('📡 Sending request to: process/api_cek_data.php');
                    $(selectorMsg).html('<i class="fa fa-spinner fa-spin"></i> Mengecek...').css('color', '#999');
                },
                success: function(response) {
                    console.log('✅ Response:', response);
                    
                    if (response.status == 'error') {
                        $(selectorMsg).html('<i class="fa fa-times-circle"></i> ' + response.message).css('color', '#d9534f');
                        $(selectorInput).removeClass('input-success').addClass('input-error');
                        isValid[validKey] = false;
                    } else if (response.status == 'success') {
                        $(selectorMsg).html('<i class="fa fa-check-circle"></i> Tersedia').css('color', '#5cb85c');
                        $(selectorInput).removeClass('input-error').addClass('input-success');
                        isValid[validKey] = true;
                    } else {
                        $(selectorMsg).html('').css('color', '');
                        $(selectorInput).removeClass('input-error input-success');
                        isValid[validKey] = false;
                    }
                    checkAllValid();
                },
                error: function(xhr, status, error) {
                    console.error('❌ AJAX Error!');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Response Status:', xhr.status);
                    
                    $(selectorMsg).html('<i class="fa fa-exclamation-triangle"></i> Gagal mengecek data').css('color', '#f0ad4e');
                    $(selectorInput).removeClass('input-success input-error');
                    isValid[validKey] = false;
                    checkAllValid();
                }
            });
        });
    }

    // Jalankan validasi
    cekDataPPDB('#nisn', '#msg_nisn', 'nisn', 'nisn');
    cekDataPPDB('#nik', '#msg_nik', 'nik', 'nik');
    cekDataPPDB('#no_akte_lahir', '#msg_akte', 'no_akte_lahir', 'akte');

    // Validasi submit
    $('#formPPDB').on('submit', function(e) {
        var hasError = false;
        
        if ($('.input-error').length > 0) {
            hasError = true;
        }
        
        if (!isValid.nisn || !isValid.nik || !isValid.akte) {
            hasError = true;
        }
        
        if(hasError) {
            e.preventDefault();
            alert('⚠️ PERHATIAN!\n\nMasih ada data yang duplikat atau belum divalidasi!\n\nSilakan periksa kembali:\n• NISN\n• NIK\n• No. Akte Lahir\n\nPastikan semua menampilkan tanda centang hijau (✓)');
            
            var firstError = $('.input-error').first();
            if (firstError.length > 0) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 100
                }, 500);
                firstError.focus();
            }
            
            return false;
        }
        
        return confirm('Apakah data yang Anda masukkan sudah benar?\n\nPastikan semua informasi sesuai dengan dokumen resmi (KK, Ijazah, Akte Lahir).');
    });

    // Disable tombol submit saat halaman pertama kali dimuat
    $('#btnSubmitPPDB').prop('disabled', true);

});
</script>