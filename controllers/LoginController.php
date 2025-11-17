<?php
// Panggil Model User
require_once __DIR__ . '/../models/UserModel.php';

class LoginController {

    public function index() {
        // 1. Cek apakah user sudah login sebelumnya?
        if (isset($_SESSION['user_admin'])) {
            header("Location: index.php"); // Kalau sudah, lempar ke dashboard
            exit;
        }

        // 2. Proses Form Login (Jika tombol 'Masuk' diklik)
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $loginUser = $userModel->cekLogin($username, $password);

            if ($loginUser) {
                // Login Berhasil! Simpan data ke Session
                $_SESSION['user_admin'] = true; // Penanda login
                $_SESSION['admin_id'] = $loginUser['id_user'];
                $_SESSION['admin_nama'] = $loginUser['nama_admin'];
                $_SESSION['admin_level'] = $loginUser['level'];

                // Redirect ke Dashboard
                header("Location: index.php"); 
                exit;
            } else {
                // Login Gagal
                $error = "Username atau Password salah!";
            }
        }

        // 3. Tampilkan Halaman Login
        require_once __DIR__ . '/../views/admin/login_view.php';
    }

    // ... fungsi index() di atas ...

    public function logout() {
        // Hapus semua data sesi
        session_unset();
        session_destroy();
        
        // Kembalikan ke halaman login
        header("Location: login.php");
        exit;
    }
} // Tutup Class

?>