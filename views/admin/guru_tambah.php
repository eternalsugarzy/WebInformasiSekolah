<?php 
$title = "Tambah Guru";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>

<div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

    <div class="content-wrapper">
        <div class="card-box">
            <h4 style="margin-bottom: 20px;">Form Tambah Data Guru</h4>
            <form method="POST" action="guru.php?aksi=simpan" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIP / NUPTK</label>
                            <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap (Gelar)</label>
                            <input type="text" name="nama" class="form-control" required placeholder="Contoh: Dr. Budi Santoso, M.Pd">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control">
                                <option value="Guru Mapel">Guru Mapel</option>
                                <option value="Wali Kelas">Wali Kelas</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Staf TU">Staf TU</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bidang Studi (Mapel)</label>
                            <input type="text" name="mapel" class="form-control" placeholder="Contoh: Matematika">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@sekolah.sch.id">
                </div>

                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Disarankan rasio 1:1 (Persegi)</small>
                </div>

                <hr>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Data</button>
                <a href="guru.php" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php require_once 'template/footer.php'; ?>