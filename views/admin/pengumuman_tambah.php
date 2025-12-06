<?php 
$title = "Tambah Pengumuman";
require_once 'template/header.php'; 
require_once 'template/sidebar.php'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Pengumuman</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
    
</head>
<body>

    

    <div class="main-content">
    <?php require_once 'template/topbar.php'; ?>

        <div class="content-wrapper">
            <div class="card-box">
                <form method="POST" action="pengumuman.php?aksi=simpan">
                    
                    <div class="form-group">
                        <label>Judul Pengumuman</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Contoh: Libur Semester Ganjil">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Penting / Event</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="Aktif">Aktif (Tampil di Web)</option>
                                    <option value="Arsip">Arsip (Disembunyikan)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <textarea name="isi" class="form-control" rows="5" required placeholder="Isi detail pengumuman..."></textarea>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Pengumuman</button>
                    <a href="pengumuman.php" class="btn btn-default">Batal</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

<?php require_once 'template/footer.php'; ?>