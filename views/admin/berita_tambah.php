<?php 
 // penting agar $_SESSION tersedia
$title = "Tambah Berita";

// pastikan path ke template sesuai (relatif terhadap file ini)
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<!-- MAIN CONTENT (tidak lagi mencakup <html> <head> karena sudah ada di header.php) -->
<div class="main-content">
<?php require_once 'template/topbar.php'; ?>
    

   

    <div class="content-wrapper">
        <div class="card-box">
            <form method="POST" action="berita.php?aksi=simpan" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Judul Berita</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Masukkan judul berita...">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="form-control">
                                <option value="Kegiatan Sekolah">Kegiatan Sekolah</option>
                                <option value="Prestasi">Prestasi</option>
                                <option value="Akademik">Akademik</option>
                                <option value="Pengumuman">Pengumuman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Publikasi</label>
                            <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi Berita</label>
                    <textarea name="konten" class="form-control" rows="10" required placeholder="Tulis isi berita disini..."></textarea>
                </div>

                <div class="form-group">
                    <label>Gambar Utama</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Berita</button>
                <a href="berita.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>
