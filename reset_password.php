<?php
require_once 'Koneksi Database/koneksi.php';

// Password yang ingin kita pakai
$password_baru = 'admin123';

// Enkripsi password sesuai standar server Anda saat ini
$hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);

// Update user admin (ID 1) dengan password baru ini
$sql = "UPDATE users SET password = '$hash_baru' WHERE username = 'admin'";

if (mysqli_query($koneksi, $sql)) {
    echo "<h1>BERHASIL!</h1>";
    echo "Password untuk user <b>'admin'</b> berhasil direset menjadi: <b>admin123</b><br>";
    echo "Silakan hapus file ini dan coba login lagi.";
} else {
    echo "Gagal mereset password: " . mysqli_error($koneksi);
}
?>