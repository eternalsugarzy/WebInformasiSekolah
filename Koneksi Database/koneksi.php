<?php
/**
 * Konfigurasi Database
 * Sesuaikan nilai-nilai di bawah ini dengan pengaturan lokal Anda.
 */
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'db_website_sma';

// Buat objek koneksi mysqli
$koneksi = new mysqli($host, $username, $password, $db_name);

// Cek koneksi
if ($koneksi->connect_error) {
    // Jika koneksi gagal, tampilkan pesan error
    die("Koneksi ke database gagal gesss: " . $koneksi->connect_error);
}
// else {
//     // Pesan sukses (Hanya untuk testing)
//     echo "Koneksi ke database berhasil!";
// }
?>