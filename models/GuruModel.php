<?php
require_once 'Database.php';

class GuruModel extends Database {
    public function getAllGuruStaf() {
        // Query disesuaikan untuk mengurutkan berdasarkan HIERARKI JABATAN terlebih dahulu
        $sql = "SELECT id_guru, nip, nama_lengkap, jabatan, bidang_studi, email, foto 
                  FROM guru_staf 
                  ORDER BY FIELD(jabatan, 
                      'Kepala Sekolah', 
                      'Wakil Kepala Sekolah', 
                      'Wali Kelas', /* Tambahkan Wali Kelas */
                      'Guru Mapel', /* Atau nama jabatan lainnya yang paling umum */
                      'Staf Administrasi'
                  ), 
                  nama_lengkap ASC"; // Kemudian urutkan berdasarkan nama

        // ... (Lanjutan kode pengambilan data)
        $query = $this->query($sql);
        $data_guru = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_guru[] = $row;
            }
        }
        return $data_guru;
    }
    // (Fungsi countGuru yang lama biarkan saja)
    public function countGuru() {
        $sql = "SELECT COUNT(*) as total FROM guru_staf";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    // [BARU] Ambil Semua Guru
    public function getAllGuru() {
        $sql = "SELECT * FROM guru_staf ORDER BY nama_lengkap ASC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // [BARU] Ambil 1 Guru by ID
    public function getGuruById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM guru_staf WHERE id_guru = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // [BARU] Update Data Guru
    public function updateGuru($id, $nip, $nama, $jabatan, $mapel, $email, $foto = null) {
        // Jika ada foto baru yang diupload
        if ($foto != null) {
            $sql = "UPDATE guru_staf SET 
                    nip = '$nip', 
                    nama_lengkap = '$nama', 
                    jabatan = '$jabatan', 
                    bidang_studi = '$mapel', 
                    email = '$email',
                    foto = '$foto' 
                    WHERE id_guru = $id";
        } else {
            // Jika TIDAK ada foto baru (foto lama tetap dipakai)
            $sql = "UPDATE guru_staf SET 
                    nip = '$nip', 
                    nama_lengkap = '$nama', 
                    jabatan = '$jabatan', 
                    bidang_studi = '$mapel', 
                    email = '$email'
                    WHERE id_guru = $id";
        }
        return $this->query($sql);
    }
}
?>