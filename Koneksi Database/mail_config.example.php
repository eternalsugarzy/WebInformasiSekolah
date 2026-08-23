<?php
/**
 * Konfigurasi SMTP untuk pengiriman email notifikasi kelulusan PPDB.
 * Sesuaikan nilai-nilai di bawah ini dengan akun pengirim yang akan dipakai.
 *
 * Contoh Gmail: aktifkan 2-Step Verification lalu buat "App Password" khusus
 * (bukan password akun biasa) di myaccount.google.com/apppasswords.
 */
return [
    'host'       => 'smtp.gmail.com',
    'port'       => 587,
    'encryption' => 'tls',        // 'tls' atau 'ssl'
    'username'   => 'ganti_dengan_email_pengirim@gmail.com',
    'password'   => 'ganti_dengan_app_password',

    'from_email' => 'ganti_dengan_email_pengirim@gmail.com',
    'from_name'  => 'PPDB SMA Frater Don Bosco',
];
