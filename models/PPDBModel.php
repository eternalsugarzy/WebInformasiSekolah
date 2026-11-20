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
        $jalur          = mysqli_real_escape_string($conn, $data['jalur_seleksi'] ?? 'Zonasi');
        
        $no_reg = "REG-" . date('ymdHis');

        $sql = "INSERT INTO pendaftar_ppdb 
                (no_registrasi, nisn, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, alamat_lengkap, no_hp_siswa, email_siswa, no_kk, nik, no_akte_lahir, npsn_smp, nama_sekolah_asal, provinsi_smp, kabupaten_smp, kecamatan_smp, foto_siswa, jalur_seleksi, id_gelombang, status_seleksi)
                VALUES
                ('$no_reg', '$nisn', '$nama', '$tempat_lahir', '$tgl_lahir', '$jk', '$agama', '$alamat', '$hp', '$email', '$kk', '$nik', '$akte', '$npsn', '$sekolah_asal', '$provinsi', '$kabupaten', '$kecamatan', '$foto', '$jalur',
                 (SELECT g.id_gelombang FROM gelombang_ppdb g WHERE CURDATE() BETWEEN g.tanggal_mulai AND g.tanggal_akhir ORDER BY g.tanggal_mulai LIMIT 1),
                 'Menunggu')";

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
                kecamatan_smp = '{$data['kecamatan_smp']}',
                jalur_seleksi = '{$data['jalur_seleksi']}'";

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
        $sql = "SELECT p.*, g.nama_gelombang, g.tanggal_mulai AS gelombang_mulai, g.tanggal_akhir AS gelombang_akhir
                FROM pendaftar_ppdb p
                LEFT JOIN gelombang_ppdb g ON g.id_gelombang = p.id_gelombang
                WHERE p.id_pendaftar = $id";

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

        // Hapus juga file sertifikat prestasi siswa ybs (baris prestasi_siswa
        // ikut terhapus otomatis lewat FOREIGN KEY ... ON DELETE CASCADE)
        $res_sert = $this->query("SELECT bukti_sertifikat FROM prestasi_siswa WHERE id_pendaftar = $id AND bukti_sertifikat IS NOT NULL AND bukti_sertifikat <> ''");
        if ($res_sert) {
            while ($s = mysqli_fetch_assoc($res_sert)) {
                $path_sert = __DIR__ . "/../admin/uploads/prestasi/" . basename($s['bukti_sertifikat']);
                if (file_exists($path_sert)) unlink($path_sert);
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

    // ... kode fungsi lainnya ...

    // [BARU] Cek Eksistensi Data per Kolom (Untuk AJAX Frontend)
    public function isDataExist($column, $value) {
        $conn = $this->koneksi;
        
        // Whitelist kolom agar aman dari SQL Injection
        $allowed_columns = ['nisn', 'nik', 'no_akte_lahir'];
        if (!in_array($column, $allowed_columns)) {
            return false;
        }

        $value = mysqli_real_escape_string($conn, $value);
        $sql = "SELECT count(*) as total FROM pendaftar_ppdb WHERE $column = '$value'";
        
        $result = $this->query($sql);
        $row = mysqli_fetch_assoc($result);
        
       return ($row['total'] > 0); // Return TRUE jika ada, FALSE jika kosong
    }

    // ==========================================
    // UNTUK DASHBOARD: Tren Pendaftar & Statistik Kelulusan
    // ==========================================

    // Jumlah pendaftar per tahun ajaran (untuk grafik tren di Dashboard)
    public function getTrenPendaftarPerTahun() {
        $sql = "SELECT YEAR(tanggal_daftar) as tahun, COUNT(*) as jumlah
                FROM pendaftar_ppdb
                GROUP BY YEAR(tanggal_daftar)
                ORDER BY tahun ASC";
        $result = $this->query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Rekap jumlah pendaftar per status seleksi (untuk grafik pie di Dashboard)
    public function getStatistikKelulusan($tahun = null) {
        $where = "";
        if ($tahun) {
            $tahun = intval($tahun);
            $where = "WHERE YEAR(tanggal_daftar) = $tahun";
        }
        $sql = "SELECT status_seleksi, COUNT(*) as jumlah
                FROM pendaftar_ppdb
                $where
                GROUP BY status_seleksi";
        $result = $this->query($sql);

        // Default 0 supaya urutan & keberadaan status selalu konsisten di grafik
        $rekap = ['Menunggu' => 0, 'Diterima' => 0, 'Cadangan' => 0, 'Ditolak' => 0];
        while ($row = mysqli_fetch_assoc($result)) {
            $rekap[$row['status_seleksi']] = (int) $row['jumlah'];
        }
        return $rekap;
    }

// Rekap jumlah pendaftar per Jalur Seleksi, dipecah per status (Laporan Rekap Jalur Seleksi)
    public function getRekapJalurSeleksi($tahun = null) {
        $where = "";
        if ($tahun) {
            $tahun = intval($tahun);
            $where = "WHERE YEAR(tanggal_daftar) = $tahun";
        }
        $sql = "SELECT jalur_seleksi, status_seleksi, COUNT(*) as jumlah
                FROM pendaftar_ppdb
                $where
                GROUP BY jalur_seleksi, status_seleksi";
        $result = $this->query($sql);

        $jalur_list = ['Prestasi', 'Zonasi', 'Afirmasi'];
        $status_list = ['Menunggu', 'Diterima', 'Cadangan', 'Ditolak'];

        // Inisialisasi rekap dengan 0 supaya semua kombinasi selalu ada (walau datanya kosong)
        $rekap = [];
        foreach ($jalur_list as $j) {
            $rekap[$j] = array_fill_keys($status_list, 0);
            $rekap[$j]['Total'] = 0;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $j = $row['jalur_seleksi'];
            $s = $row['status_seleksi'];
            if (isset($rekap[$j][$s])) {
                $rekap[$j][$s] = (int) $row['jumlah'];
            }
        }

        // Hitung total per jalur & grand total
        $grand_total = array_fill_keys($status_list, 0);
        $grand_total['Total'] = 0;
        foreach ($jalur_list as $j) {
            $total_jalur = 0;
            foreach ($status_list as $s) {
                $total_jalur += $rekap[$j][$s];
                $grand_total[$s] += $rekap[$j][$s];
            }
            $rekap[$j]['Total'] = $total_jalur;
            $grand_total['Total'] += $total_jalur;
        }

        return [
            'per_jalur'   => $rekap,
            'grand_total' => $grand_total,
        ];
    }

    // ==========================================================
    // BAGIAN 3: LAPORAN REKAP PENDAFTARAN PPDB
    // ==========================================================

    // Data lengkap satu baris per pendaftar (Nama, NISN, Jalur, Asal Sekolah,
    // Nilai Rapor, Nilai Tes, Prestasi, Jarak, Status) untuk Laporan Rekap Pendaftaran.
    // $filters: ['tahun' => ..., 'jalur' => ..., 'status' => ...] — semua opsional.
    public function getRekapPendaftaran($filters = []) {
        $conn = $this->koneksi;

        $sql = "SELECT
                    p.nama_lengkap, p.nisn, p.jalur_seleksi, p.nama_sekolah_asal,
                    p.status_seleksi, p.tanggal_daftar,
                    n.nilai_raport, n.nilai_tes, n.nilai_prestasi, n.jarak_rumah
                FROM pendaftar_ppdb p
                LEFT JOIN nilai_tesmasuk n ON n.id_pendaftar = p.id_pendaftar
                WHERE 1=1";

        if (!empty($filters['tahun'])) {
            $tahun = intval($filters['tahun']);
            $sql .= " AND YEAR(p.tanggal_daftar) = $tahun";
        }

        if (!empty($filters['jalur'])) {
            $jalur = mysqli_real_escape_string($conn, $filters['jalur']);
            $sql .= " AND p.jalur_seleksi = '$jalur'";
        }

        if (!empty($filters['status'])) {
            $status = mysqli_real_escape_string($conn, $filters['status']);
            $sql .= " AND p.status_seleksi = '$status'";
        }

        $sql .= " ORDER BY p.nama_lengkap ASC";

        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // ==========================================================
    // BAGIAN 4: LAPORAN TREN PPDB ANTAR TAHUN
    // ==========================================================

    // Satu baris per tahun ajaran: Tahun - Pendaftar - Diterima - Cadangan - Ditolak.
    // "Pendaftar" = total seluruh pendaftar tahun itu (termasuk yang masih Menunggu).
    public function getTrenPPDBAntarTahun() {
        $sql = "SELECT
                    YEAR(tanggal_daftar) as tahun,
                    COUNT(*) as pendaftar,
                    SUM(status_seleksi = 'Diterima') as diterima,
                    SUM(status_seleksi = 'Cadangan') as cadangan,
                    SUM(status_seleksi = 'Ditolak') as ditolak,
                    SUM(status_seleksi = 'Menunggu') as menunggu
                FROM pendaftar_ppdb
                WHERE tanggal_daftar IS NOT NULL
                GROUP BY YEAR(tanggal_daftar)
                ORDER BY tahun ASC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // ==========================================================
    // BAGIAN 5: DAFTAR ULANG (menghubungkan hasil seleksi SAW dengan
    // proses penerimaan sesungguhnya)
    // ==========================================================

    // Semua pendaftar berstatus 'Diterima', lengkap dengan status daftar ulangnya
    // dan peringkat SAW (untuk referensi saat memilih cadangan pengganti).
    public function getPendaftarDaftarUlang($filters = []) {
        $conn = $this->koneksi;

        $sql = "SELECT
                    p.id_pendaftar, p.no_registrasi, p.nama_lengkap, p.nisn,
                    p.jalur_seleksi, p.status_seleksi,
                    p.status_daftar_ulang, p.tanggal_daftar_ulang, p.catatan_daftar_ulang,
                    n.peringkat, n.peringkat_jalur, n.nilai_akhir_saw
                FROM pendaftar_ppdb p
                LEFT JOIN nilai_tesmasuk n ON n.id_pendaftar = p.id_pendaftar
                WHERE p.status_seleksi = 'Diterima'";

        if (!empty($filters['status_daftar_ulang'])) {
            $sdu = mysqli_real_escape_string($conn, $filters['status_daftar_ulang']);
            $sql .= " AND p.status_daftar_ulang = '$sdu'";
        }
        if (!empty($filters['jalur'])) {
            $jalur = mysqli_real_escape_string($conn, $filters['jalur']);
            $sql .= " AND p.jalur_seleksi = '$jalur'";
        }

        $sql .= " ORDER BY FIELD(p.jalur_seleksi, 'Zonasi', 'Prestasi', 'Afirmasi'), n.peringkat_jalur ASC";

        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Ringkasan angka: kuota diterima vs realisasi daftar ulang -- inilah bagian
    // yang menghubungkan hasil seleksi (SAW) dengan proses penerimaan sesungguhnya.
    public function getRingkasanDaftarUlang() {
        $sql = "SELECT status_daftar_ulang, COUNT(*) as jumlah
                FROM pendaftar_ppdb
                WHERE status_seleksi = 'Diterima'
                GROUP BY status_daftar_ulang";
        $result = $this->query($sql);

        $rekap = ['Belum Konfirmasi' => 0, 'Daftar Ulang' => 0, 'Mengundurkan Diri' => 0];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rekap[$row['status_daftar_ulang']] = (int) $row['jumlah'];
            }
        }
        $rekap['Total Diterima'] = array_sum($rekap);

        // Jumlah kandidat Cadangan yang masih menunggu (siap dipromosikan jika ada kursi kosong)
        $sql_cadangan = "SELECT COUNT(*) as jumlah FROM pendaftar_ppdb WHERE status_seleksi = 'Cadangan'";
        $res_cadangan = $this->query($sql_cadangan);
        $rekap['Cadangan Menunggu'] = $res_cadangan ? (int) mysqli_fetch_assoc($res_cadangan)['jumlah'] : 0;

        return $rekap;
    }

    // Update status daftar ulang 1 pendaftar. Otomatis mengisi tanggal_daftar_ulang
    // saat statusnya bukan 'Belum Konfirmasi', dan mengosongkannya lagi jika direset.
    public function updateDaftarUlang($id, $status_daftar_ulang, $catatan = '') {
        $conn = $this->koneksi;
        $id = intval($id);
        $status = mysqli_real_escape_string($conn, $status_daftar_ulang);
        $catatan = mysqli_real_escape_string($conn, $catatan);

        $tanggal_sql = ($status_daftar_ulang === 'Belum Konfirmasi') ? 'NULL' : 'NOW()';

        $sql = "UPDATE pendaftar_ppdb SET
                    status_daftar_ulang = '$status',
                    tanggal_daftar_ulang = $tanggal_sql,
                    catatan_daftar_ulang = '$catatan'
                WHERE id_pendaftar = $id";
        return $this->query($sql);
    }

    // Kuota kelulusan per jalur (tabel kuota_jalur, fallback ke kuota global setting_ppdb)
    public function getKuotaPerJalur() {
        $default = ['kuota_diterima' => 0, 'kuota_cadangan' => 0];
        $res = $this->query("SELECT nama_setting, nilai FROM setting_ppdb WHERE nama_setting IN ('kuota_diterima','kuota_cadangan')");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $default[$row['nama_setting']] = (int) $row['nilai'];
            }
        }

        $kuota = [];
        foreach (['Zonasi', 'Prestasi', 'Afirmasi'] as $j) {
            $kuota[$j] = $default;
        }
        $res = $this->query("SELECT * FROM kuota_jalur");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $kuota[$row['jalur_seleksi']] = [
                    'kuota_diterima' => (int) $row['kuota_diterima'],
                    'kuota_cadangan' => (int) $row['kuota_cadangan'],
                ];
            }
        }
        return $kuota;
    }

    // Kandidat Cadangan terbaik (peringkat jalur terkecil) DI JALUR TERTENTU yang siap
    // dipromosikan mengisi kursi kosong akibat siswa Diterima di jalur itu mengundurkan diri.
    public function getCadanganTerbaik($jalur) {
        $jalur = mysqli_real_escape_string($this->koneksi, $jalur);
        $sql = "SELECT p.id_pendaftar, p.nama_lengkap, p.jalur_seleksi, n.peringkat, n.peringkat_jalur, n.nilai_akhir_saw
                FROM pendaftar_ppdb p
                JOIN nilai_tesmasuk n ON n.id_pendaftar = p.id_pendaftar
                WHERE p.status_seleksi = 'Cadangan' AND p.jalur_seleksi = '$jalur'
                ORDER BY n.peringkat_jalur ASC, n.nilai_akhir_saw DESC
                LIMIT 1";
        $result = $this->query($sql);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    // Ketersediaan kursi per jalur: kuota Diterima dibanding siswa Diterima yang
    // TIDAK mengundurkan diri. Selisihnya = kursi kosong yang boleh diisi Cadangan.
    public function getKursiPerJalur() {
        $kuota = $this->getKuotaPerJalur();

        $sql = "SELECT jalur_seleksi,
                       SUM(status_seleksi = 'Diterima' AND status_daftar_ulang <> 'Mengundurkan Diri') AS diterima_aktif,
                       SUM(status_seleksi = 'Diterima' AND status_daftar_ulang = 'Mengundurkan Diri') AS mundur,
                       SUM(status_seleksi = 'Cadangan') AS cadangan
                FROM pendaftar_ppdb
                GROUP BY jalur_seleksi";
        $hitung = [];
        $res = $this->query($sql);
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $hitung[$row['jalur_seleksi']] = $row;
            }
        }

        $data = [];
        foreach ($kuota as $jalur => $k) {
            $aktif = isset($hitung[$jalur]) ? (int) $hitung[$jalur]['diterima_aktif'] : 0;
            $data[$jalur] = [
                'kuota_diterima' => $k['kuota_diterima'],
                'diterima_aktif' => $aktif,
                'mundur'         => isset($hitung[$jalur]) ? (int) $hitung[$jalur]['mundur'] : 0,
                'cadangan'       => isset($hitung[$jalur]) ? (int) $hitung[$jalur]['cadangan'] : 0,
                'kursi_kosong'   => max(0, $k['kuota_diterima'] - $aktif),
                'kandidat'       => $this->getCadanganTerbaik($jalur),
            ];
        }
        return $data;
    }

    // Promosikan 1 pendaftar Cadangan menjadi Diterima (mengisi kursi kosong)
    public function promosikanKeDiterima($id) {
        $id = intval($id);
        $sql = "UPDATE pendaftar_ppdb SET status_seleksi = 'Diterima' WHERE id_pendaftar = $id";
        return $this->query($sql);
    }

    // Daftar tahun ajaran (berdasarkan tanggal_daftar) untuk dropdown filter laporan
    public function getTahunPendaftaran() {
        $sql = "SELECT DISTINCT YEAR(tanggal_daftar) as tahun
                FROM pendaftar_ppdb
                WHERE tanggal_daftar IS NOT NULL
                ORDER BY tahun DESC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row['tahun'];
            }
        }
        return $data;
    }

    // ==========================================================
    // BAGIAN 6: LAPORAN PENERIMAAN PESERTA DIDIK BARU
    // (Rekapitulasi total penerimaan: pendaftar vs diterima vs tidak diterima,
    // persentase penerimaan per jalur & gelombang, sebaran pendaftar, dan
    // perbandingan dengan kuota per jalur.)
    // ==========================================================

    // WHERE dasar dari filter laporan. $filters: tahun, jalur, gelombang
    // (gelombang = id_gelombang, atau 'tanpa' untuk pendaftar di luar semua gelombang).
    private function wherePenerimaan($filters, $pakai_gelombang = true) {
        $conn = $this->koneksi;
        $w = "WHERE 1=1";
        if (!empty($filters['tahun'])) {
            $w .= " AND YEAR(p.tanggal_daftar) = " . intval($filters['tahun']);
        }
        if (!empty($filters['jalur'])) {
            $w .= " AND p.jalur_seleksi = '" . mysqli_real_escape_string($conn, $filters['jalur']) . "'";
        }
        if ($pakai_gelombang && !empty($filters['gelombang'])) {
            if ($filters['gelombang'] === 'tanpa') {
                $w .= " AND p.id_gelombang IS NULL";
            } else {
                $w .= " AND p.id_gelombang = " . intval($filters['gelombang']);
            }
        }
        return $w;
    }

    // Kolom agregat standar: jumlah pendaftar per status seleksi + daftar ulang
    private function kolomRekapStatus() {
        return "COUNT(*) AS pendaftar,
                SUM(p.status_seleksi = 'Diterima') AS diterima,
                SUM(p.status_seleksi = 'Cadangan') AS cadangan,
                SUM(p.status_seleksi = 'Ditolak') AS ditolak,
                SUM(p.status_seleksi = 'Menunggu') AS menunggu,
                SUM(p.status_seleksi = 'Diterima' AND p.status_daftar_ulang = 'Daftar Ulang') AS daftar_ulang";
    }

    private static function persen($bagian, $total) {
        return $total > 0 ? round($bagian / $total * 100, 1) : 0;
    }

    private function normalisasiRekap($row) {
        $out = [];
        foreach (['pendaftar', 'diterima', 'cadangan', 'ditolak', 'menunggu', 'daftar_ulang'] as $k) {
            $out[$k] = isset($row[$k]) ? (int) $row[$k] : 0;
        }
        $out['persen_diterima'] = self::persen($out['diterima'], $out['pendaftar']);
        return $out;
    }

    public function getLaporanPenerimaan($filters = []) {
        $where = $this->wherePenerimaan($filters);
        $kolom = $this->kolomRekapStatus();

        // 1. Ringkasan total
        $res = $this->query("SELECT $kolom FROM pendaftar_ppdb p $where");
        $ringkasan = $this->normalisasiRekap($res ? mysqli_fetch_assoc($res) : []);

        // 2. Per jalur seleksi + perbandingan kuota
        $kuota = $this->getKuotaPerJalur();
        $jalur_list = !empty($filters['jalur']) && isset($kuota[$filters['jalur']])
            ? [$filters['jalur']] : array_keys($kuota);

        $per_jalur = [];
        foreach ($jalur_list as $j) {
            $per_jalur[$j] = $this->normalisasiRekap([]);
        }
        $res = $this->query("SELECT p.jalur_seleksi, $kolom FROM pendaftar_ppdb p $where GROUP BY p.jalur_seleksi");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                if (isset($per_jalur[$row['jalur_seleksi']])) {
                    $per_jalur[$row['jalur_seleksi']] = $this->normalisasiRekap($row);
                }
            }
        }

        // Pemenuhan kuota dihitung dari SELURUH gelombang (kuota berlaku untuk satu
        // periode penerimaan, bukan per gelombang), tetap mengikuti filter tahun & jalur.
        $where_kuota = $this->wherePenerimaan($filters, false);
        $terisi = [];
        $res = $this->query("SELECT p.jalur_seleksi, SUM(p.status_seleksi = 'Diterima') AS diterima
                             FROM pendaftar_ppdb p $where_kuota GROUP BY p.jalur_seleksi");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $terisi[$row['jalur_seleksi']] = (int) $row['diterima'];
            }
        }
        $total_kuota = ['kuota_diterima' => 0, 'terisi' => 0, 'sisa' => 0];
        foreach ($per_jalur as $j => &$r) {
            $kd = $kuota[$j]['kuota_diterima'];
            $isi = $terisi[$j] ?? 0;
            $r['kuota_diterima'] = $kd;
            $r['kuota_terisi'] = $isi;
            $r['sisa_kuota'] = max(0, $kd - $isi);
            $r['persen_kuota'] = self::persen($isi, $kd);
            if ($kd == 0) {
                $r['status_kuota'] = 'Tidak ada kuota';
            } elseif ($isi > $kd) {
                $r['status_kuota'] = 'Melebihi kuota';
            } elseif ($isi == $kd) {
                $r['status_kuota'] = 'Terpenuhi';
            } else {
                $r['status_kuota'] = 'Tersisa ' . ($kd - $isi) . ' kursi';
            }
            $total_kuota['kuota_diterima'] += $kd;
            $total_kuota['terisi'] += $isi;
            $total_kuota['sisa'] += $r['sisa_kuota'];
        }
        unset($r);
        $total_kuota['persen'] = self::persen($total_kuota['terisi'], $total_kuota['kuota_diterima']);

        // 3. Per gelombang (termasuk "Tanpa Gelombang" bila ada)
        $per_gelombang = [];
        $res = $this->query("SELECT p.id_gelombang, g.nama_gelombang, g.tanggal_mulai, g.tanggal_akhir, $kolom
                             FROM pendaftar_ppdb p
                             LEFT JOIN gelombang_ppdb g ON g.id_gelombang = p.id_gelombang
                             $where
                             GROUP BY p.id_gelombang, g.nama_gelombang, g.tanggal_mulai, g.tanggal_akhir
                             ORDER BY g.tanggal_mulai IS NULL, g.tanggal_mulai ASC");
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $r = $this->normalisasiRekap($row);
                if ($row['id_gelombang']) {
                    $r['label'] = $row['nama_gelombang'] . ' ' . date('Y', strtotime($row['tanggal_mulai']));
                    $r['periode'] = date('d/m/Y', strtotime($row['tanggal_mulai'])) . ' - ' . date('d/m/Y', strtotime($row['tanggal_akhir']));
                } else {
                    $r['label'] = 'Tanpa Gelombang';
                    $r['periode'] = 'Di luar periode gelombang';
                }
                $per_gelombang[] = $r;
            }
        }

        // 4. Sebaran pendaftar (jenis kelamin, asal sekolah, kecamatan)
        $sebaran = function ($kolom_grup) use ($where, $kolom) {
            $data = [];
            $res = $this->query("SELECT $kolom_grup AS label, $kolom
                                 FROM pendaftar_ppdb p $where
                                 GROUP BY $kolom_grup
                                 ORDER BY pendaftar DESC, label ASC");
            if ($res) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $r = $this->normalisasiRekap($row);
                    $r['label'] = trim((string) $row['label']) !== '' ? $row['label'] : '(Tidak diisi)';
                    $data[] = $r;
                }
            }
            return $data;
        };

        return [
            'ringkasan'     => $ringkasan,
            'per_jalur'     => $per_jalur,
            'total_kuota'   => $total_kuota,
            'per_gelombang' => $per_gelombang,
            'sebaran_jk'        => $sebaran('p.jenis_kelamin'),
            'sebaran_sekolah'   => $sebaran('p.nama_sekolah_asal'),
            'sebaran_kecamatan' => $sebaran('p.kecamatan_smp'),
        ];
    }

} // End of Class

    // ... (lanjutkan dengan fungsi tambahPendaftar, updatePendaftar, dll) ...

?>