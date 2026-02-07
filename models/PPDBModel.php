<?php
// Pastikan path ke Database.php benar
require_once 'Database.php';

class PPDBModel extends Database {

    // ==========================================================
    // BAGIAN 1: FITUR INFO PPDB (TETAP SESUAI KODE ANDA)
    // ==========================================================

    public function getAllPPDBInfo() {
        $sql = "SELECT * FROM info_ppdb ORDER BY id_info DESC";
        $result = $this->query($sql);
        
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    public function getAllPPDB() {
        return $this->getAllPPDBInfo();
    }

    public function getPPDBById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM info_ppdb WHERE id_info = $id";
        $result = $this->query($sql);
        
        if ($result) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    public function updatePPDB($id, $jenis, $isi, $tgl_mulai, $tgl_akhir, $link) {
        $jenis = mysqli_real_escape_string($this->koneksi, $jenis);
        $isi = mysqli_real_escape_string($this->koneksi, $isi);
        $link = mysqli_real_escape_string($this->koneksi, $link);

        $sql = "UPDATE info_ppdb SET 
                jenis_informasi = '$jenis', 
                isi_detail = '$isi', 
                tanggal_mulai = '$tgl_mulai', 
                tanggal_akhir = '$tgl_akhir', 
                tautan_formulir = '$link' 
                WHERE id_info = $id";
        
        return $this->query($sql);
    }

    public function hapusPPDB($id) {
        $id = intval($id);
        $sql = "DELETE FROM info_ppdb WHERE id_info = $id";
        return $this->query($sql);
    }

    // ==========================================================
    // BAGIAN 2: FITUR DATA PENDAFTAR
    // ==========================================================

    public function tambahPendaftar($data) {
        $conn = $this->koneksi;

        $nisn           = mysqli_real_escape_string($conn, $data['nisn']);
        $nama           = mysqli_real_escape_string($conn, $data['nama_lengkap']);
        $tempat_lahir   = mysqli_real_escape_string($conn, $data['tempat_lahir']);
        $tgl_lahir      = mysqli_real_escape_string($conn, $data['tanggal_lahir']);
        $jk             = mysqli_real_escape_string($conn, $data['jenis_kelamin']);
        $agama          = mysqli_real_escape_string($conn, $data['agama']);
        $alamat         = mysqli_real_escape_string($conn, $data['alamat_lengkap']);
        $hp             = mysqli_real_escape_string($conn, $data['no_hp_siswa']);
        $email          = mysqli_real_escape_string($conn, $data['email_siswa']);
        
        $kk             = mysqli_real_escape_string($conn, $data['no_kk']);
        $nik            = mysqli_real_escape_string($conn, $data['nik']);
        $akte           = mysqli_real_escape_string($conn, $data['no_akte_lahir']);
        
        $npsn           = mysqli_real_escape_string($conn, $data['npsn_smp']);
        $sekolah_asal   = mysqli_real_escape_string($conn, $data['nama_sekolah_asal']);
        $provinsi       = mysqli_real_escape_string($conn, $data['provinsi_smp']);
        $kabupaten      = mysqli_real_escape_string($conn, $data['kabupaten_smp']);
        $kecamatan      = mysqli_real_escape_string($conn, $data['kecamatan_smp']);
        
        $foto           = mysqli_real_escape_string($conn, $data['foto_siswa']);
        
        $no_reg = "REG-" . date('ymdHis');

        $sql = "INSERT INTO pendaftar_ppdb 
                (no_registrasi, nisn, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat_lengkap, no_hp_siswa, email_siswa, no_kk, nik, no_akte_lahir, npsn_smp, nama_sekolah_asal, provinsi_smp, kabupaten_smp, kecamatan_smp, foto_siswa, status_seleksi) 
                VALUES 
                ('$no_reg', '$nisn', '$nama', '$tempat_lahir', '$tgl_lahir', '$jk', '$agama', '$alamat', '$hp', '$email', '$kk', '$nik', '$akte', '$npsn', '$sekolah_asal', '$provinsi', '$kabupaten', '$kecamatan', '$foto', 'Menunggu')";

        return $this->query($sql);
    }

    public function updatePendaftar($data, $id) {
        $conn = $this->koneksi;
        $id = intval($id);

        // Escape input agar aman
        foreach ($data as $key => $value) {
            $data[$key] = mysqli_real_escape_string($conn, $value);
        }

        // Query Update data teks
        $sql = "UPDATE pendaftar_ppdb SET 
                nisn = '{$data['nisn']}',
                nama_lengkap = '{$data['nama_lengkap']}',
                tempat_lahir = '{$data['tempat_lahir']}',
                tanggal_lahir = '{$data['tanggal_lahir']}',
                jenis_kelamin = '{$data['jenis_kelamin']}',
                agama = '{$data['agama']}',
                alamat_lengkap = '{$data['alamat_lengkap']}',
                no_hp_siswa = '{$data['no_hp_siswa']}',
                email_siswa = '{$data['email_siswa']}',
                no_kk = '{$data['no_kk']}',
                nik = '{$data['nik']}',
                no_akte_lahir = '{$data['no_akte_lahir']}',
                npsn_smp = '{$data['npsn_smp']}',
                nama_sekolah_asal = '{$data['nama_sekolah_asal']}',
                provinsi_smp = '{$data['provinsi_smp']}',
                kabupaten_smp = '{$data['kabupaten_smp']}',
                kecamatan_smp = '{$data['kecamatan_smp']}'";

        // Logika Ganti Foto: Jika ada foto baru, hapus yang lama & update database
        if (!empty($data['foto_siswa'])) {
            // Ambil nama foto lama
            $oldData = $this->getPendaftarById($id);
            if ($oldData && !empty($oldData['foto_siswa'])) {
                $path = __DIR__ . "/../admin/uploads/peserta/" . $oldData['foto_siswa'];
                if (file_exists($path)) { unlink($path); }
            }
            // Tambahkan update kolom foto
            $sql .= ", foto_siswa = '{$data['foto_siswa']}'";
        }

        $sql .= " WHERE id_pendaftar = $id";

        return $this->query($sql);
    }

    // --- [PERBAIKAN UTAMA DI SINI] ---
    // Logika Filter untuk Keyword + Provinsi + Kabupaten
    public function getAllPendaftar($input = null) {
        $keyword = "";
        $provinsi = "";
        $kabupaten = "";

        // 1. Ambil Parameter Filter dari Array $_GET
        if (is_array($input)) {
            $keyword = isset($input['q']) ? $input['q'] : "";
            $provinsi = isset($input['provinsi']) ? $input['provinsi'] : "";
            $kabupaten = isset($input['kabupaten']) ? $input['kabupaten'] : "";
        } else {
            $keyword = $input;
        }

        // 2. Bangun Query Dinamis (Gunakan WHERE 1=1 agar mudah menyambung AND)
        $sql = "SELECT * FROM pendaftar_ppdb WHERE 1=1";
        
        // Filter Keyword (Nama / No Reg / NISN)
        if (!empty($keyword)) {
            $safe_keyword = mysqli_real_escape_string($this->koneksi, $keyword);
            $sql .= " AND (nama_lengkap LIKE '%$safe_keyword%' 
                      OR no_registrasi LIKE '%$safe_keyword%' 
                      OR nisn LIKE '%$safe_keyword%')";
        }

        // Filter Provinsi (Jika dipilih)
        if (!empty($provinsi)) {
            $safe_prov = mysqli_real_escape_string($this->koneksi, $provinsi);
            $sql .= " AND provinsi_smp = '$safe_prov'";
        }

        // Filter Kabupaten (Jika dipilih)
        if (!empty($kabupaten)) {
            $safe_kab = mysqli_real_escape_string($this->koneksi, $kabupaten);
            $sql .= " AND kabupaten_smp = '$safe_kab'";
        }

        $sql .= " ORDER BY tanggal_daftar DESC";

        $result = $this->query($sql);
        
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getPendaftarById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM pendaftar_ppdb WHERE id_pendaftar = $id";
        
        $result = $this->query($sql);
        
        if ($result) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    public function updateStatus($id, $status) {
        $id = intval($id);
        $status = mysqli_real_escape_string($this->koneksi, $status);
        
        $sql = "UPDATE pendaftar_ppdb SET status_seleksi = '$status' WHERE id_pendaftar = $id";
        
        return $this->query($sql);
    }

    public function hapusPendaftar($id) {
        $id = intval($id);
        
        $data = $this->getPendaftarById($id);
        if($data && !empty($data['foto_siswa'])) {
            $path = __DIR__ . "/../admin/uploads/peserta/" . $data['foto_siswa'];
            if(file_exists($path)) {
                unlink($path); 
            }
        }

        $sql = "DELETE FROM pendaftar_ppdb WHERE id_pendaftar = $id";
        return $this->query($sql);
    }

    public function cekStatusSiswa($keyword) {
        $conn = $this->koneksi;
        
        if(is_array($keyword)) {
             $keyword = isset($keyword['keyword']) ? $keyword['keyword'] : '';
        }

        $keyword = mysqli_real_escape_string($conn, $keyword);

        $sql = "SELECT * FROM pendaftar_ppdb 
                WHERE no_registrasi = '$keyword' 
                OR nisn = '$keyword' 
                OR nik = '$keyword'
                OR nama_lengkap LIKE '%$keyword%'";
        
        $result = $this->query($sql);
        
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getListProvinsi() {
        $sql = "SELECT DISTINCT provinsi_smp FROM pendaftar_ppdb WHERE provinsi_smp != '' ORDER BY provinsi_smp ASC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row['provinsi_smp'];
            }
        }
        return $data;
    }

    public function getListKabupaten() {
        $sql = "SELECT DISTINCT kabupaten_smp FROM pendaftar_ppdb WHERE kabupaten_smp != '' ORDER BY kabupaten_smp ASC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row['kabupaten_smp'];
            }
        }
        return $data;
    }

    // Tambahkan ini di dalam class PPDBModel
    public function getLaporanPendaftar($tahun) {
        // Ambil data dari tabel pendaftar_ppdb dimana tahun daftar = tahun yang diminta
        // Filter juga hanya yang statusnya bukan 'Ditolak' (Opsional, tergantung kebutuhan)
        $sql = "SELECT * FROM pendaftar_ppdb 
                WHERE YEAR(tanggal_daftar) = '$tahun' 
                ORDER BY nama_lengkap ASC";
        
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // ... (kode fungsi lainnya tetap ada) ...

    // [BARU] Fungsi Cek Duplikasi (NISN, NIK, Akte)
    // $id_exclude = ID siswa yang sedang diedit (agar tidak mendeteksi diri sendiri sebagai duplikat)
    // Jika sedang Tambah Data Baru, biarkan $id_exclude = null
    public function cekDuplikasiData($nisn, $nik, $akte, $id_exclude = null) {
        $conn = $this->koneksi;
        
        $nisn = mysqli_real_escape_string($conn, $nisn);
        $nik = mysqli_real_escape_string($conn, $nik);
        $akte = mysqli_real_escape_string($conn, $akte);

        // Logic: Cari data YANG (NISN sama ATAU NIK sama ATAU Akte sama)
        $sql = "SELECT nama_lengkap, nisn, nik, no_akte_lahir FROM pendaftar_ppdb 
                WHERE (nisn = '$nisn' OR nik = '$nik' OR no_akte_lahir = '$akte')";

        // Jika sedang Edit, kecualikan ID siswa itu sendiri
        if ($id_exclude != null) {
            $id_exclude = intval($id_exclude);
            $sql .= " AND id_pendaftar != $id_exclude";
        }

        $result = $this->query($sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            // Kembalikan data siswa yang "kembar" untuk pesan error
            return mysqli_fetch_assoc($result);
        }
        
        return false; // Tidak ada duplikat (Aman)
    }

    // ... (lanjutkan dengan fungsi tambahPendaftar, updatePendaftar, dll) ...
}
?>