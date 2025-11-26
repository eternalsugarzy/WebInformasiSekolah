<?php
session_start();

// Panggil Controller AdminIdentitasController
// (Mundur satu folder '../' untuk keluar dari folder admin, lalu masuk ke controllers)
require_once '../controllers/AdminIdentitasController.php';

// Buat objek dari Controller
$controller = new AdminIdentitasController();

// Cek apakah ada parameter 'aksi' di URL (contoh: identitas.php?aksi=update)
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

// Logika Percabangan
if ($aksi == 'update') {
    // Jika aksinya update, jalankan fungsi update() di controller
    $controller->update();
} else {
    // Jika tidak ada aksi (buka menu biasa), tampilkan halaman form
    $controller->index();
}

// Logika Percabangan
if ($aksi == 'update') {
    $controller->update();
} 
// [TAMBAHAN BARU]
elseif ($aksi == 'upload_poster') {
    $controller->upload_poster();
} 
elseif ($aksi == 'hapus_poster') {
    $controller->hapus_poster($_GET['id']);
} 
// [AKHIR TAMBAHAN]
else {
    $controller->index();
}
?>