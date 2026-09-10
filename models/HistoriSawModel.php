<?php
require_once 'Database.php';

// Jejak audit perubahan parameter seleksi SAW: bobot per jalur, nilai pendaftar,
// kuota kelulusan, dan status kelulusan yang diubah manual (mis. saat sidang).
// Dipanggil dari controller lain lewat catat() setiap kali salah satu parameter
// itu berhasil disimpan, supaya sekolah tahu siapa mengubah apa dan kapan.
class HistoriSawModel extends Database {

    const JENIS_LIST = ['Bobot SAW', 'Nilai Pendaftar', 'Kuota Kelulusan', 'Status Manual', 'Daftar Ulang'];

    // Rekam satu perubahan. $data_lama / $data_baru boleh array (otomatis di-JSON-kan) atau string/null.
    public function catat($jenis, $keterangan, $data_lama = null, $data_baru = null) {
        $conn = $this->koneksi;

        $id_admin = isset($_SESSION['admin_id']) ? intval($_SESSION['admin_id']) : null;
        $nama_admin = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Sistem';

        $jenis_e = mysqli_real_escape_string($conn, $jenis);
        $ket_e = mysqli_real_escape_string($conn, $keterangan);
        $nama_e = mysqli_real_escape_string($conn, $nama_admin);
        $id_admin_sql = ($id_admin !== null) ? $id_admin : 'NULL';

        $lama_txt = $this->toText($data_lama);
        $baru_txt = $this->toText($data_baru);
        $lama_sql = ($lama_txt !== null) ? "'" . mysqli_real_escape_string($conn, $lama_txt) . "'" : 'NULL';
        $baru_sql = ($baru_txt !== null) ? "'" . mysqli_real_escape_string($conn, $baru_txt) . "'" : 'NULL';

        $sql = "INSERT INTO histori_seleksi_saw
                (id_admin, nama_admin, jenis_perubahan, keterangan, data_lama, data_baru)
                VALUES ($id_admin_sql, '$nama_e', '$jenis_e', '$ket_e', $lama_sql, $baru_sql)";

        return $this->query($sql);
    }

    private function toText($data) {
        if ($data === null) return null;
        if (is_array($data)) return json_encode($data, JSON_UNESCAPED_UNICODE);
        return (string) $data;
    }

    // $filters: ['jenis' => ..., 'dari' => 'Y-m-d', 'sampai' => 'Y-m-d'] -- semua opsional
    public function getHistori($filters = []) {
        $conn = $this->koneksi;
        $sql = "SELECT * FROM histori_seleksi_saw WHERE 1=1";

        if (!empty($filters['jenis']) && in_array($filters['jenis'], self::JENIS_LIST)) {
            $jenis = mysqli_real_escape_string($conn, $filters['jenis']);
            $sql .= " AND jenis_perubahan = '$jenis'";
        }
        if (!empty($filters['dari'])) {
            $dari = mysqli_real_escape_string($conn, $filters['dari']);
            $sql .= " AND DATE(waktu_perubahan) >= '$dari'";
        }
        if (!empty($filters['sampai'])) {
            $sampai = mysqli_real_escape_string($conn, $filters['sampai']);
            $sql .= " AND DATE(waktu_perubahan) <= '$sampai'";
        }

        $sql .= " ORDER BY waktu_perubahan DESC";

        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
?>
