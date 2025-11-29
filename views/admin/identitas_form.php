<?php 
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">PENGATURAN HALAMAN DEPAN & PROFIL</h4>
            
            <ul class="nav nav-tabs">
                <li class="<?php echo (!isset($_GET['tab']) || $_GET['tab'] != 'poster') ? 'active' : ''; ?>">
                    <a data-toggle="tab" href="#profil">Profil Sekolah</a>
                </li>
                <li class="<?php echo (isset($_GET['tab']) && $_GET['tab'] == 'poster') ? 'active' : ''; ?>">
                    <a data-toggle="tab" href="#poster">Poster Slider (Carousel)</a>
                </li>
            </ul>

            <div class="tab-content" style="padding-top: 20px;">
                
                <div id="profil" class="tab-pane fade <?php echo (!isset($_GET['tab']) || $_GET['tab'] != 'poster') ? 'in active' : ''; ?>">
                    <form method="POST" action="identitas.php?aksi=update" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label>Sejarah Singkat</label>
                            <textarea name="sejarah" class="form-control" rows="5"><?php echo htmlspecialchars($data['sejarah']); ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visi</label>
                                    <textarea name="visi" class="form-control" rows="5"><?php echo htmlspecialchars($data['visi']); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Misi</label>
                                    <textarea name="misi" class="form-control" rows="5"><?php echo htmlspecialchars($data['misi']); ?></textarea>
                                    <small class="text-muted">Gunakan Enter untuk poin baru.</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Fasilitas Sekolah (Deskripsi)</label>
                            <textarea name="fasilitas" class="form-control" rows="4" placeholder="Jelaskan fasilitas yang ada..."><?php echo htmlspecialchars($data['fasilitas']); ?></textarea>
                            <small class="text-muted">Pisahkan dengan koma (,) atau Enter.</small>
                        </div>

                        <div class="form-group" style="background: #f0f8ff; padding: 15px; border-radius: 5px; border: 1px solid #b3d7ff;">
                            <label style="color: #0056b3;"><i class="fa fa-youtube-play"></i> Link Video YouTube (Halaman Depan)</label>
                            <input type="text" name="video" class="form-control" value="<?php echo htmlspecialchars($data['link_video'] ?? ''); ?>" placeholder="Paste link YouTube di sini (Contoh: https://www.youtube.com/watch?v=xxxxx)">
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Profil</button>
                    </form>
                </div>

                <div id="poster" class="tab-pane fade <?php echo (isset($_GET['tab']) && $_GET['tab'] == 'poster') ? 'in active' : ''; ?>">
                    
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Gambar yang diupload di sini akan menjadi <b>Slider Otomatis</b> di halaman depan website.
                    </div>

                    <div style="background: #f9f9f9; padding: 15px; border: 1px solid #eee; border-radius: 5px; margin-bottom: 20px;">
                        <form method="POST" action="identitas.php?aksi=upload_poster" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Upload Poster Baru (Portrait/Tegak)</label>
                                <div class="input-group">
                                    <input type="file" name="poster" class="form-control" required accept="image/*">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-upload"></i> Upload</button>
                                    </span>
                                </div>
                                <small class="text-muted">Format: JPG, PNG. Disarankan ukuran Banner Tegak.</small>
                            </div>
                        </form>
                    </div>

                    <h4>Daftar Poster Aktif:</h4>
                    <div class="row">
                        <?php if(isset($posters) && count($posters) > 0): ?>
                            <?php foreach($posters as $p): ?>
                            <div class="col-md-3 col-xs-6" style="margin-bottom: 15px;">
                                <div style="position: relative; border: 1px solid #ddd; padding: 5px; background: #fff; border-radius: 4px;">
                                    <img src="uploads/identitas/<?php echo $p['file_poster']; ?>" style="width: 100%; height: 250px; object-fit: cover;">
                                    
                                    <a href="identitas.php?aksi=hapus_poster&id=<?php echo $p['id_poster']; ?>" 
                                       class="btn btn-xs btn-danger" 
                                       style="position: absolute; top: 10px; right: 10px;"
                                       onclick="return confirm('Hapus poster ini dari slider?')">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-md-12">
                                <div class="well text-center">Belum ada poster slider. Silakan upload gambar.</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    

                </div> 
                </div>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>