<?php
require_once 'Database.php';

class UserModel extends Database {

    public function cekLogin($username, $password) {
        // Amankan input agar tidak kena SQL Injection
        $username = mysqli_real_escape_string($this->koneksi, $username);
        
        // 1. Cari user berdasarkan username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = $this->query($sql);
        $user = mysqli_fetch_assoc($query);

        // 2. Jika user ditemukan
        if ($user) {
            // 3. Cek password (gunakan password_verify untuk keamanan standar PHP)
            // Ini akan mencocokkan password 'admin123' dengan hash di database
            if (password_verify($password, $user['password'])) {
                return $user; // Login Sukses, kembalikan data user
            }
        }
        return false; // Login Gagal (User tak ada atau password salah)
    }
}
?>