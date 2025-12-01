<?php
require_once 'Database.php';

class GuruModel extends Database {

    /**
     * Mengambil SEMUA data guru dan staf, diurutkan berdasarkan HIERARKI JABATAN, 
     * atau difilter berdasarkan keyword pencarian (Nama, Jabatan, Bidang Studi).
     */
    // Lokasi: models/GuruModel.php (di dalam function getAllGuruList())


    // Lokasi: models/GuruModel.php (Tambahkan di dalam class GuruModel)

    /**
     * Mengambil data guru/staf untuk halaman tertentu (Pagination).
     * @param int $limit Jumlah data per halaman.
     * @param int $offset Data mulai dari urutan ke-.
     * @param string|null $keyword Kata kunci pencarian opsional.
     * @return array Data guru untuk halaman yang diminta.
     */
    public function getGuruByPage($limit, $offset, $keyword = null) {
        $limit = intval($limit);
        $offset = intval($offset);
        
        $sql = "SELECT id_guru, nip, nama_lengkap, jabatan, bidang_studi, email, foto 
                  FROM guru_staf";
        
        $where = " WHERE 1=1 "; 
        
        if ($keyword) {
            // Menggunakan fungsi escape dari kelas induk
            $keyword = $this->escape($keyword);
            $where .= " AND (nama_lengkap LIKE '%$keyword%' 
                         OR bidang_studi LIKE '%$keyword%'
                         OR jabatan LIKE '%$keyword%')";
        }
        
        // Pengurutan hierarki (disarankan)
        $order = " ORDER BY FIELD(jabatan, 
                      'Kepala Sekolah', 'Wakil Kepala Sekolah', 
                      'Wali Kelas', 'Guru Mapel', 'Staf Administrasi'
                  ), nama_lengkap ASC";

        $final_sql = $sql . $where . $order . " LIMIT $limit OFFSET $offset";
        $query = $this->query($final_sql);
        
        $data_guru = [];
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data_guru[] = $row;
            }
        }
        return $data_guru;
    }
    public function countAllGuru($keyword = null) {
        $sql = "SELECT COUNT(*) as total FROM guru_staf";
        $where = " WHERE 1=1 "; 
        
        if ($keyword) {
            // Menggunakan fungsi escape dari kelas induk
            $keyword = $this->escape($keyword);
            $where .= " AND (nama_lengkap LIKE '%$keyword%' 
                         OR bidang_studi LIKE '%$keyword%'
                         OR jabatan LIKE '%$keyword%')";
        }
        
        $final_sql = $sql . $where;
        $query = $this->query($final_sql);
        
        // Pastikan query berhasil sebelum fetch
        if (!$query) {
            // Ini akan mencetak error jika query gagal
            // echo mysqli_error($this->koneksi); 
            return 0; 
        }
        
        $data = mysqli_fetch_assoc($query);
        return $data['total'] ?? 0;
    }
    public function getAllGuruList() {
        
        $sql = "SELECT id_guru, nip, nama_lengkap, jabatan, bidang_studi, email, foto 
                  FROM guru_staf";
        
        // Asumsi: Kita menggunakan ORDER BY yang sederhana untuk menghindari syntax error
        $order = " ORDER BY nama_lengkap ASC";
        
        $final_sql = $sql . $order;

        // --- 1. Jalankan Query ---
        $query = $this->query($final_sql); 
        
        // --- 2. CEK APAKAH QUERY GAGAL ---
        if (!$query) {
            // Tampilkan pesan error MySQLi yang spesifik
            echo "<div style='background-color: #ffcccc; color: red; padding: 15px; border: 1px solid red;'>";
            echo "<h3>SQL FAILURE (GuruModel):</h3>";
            echo "Error MySQL: " . mysqli_error($this->koneksi) . "<br>";
            echo "Query Gagal: " . htmlspecialchars($final_sql);
            echo "</div>";
            return []; // Kembalikan array kosong agar halaman tidak crash
        }
        
        // --- 3. Ambil Data (jika sukses) ---
        $data_guru = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $data_guru[] = $row;
        }
        
        // --- 4. DEBUGGING SEMENTARA (Jumlah Data) ---
        // echo "<div style='background-color: #ccffcc; color: green; padding: 15px;'>DATA DITEMUKAN: " . count($data_guru) . " baris.</div>";
        
        return $data_guru;
    }

    /**
     * Mengambil detail satu guru berdasarkan ID.
     */
    public function getGuruById($id_guru) {
        $id = intval($id_guru);
        
        $sql = "SELECT id_guru, nip, nama_lengkap, jabatan, bidang_studi, email, foto 
                  FROM guru_staf WHERE id_guru = $id"; 
                  
        $query = $this->query($sql);
        
        return mysqli_fetch_assoc($query); // Mengambil HANYA SATU BARIS
    }

    /**
     * Menghitung total guru/staf yang ada di tabel.
     */
    public function countGuru() {
        $sql = "SELECT COUNT(*) as total FROM guru_staf";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'] ?? 0;
    }

    /**
     * Mengambil data Kepala Sekolah (hanya 1 entri).
     */
    public function getKepalaSekolah() {
        $sql = "SELECT * FROM guru_staf 
                WHERE jabatan = 'Kepala Sekolah' 
                LIMIT 1";

        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    /**
     * Memperbarui data guru/staf.
     */
    public function updateGuru($id, $nip, $nama, $jabatan, $mapel, $email, $foto = null) {
        
        $id = intval($id); 
        // Asumsi $nip, $nama, dst. sudah di-escape di Controller sebelum dipanggil
        
        $sql = "UPDATE guru_staf SET 
                nip = '{$nip}', 
                nama_lengkap = '{$nama}', 
                jabatan = '{$jabatan}', 
                bidang_studi = '{$mapel}', 
                email = '{$email}'";

        if ($foto != null) {
            $sql .= ", foto = '{$foto}'"; 
        }
        
        $sql .= " WHERE id_guru = {$id}";

        return $this->query($sql);
    }
}
?>